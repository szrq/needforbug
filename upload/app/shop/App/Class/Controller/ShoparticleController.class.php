<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城文章控制器($)*/

!defined('DYHB_PATH') && exit;

class ShoparticleController extends InitController{
	
	public function help(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E('对不起，你查询的文章不存在');
		}
		$nCount=ShoparticleModel::F('shoparticle_status=1 AND shoparticlecategory_id=?',$nId)->getCounts();
		
		if($nCount>1){
			$arrWhere=array();	
			$arrWhere['shoparticle_status']=1;
			$arrWhere['shoparticlecategory_id']=$nId;
			$nEverynum=6;
			$oPage=Page::RUN($nCount,$nEverynum,G::getGpc('page','G'));
			$arrShoparticle=ShoparticleModel::F()->where($arrWhere)->limit($oPage->returnPageStart(),$nEverynum)->getAll();
	
			$this->assign('arrShoparticle',$arrShoparticle);
			$this->assign('nEverynum',$nEverynum);
			$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));

			$oShoparticlecategory=ShoparticlecategoryModel::F('shoparticlecategory_id=?',$nId)->getOne();
			$this->assign('oShoparticlecategory',$oShoparticlecategory);
		}else{
			$Shoparticle=ShoparticleModel::F('shoparticle_status=1 AND shoparticle_id=?',$nId)->getOne();

			$this->assign('Shoparticle',$Shoparticle);
		}

		$this->display('shoparticle+help');
	}

	public function show(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E('对不起，你查询的文章不存在');
		}
		$Shoparticle=ShoparticleModel::F('shoparticle_status=1 AND shoparticle_id=?',$nId)->getOne();

		$this->assign('Shoparticle',$Shoparticle);
		$this->display('shoparticle+help');
	}

	public function search(){
		$sText=trim(G::getGpc('string','P'));
		$nId=intval(G::getGpc('sid','P'));

		$sText='%'.$sText.'%';
		$nCount=ShoparticleModel::F('shoparticle_status=1 AND shoparticle_title like ?',$sText)->getCounts();

		$nEverynum=6;
		$oPage=Page::RUN($nCount,$nEverynum,G::getGpc('page','G'));
		$arrShoparticle=ShoparticleModel::F()->where('shoparticle_status=1 AND shoparticle_title like ?',$sText)->limit($oPage->returnPageStart(),$nEverynum)->getAll();
	
		$this->assign('arrShoparticle',$arrShoparticle);
		$this->assign('nEverynum',$nEverynum);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));

		$oShoparticlecategory=ShoparticlecategoryModel::F('shoparticlecategory_id=?',$nId)->getOne();
		$this->assign('oShoparticlecategory',$oShoparticlecategory);

		$this->display('shoparticle+help');
	}

	public function feedback(){
		$nId=intval(G::getGpc('id','G'));

		$oShoparticle=ShoparticleModel::F('shoparticlecategory_id=?',$nId)->limit(0,1)->getOne();

		$this->assign('oShoparticle',$oShoparticle);
		$this->display('shoparticle+feedback');
	}
}
