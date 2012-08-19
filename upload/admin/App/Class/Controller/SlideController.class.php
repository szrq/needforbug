<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   幻灯片控制器($)*/

!defined('DYHB_PATH') && exit;

class SlideController extends InitController{

	public function filter_(&$arrMap){
		$arrMap['slide_title']=array('like',"%".G::getGpc('slide_title')."%");
	}

	public function bEdit_(){
		$nId=intval(G::getGpc('id','G'));

		if($this->is_system_slide($nId)){
			$this->E(Dyhb::L('系统幻灯片无法编辑','Controller/Slide'));
		}
	}

	public function bForeverdelete_(){
		$sId=G::getGpc('id','G');

		$arrIds=explode(',',$sId);
		foreach($arrIds as $nId){
			if($this->is_system_slide($nId)){
				$this->E(Dyhb::L('系统幻灯片无法删除','Controller/Slide'));
			}
		}
	}
	
	protected function aInsert($nId=null){
		if(!Dyhb::classExists('Cache_Extend')){
			require_once(Core_Extend::includeFile('function/Cache_Extend'));
		}
		Cache_Extend::updateCacheSlide();
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

	public function is_system_slide($nId){
		$nId=intval($nId);

		if($nId<=3){
			return true;
		}

		return false;
	}

}
