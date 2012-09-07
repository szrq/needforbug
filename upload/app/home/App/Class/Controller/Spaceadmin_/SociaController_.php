<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化帐号管理($)*/

!defined('DYHB_PATH') && exit;

class SociaController extends Controller{

	public function index(){
		// 导入社会化登录组件
		Dyhb::import(NEEDFORBUG_PATH.'/source/extension/socialization');

		Socia::clearCookie();

		$oSocialocal=Dyhb::instance('Socia');
		$arrBindeds=$oSocialocal->getBinded($GLOBALS['___login___']['user_id']);

		$this->assign('arrBindeds',$arrBindeds);

		$this->display('spaceadmin+socia');
	}

}
