<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   公用控制器($)*/

!defined('DYHB_PATH') && exit;

class InitController extends Controller{

	public function init__(){
		parent::init__();

		Core_Extend::loadCache('option');

		Core_Extend::loadCache('nav');

		Core_Extend::loadCache('home_option');

		Core_Extend::loginInformation();

		$this->defineCurscript();

		Core_Extend::initFront();
	}

	public function defineCurscript(){
		$arrModulecachelist=array(
			'index'=>'public::index',
			'pm'=>'pm',
			'userhome'=>'user::index'
		);

		foreach($arrModulecachelist as $sKey=>$sCache){
			if(strpos($sCache,'::') && MODULE_NAME.'::'.ACTION_NAME==$sCache){
				define('CURSCRIPT',$sKey);
				continue;
			}elseif(MODULE_NAME===$sCache){
				define('CURSCRIPT',$sKey);
				continue;
			}
		}
	}
	
	public function is_login(){
		if($GLOBALS['___login___']===false){
			UserModel::M()->clearThisCookie();
	
			// 发送当前URL
			Dyhb::cookie('needforbug_referer',__SELF__);
			
			$this->assign('__JumpUrl__',Dyhb::U('home://public/login'));
			$this->E('你没有登录');
		}
	}

	public function seccode(){
		Core_Extend::seccode();
	}

	public function check_seccode($bSubmit=false){
		$sSeccode=G::getGpc('seccode');
		$bResult=Core_Extend::checkSeccode($sSeccode);

		if(!$bResult){
			$this->E('你输入的验证码错误');
		}

		if($bSubmit===false){
			$this->S('验证码正确');
		}
	}
	
	public function page404(){
		header("HTTP/1.0 404 Not Found");
		
		$this->display('404');
		exit();
	}

}
