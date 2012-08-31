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
		
		$arrData['num']=$nHomefreshcomment;
		$arrData['content']=$sContent;
		$this->A($arrData,'评论成功',1);
	}
}
