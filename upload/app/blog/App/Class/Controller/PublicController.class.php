<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   博客列表控制器($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends Controller{

	public function index(){
		echo 'Hello world';
		exit();
		$this->display();
	}

}