<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城文章控制器($)*/

!defined('DYHB_PATH') && exit;

class ShoparticleController extends InitController{
	
	public function index(){
		$arrShoparticlecategory=ShoparticlecategoryModel::F()->getAll();

		$this->assign('arrShoparticlecategory',$arrShoparticlecategory);
		$this->display('shoparticle+index');
	}
}
