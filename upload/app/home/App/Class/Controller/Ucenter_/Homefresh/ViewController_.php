<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   查看新鲜事($)*/

!defined('DYHB_PATH') && exit;

class ViewController extends Controller{

	public function index(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E(Dyhb::L('你没有指定要阅读的新鲜事','Controller/Homefresh'));
		}

		$oHomefresh=HomefreshModel::F('homefresh_id=? AND homefresh_status=1',$nId)->getOne();
		if(empty($oHomefresh['homefresh_id'])){
			$this->E(Dyhb::L('新鲜事不存在或者被屏蔽了','Controller/Homefresh'));
		}

		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		// 判断邮件等外部地址过来的查找评论地址
		$nIsolationCommentid=intval(G::getGpc('isolation_commentid','G'));
		if($nIsolationCommentid){
			$result=HomefreshcommentModel::getCommenturlByid($nIsolationCommentid);
			if($result===false){
				$this->E('该条评论已被删除、屏蔽或者尚未通过审核');
			}

			G::urlGoTo($result);
			exit();
		}

		$oHomefresh->homefresh_viewnum=$oHomefresh->homefresh_viewnum+1;
		$oHomefresh->save(0,'update');

		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}

		$sHomefreshtitle=$oHomefresh->homefresh_title?$oHomefresh->homefresh_title:G::subString(strip_tags($oHomefresh['homefresh_message']),0,$arrOptionData['homefreshtitle_substring_num']);

		// 读取评论列表
		$arrWhere=array();
		$arrWhere['homefreshcomment_parentid']=0;
		$arrWhere['homefreshcomment_status']=1;
		$arrWhere['homefresh_id']=$nId;

		if($GLOBALS['___login___']['user_id']!=$oHomefresh['user_id']){
			$arrWhere['homefreshcomment_auditpass']=1;
			$this->assign('bAuditpass',false);
		}else{
			$this->assign('bAuditpass',true);
		}

		$this->_oHomefresh=$oHomefresh;

		$nTotalRecord=HomefreshcommentModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefreshcomment_list_num'],G::getGpc('page','G'));
		$arrHomefreshcommentLists=HomefreshcommentModel::F()->where($arrWhere)->all()->order('`create_dateline` DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefreshcomment_list_num'])->getAll();

		// 用户和积分
		$oUserInfo=$oHomefresh->user;
		$nUserscore=$oUserInfo->usercount->usercount_extendcredit1;
		$arrRatinginfo=UserModel::getUserrating($nUserscore,false);
		$this->assign('oUserInfo',$oUserInfo);
		$this->assign('arrRatinginfo',$arrRatinginfo);
		$this->assign('nUserscore',$nUserscore);

		// 取得个人主页
		$oUserprofile=UserprofileModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();
		$this->_sHomefreshtitle=$sHomefreshtitle;

		// 我的新鲜事数量
		$nMyhomefreshnum=Homefresh_Extend::getMyhomefreshnum($GLOBALS['___login___']['user_id']);

		$this->assign('oHomefresh',$oHomefresh);
		$this->assign('sHomefreshtitle',$sHomefreshtitle);
		$this->assign('nTotalHomefreshcomment',$nTotalRecord);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('arrHomefreshcommentLists',$arrHomefreshcommentLists);
		$this->assign('sUsersite',$oUserprofile['userprofile_site']);
		$this->assign('nDisplaySeccode',$GLOBALS['_cache_']['home_option']['seccode_comment_status']);
		$this->assign('nMyhomefreshnum',$nMyhomefreshnum);

		$this->display('homefresh+view');
	}

	protected $_oHomefresh=null;

	public function view_title_(){
		return $this->_sHomefreshtitle;
	}

	public function view_keywords_(){
		return $this->view_title_();
	}

	public function view_description_(){
		if(G::getGpc('page','G')>1){
			return $this->view_title_();
		}else{
			return $this->_oHomefresh['homefresh_message'];
		}
	}

}
