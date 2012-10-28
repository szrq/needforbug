<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   配置模型($)*/

!defined('DYHB_PATH') && exit;

class HomeoptionModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'homeoption',
			'props'=>array(
				'homeoption_name'=>array('readonly'=>true),
			),
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public static function uploadOption($sOptionName,$sOptionValue){
		$oOptionModel=self::F('homeoption_name=?',$sOptionName)->getOne();
		$oOptionModel->homeoption_value=G::html($sOptionValue);
		$oOptionModel->save(0,'update');

		HomeCache_Extend::updateCache("option");
	}

}
