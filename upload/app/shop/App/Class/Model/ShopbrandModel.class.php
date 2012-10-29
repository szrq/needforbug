<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城品牌模型($)*/

!defined('DYHB_PATH') && exit;

class ShopbrandModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shopbrand',
			'props'=>array(
				'shopbrand_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shopbrand_id',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

}
