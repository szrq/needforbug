<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   好友系统显示($)*/

!defined('DYHB_PATH') && exit;

class FriendController extends InitController{

	public function init__(){
		parent::init__();

		$this->is_login();
	}
	
	public function index(){
		Core_Extend::doControllerAction('Friend@Index','index');
	}

	public function add(){
		Core_Extend::doControllerAction('Friend@Add','index');
	}
	
	public function delete(){
		Core_Extend::doControllerAction('Friend@Delete','index');
	}
	
	public function edit(){
		Core_Extend::doControllerAction('Friend@Edit','index');
	}

	public function search(){
		Core_Extend::doControllerAction('Friend@Search','index');
	}

	public function mayknow(){
		Core_Extend::doControllerAction('Friend@Mayknow','index');
	}
	
}
