<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组列表控制器($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		Core_Extend::loadCache('sociatype');

		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
		$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);
		$this->assign('arrBindeds',$GLOBALS['_cache_']['sociatype']);
		

		$this->display('public+index');
	}

	public function group(){
		$this->display('public+group');
	}

	public function add(){
		$this->display('public+add');
	}

}
