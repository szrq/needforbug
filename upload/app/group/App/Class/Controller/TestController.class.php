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

	public function index4(){
		$this->display('test+index4');
	}

	public function index5(){
		$this->display('test+index5');
	}

	public function index6(){
		$this->display('test+index6');
	}
	public function index7(){
		$this->display('test+index7');}
}