<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   个人动态($)*/

!defined('DYHB_PATH') && exit;

class FeedController extends Controller{

	public function index(){
		$nId=intval(G::getGpc('id','G'));
		if(empty($nId)){
			$nId=$GLOBALS['___login___']['user_id'];
		}
		
		$oUserInfo=UserModel::F()->getByuser_id($nId);
		if(empty($oUserInfo['user_id'])){
			$this->E(Dyhb::L('你指定的用户不存在','Controller/Space'));
		}else{
			$this->assign('oUserInfo',$oUserInfo);
		}

		$this->assign('nId',$nId);

		$this->display('space+feed');
	}

}
