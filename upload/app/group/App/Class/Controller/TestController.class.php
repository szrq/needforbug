<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   测试控制器($)*/

!defined('DYHB_PATH') && exit;

class TestController extends InitController{

	public function index(){
		$this->display('test+index');
	}

	public function index2(){
		$this->display('test+index2');
	}

	public function index3(){
		$this->display('test+index3');
	}

}
