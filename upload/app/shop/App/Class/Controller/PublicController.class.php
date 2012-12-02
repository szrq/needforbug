<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城首页控制器($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		$this->newlist();

		$this->display('public+index');
	}

	public function newlist(){

		$arrNew=ShoparticleModel::F('shoparticlecategory_id=5 AND shoparticle_status=1')->order('create_dateline DESC')->limit(0,10)->getAll();/*cid=5 默认为商城公告分类*/

		$this->assign('arrNew',$arrNew);
	}

}
