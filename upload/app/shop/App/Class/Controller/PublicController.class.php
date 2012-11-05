<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城首页控制器($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		$this->display('public+index');
	}

}
