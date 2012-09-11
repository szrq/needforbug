<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组列表控制器($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		if(G::getGpc('type')=='new'){
			Core_Extend::loadCache('sociatype');

			$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
			$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);
			$this->assign('arrBindeds',$GLOBALS['_cache_']['sociatype']);
			

			$this->display('public+new');
		}else{
			$this->display();
		}
	}

	public function create(){
		$this->display();
	}

}
