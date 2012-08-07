<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题变量模型($)*/

!defined('DYHB_PATH') && exit;

class StyleModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'stylevar',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function saveStylevarData($arrStylevariableData,$nStyleId){
		foreach($arrStylevariableData as $sKey=>$sValue){
			$oTryStylevar=StylevarModel::F('stylevar_id=? AND stype_id=?',,)->getOne();
			if(!empty($oTryStylevar['stylevar_id'])){
				
			}
		}
	}

}
