<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商品包装方式模型($)*/

!defined('DYHB_PATH') && exit;

class ShoppackModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shoppack',
			'props'=>array(
				'shoppack_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shoppack_id',
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
