<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城商品订单模型($)*/

!defined('DYHB_PATH') && exit;

class ShoporderModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shoporder',
			'props'=>array(
				'shoporder_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shoporder_id',
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
