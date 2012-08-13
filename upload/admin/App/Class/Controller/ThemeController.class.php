<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   模板管理控制器($)*/

!defined('DYHB_PATH') && exit;

class ThemeController extends InitController{
	
	public function filter_(&$arrMap){
		$arrMap['theme_name']=array('like',"%".G::getGpc('theme_name')."%");
	}

	public function bUpdate_(){
		$sThemeDirectory=trim(G::getGpc('','P'));

		if()
	}

	public function bForeverdelete_(){
		$sId=G::getGpc('id','G');

		$arrIds=explode(',',$sId);
		foreach($arrIds as $nId){
			if($this->is_system_theme($nId)){
				$this->E(Dyhb::L('系统模板无法删除','Controller/Theme'));
			}
		}
	}

	public function bEdit_(){
		$nId=intval(G::getGpc('id','G'));

		if($this->is_system_theme($nId)){
			$this->E(Dyhb::L('系统模板无法编辑','Controller/Theme'));
		}
	}

	public function input_change_ajax($sName=null){
		$nInputAjaxId=G::getGpc('input_ajax_id');

		if($this->is_system_theme($nInputAjaxId)){
			$this->E(Dyhb::L('系统模板无法编辑','Controller/Theme'));
		}
	}

	public function is_system_theme($nId){
		if($nId==1){
			return true;
		}

		return false;
	}

}
