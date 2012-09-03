<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   用户中心显示($)*/

!defined('DYHB_PATH') && exit;

class UcenterController extends InitController{

	public function init__(){
		parent::init__();

		$this->is_login();
	}
	
	public function index(){
		Core_Extend::doControllerAction('Ucenter@Homefresh','index');
	}

	public function add_homefresh(){
		Core_Extend::doControllerAction('Ucenter@Homefresh','add');
	}

	public function view(){
		Core_Extend::doControllerAction('Ucenter@Homefresh','view');
	}

	public function add_homefreshcomment(){
		Core_Extend::doControllerAction('Ucenter@Homefresh','add_comment');
	}

	public function update_homefreshgoodnum(){
		Core_Extend::doControllerAction('Ucenter@Homefresh','update_goodnum');
	}
	
	public function deal(){
		$sContent=trim(G::getGpc('content','G'));
		$nId=intval(G::getGpc('id','G'));

		if(empty($sContent)||empty($nId)){
			$this->E('数据读取错误');
		}
		
		$oHomefreshComment=new HomefreshcommentModel();
		$oHomefreshComment->homefreshcomment_content=$sContent;
		$oHomefreshComment->homefresh_id=$nId;
		$oHomefreshComment->save(0);
		if($oHomefreshComment->isError()){
			$this->E($oHomefreshComment->getErrorMessage());
		}
		
		$nHomefreshcomment=HomefreshcommentModel::F('homefresh_id=? AND homefreshcomment_status=1 AND homefreshcomment_auditpass=1',$nId)->all()->getCounts();

		$oHomefresh=HomefreshModel::F('homefresh_id=?',$nId)->getOne();
		$oHomefresh->homefresh_commentnum=$nHomefreshcomment;
		$oHomefresh->save(0,'update');
		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}

		$arrData=$oHomefreshComment->toArray();
		$arrData['homefreshcomment_content']=G::subString(strip_tags($arrData['homefreshcomment_content']),0,80);
		$arrData['comment_name']=UserModel::getUsernameById($oHomefreshComment->user_id);
		$arrData['create_dateline']=Core_Extend::timeFormat($arrData['create_dateline']);
		$arrData['avatar']=Core_Extend::avatar($arrData['user_id'],'small');
		$arrData['url']=Dyhb::U('home://space@?id='.$arrData['user_id']);
		$arrData['num']=$nHomefreshcomment;

		$this->A($arrData,'评论成功',1);
	}
}
