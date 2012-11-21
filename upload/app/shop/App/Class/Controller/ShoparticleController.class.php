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
	
	public function getarticle(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E('访问的文章不存在');
		}
		$oShoparticle=ShoparticleModel::F('shoparticle_id=?',$nId)->getOne();
		if(empty($oShoparticle->shoparticle_id)){
			$this->E('访问的文章不存在');
		}
		
		$arrData=array();
		$arrData['title']=$oShoparticle->shoparticle_title;
		$arrData['content']=$oShoparticle->shoparticle_content;

		$this->A($arrData,'',1,0);
	}
}
