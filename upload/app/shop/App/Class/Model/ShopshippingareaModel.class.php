<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城配送区域模型($)*/

!defined('DYHB_PATH') && exit;

class ShopshippingareaModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shopshippingarea',
			'props'=>array(
				'shopshippingarea_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shopshippingarea_id',
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
