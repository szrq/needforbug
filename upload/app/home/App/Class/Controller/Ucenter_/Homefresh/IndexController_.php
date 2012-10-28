<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   新鲜事列表($)*/

!defined('DYHB_PATH') && exit;

class IndexController extends Controller{

	public function index(){
		$arrWhere=array();
		
		$sType=trim(G::getGpc('type','G'));
		if(empty($sType)){
			$sType='';
		}
		$this->assign('sType',$sType);
		
		switch($sType){
			case 'myself':
				$arrWhere['user_id']=$GLOBALS['___login___']['user_id'];
				break;
			case 'friend':
				// 仅好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
			
				if(!empty($arrUserIds)){
					$arrWhere['user_id']=array('in',$arrUserIds);
				}else{
					$arrWhere['user_id']='';
				}
				break;
			case 'all':
				// 这里可以设置用户隐私，比如用户不愿意将动态放出
				break;
			default:
				// 我和好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
				$arrUserIds[]=$GLOBALS['___login___']['user_id'];

				if(!empty($arrUserIds)){
					$arrWhere['user_id']=array('in',$arrUserIds);
				}else{
					$arrWhere['user_id']='';
				}
				break;
		}

		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		$sGoodCookie=Dyhb::cookie('homefresh_goodnum');
		$arrGoodCookie=explode(',',$sGoodCookie);
		$this->assign('arrGoodCookie',$arrGoodCookie);

		// 新鲜事
		$arrWhere['homefresh_status']=1;
		$nTotalRecord=HomefreshModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefresh_list_num'],G::getGpc('page','G'));
		$arrHomefreshs=HomefreshModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefresh_list_num'])->getAll();

		// 我的新鲜事数量
		$nMyhomefreshnum=$this->get_myhomefreshnum();

		$this->assign('arrHomefreshs',$arrHomefreshs);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_publish_status']);
		$this->assign('nDisplayCommentSeccode',$GLOBALS['_cache_']['home_option']['seccode_comment_status']);
		$this->assign('nMyhomefreshnum',$nMyhomefreshnum);
		
		$this->display('homefresh+index');
	}

	public function index_title_(){
		return '用户中心';
	}

	public function index_keywords_(){
		return $this->index_title_();
	}

	public function index_description_(){
		return $this->index_title_();
	}

	public function get_newcomment($nId,$nUserid){
		if($GLOBALS['___login___']['user_id']!=$nUserid){
			$sHomefreshcommentAuditpass=' AND homefreshcomment_auditpass=1 ';
		}else{
			$sHomefreshcommentAuditpass='';
		}
		
		return HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 '.$sHomefreshcommentAuditpass.' AND homefreshcomment_parentid=0',$nId
			)->limit(0,$GLOBALS['_cache_']['home_option']['homefreshcomment_limit_num'])->order('homefreshcomment_id DESC')->getAll();
	}

	public function get_newchildcomment($nId,$nCommentid,$nUserid,$bAll=false,$nCommentpage=1){
		if($GLOBALS['___login___']['user_id']!=$nUserid){
			$sHomefreshcommentAuditpass=' AND homefreshcomment_auditpass=1 ';
		}else{
			$sHomefreshcommentAuditpass='';
		}
		
		$oHomefreshcommentSelect=HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 '.$sHomefreshcommentAuditpass.' AND homefreshcomment_parentid=?',$nId,$nCommentid
			)->order('homefreshcomment_id DESC');

		if($bAll===true){
			if($nCommentpage<1){
				$nCommentpage=1;
			}

			$nTotalHomefreshcommentNum=$oHomefreshcommentSelect->All()->getCounts();

			$oPage=Page::RUN($nTotalHomefreshcommentNum,$GLOBALS['_cache_']['home_option']['homefreshchildcomment_list_num'],$nCommentpage,false);

			$arrHomefreshcomments=HomefreshcommentModel::F(
				'homefresh_id=? AND homefreshcomment_status=1 '.$sHomefreshcommentAuditpass.' AND homefreshcomment_parentid=?',$nId,$nCommentid
				)->order('homefreshcomment_id DESC')->limit($oPage->returnPageStart(),$GLOBALS['_cache_']['home_option']['homefreshchildcomment_list_num'])->getAll();

			return array($arrHomefreshcomments,$oPage->P('pagination_'.$nCommentid.'@pagenav','span','current','disabled','commentpage_'.$nCommentid),$nTotalHomefreshcommentNum<$GLOBALS['_cache_']['home_option']['homefreshchildcomment_list_num']?false:true);
		}else{
			return $oHomefreshcommentSelect->limit(0,$GLOBALS['_cache_']['home_option']['homefreshchildcomment_limit_num'])->getAll();
		}
	}

	protected function get_myhomefreshnum(){
		$oHomefresh=Dyhb::instance('HomefreshModel');
		return $oHomefresh->getHomefreshnumByUserid($GLOBALS['___login___']['user_id']);
	}

}
