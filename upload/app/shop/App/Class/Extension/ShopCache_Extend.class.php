<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城缓存文件($)*/

!defined('DYHB_PATH') && exit;

class ShopCache_Extend{

	public static function updateCacheOption(){
		$arrData=array();

		$arrOptionData=ShopoptionModel::F()->asArray()->all()->query();
		if(is_array($arrOptionData)){
			foreach($arrOptionData as $nKey=>$arrValue){
				$arrData[$arrValue['shopoption_name']]=$arrValue['shopoption_value'];
			}
		}

		Core_Extend::saveSyscache('shop_option',$arrData);
	}

}
