<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   公用控制器($)*/

!defined('DYHB_PATH') && exit;

class InitController extends Controller{

	public function init__(){
		parent::init__();

		// 应用配置
		Core_Extend::loadCache('home_option');

		//前端初始化
		Core_Extend::initFront();

		// 404
		Core_Extend::page404($this);
	}
	
	public function is_login(){
		if($GLOBALS['___login___']===false){
			UserModel::M()->clearThisCookie();
	
			// 发送当前URL
			Dyhb::cookie('needforbug_referer',__SELF__);
			
			$this->assign('__JumpUrl__',Dyhb::U('home://public/login'));
			$this->E(Dyhb::L('你没有登录','Controller/Common'));
		}
	}

	public function seccode(){
		Core_Extend::seccode();
	}

	public function check_seccode($bSubmit=false){
		$sSeccode=G::getGpc('seccode');
		$bResult=Core_Extend::checkSeccode($sSeccode);

		if(!$bResult){
			$this->E(Dyhb::L('你输入的验证码错误','Controller/Common'));
		}

		if($bSubmit===false){
			$this->S(Dyhb::L('验证码正确','Controller/Common'));
		}
	}
	
	public function page404(){
		header("HTTP/1.0 404 Not Found");
		$this->display('404');
		exit();
	}

	protected function E($sMessage='',$nDisplay=3,$bAjax=FALSE){
		if(G::getGpc('dialog')==1){
			$this->dialog_message($sMessage);
		}else{
			parent::E($sMessage,$nDisplay,$bAjax);
		}
	}

	protected function S($sMessage,$nDisplay=1,$bAjax=FALSE){
		if(G::getGpc('dialog')==1){
			$this->dialog_message($sMessage);
		}else{
			parent::S($sMessage,$nDisplay,$bAjax);
		}
	}

	public function dialog_message($sMessage){
		$this->assign('sMessage',$sMessage);
		$this->display('dialog_message');
		exit();
	}

}
