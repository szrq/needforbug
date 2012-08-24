<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台首页显示($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		Core_Extend::doControllerAction('Public@Index','index');
	}

	public function login(){
		Core_Extend::doControllerAction('Public@Login','index');
	}

	public function check_login(){
		Core_Extend::doControllerAction('Public@Login','check_login');
	}

	public function logout(){
		Core_Extend::doControllerAction('Public@Login','logout');
	}

	public function clear(){
		Core_Extend::doControllerAction('Public@Login','clear');
	}

	public function register(){
		Core_Extend::doControllerAction('Public@Register','index');
	}
	
	public function check_user(){
		Core_Extend::doControllerAction('Public@Register','check_user');
	}
	
	public function check_email(){
		Core_Extend::doControllerAction('Public@Register','check_email');
	}
	
	public function register_user(){
		Core_Extend::doControllerAction('Public@Register','register_user');
	}

}
