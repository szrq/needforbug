<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   友情衔接控制器($)*/

!defined('DYHB_PATH') && exit;

class LinkController extends InitController{

	public function filter_(&$arrMap){
		$arrMap['link_name']=array('like',"%".G::getGpc('link_name')."%");
	}

	protected function aInsert($nId=null){
		require_once(Core_Extend::includeFile('function/Cache_Extend'));
		Cache_Extend::updateCacheLink();
	}

	protected function aUpdate($nId=null){
		$this->aInsert();
	}

	public function aForeverdelete($sId){
		$this->aInsert();
	}

	protected function aForbid(){
		$this->aInsert();
	}
	
	protected function aResume(){
		$this->aInsert();
	}

	public function AInsertObject_($oModel){
		$oModel->safeInput();
	}

	public function AUpdateObject_($oModel){
		$oModel->safeInput();
	}

}