<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化帐号管理($)*/

!defined('DYHB_PATH') && exit;

// 导入社会化登录组件
Dyhb::import(NEEDFORBUG_PATH.'/source/extension/socialization');

class SociaController extends Controller{

	public function index(){
		Socia::clearCookie();

		$oSocialocal=Dyhb::instance('Socia');
		$arrBindeds=$oSocialocal->getBinded($GLOBALS['___login___']['user_id']);

		$this->assign('arrBindeds',$arrBindeds);

		$this->display('spaceadmin+socia');
	}

	public function account(){
		require_once(NEEDFORBUG_PATH.'/source/extension/socialization/Socia.class.php');
		
		$sAction=trim(G::getGpc('action','G'));
		$sVendor=trim(G::getGpc('vendor','G'));

		if(empty($sAction)){
			$sAction='showBars';
		}

		if(empty($sVendor)){
			$sVendor='';
		}else{
			$sVendor='Vendor' .$sVendor;
		}

		$oSocia=Socia::getInstance($sVendor);
		if(!method_exists($oSocia,$sAction)){
			$this->E(sprintf('Method %s not exists',$sAction));
		}

		$return=$oSocia->$sAction($sVendor);

		G::dump($return);
	}

}
