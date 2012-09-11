<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组列表控制器($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		if(G::getGpc('type')=='new'){
			$this->display('public+new');
		}else{
			$this->display();
		}
	}

	public function create(){
		$this->display();
	}

}
