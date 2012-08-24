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

}
