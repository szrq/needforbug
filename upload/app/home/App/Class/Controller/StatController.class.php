<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   站点统计显示($)*/

!defined('DYHB_PATH') && exit;

class StatController extends InitController{

	public function index(){
		Core_Extend::doControllerAction('Stat@Base','index');
	}
	
	public function userlist(){
		Core_Extend::doControllerAction('Stat@Userlist','index');
	}
	
}
