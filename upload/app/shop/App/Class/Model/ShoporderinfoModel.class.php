<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   订单详细信息模型($)*/

!defined('DYHB_PATH') && exit;

class ShoporderinfoModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shoporderinfo',
			'props'=>array(
				'shoporderinfo_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shoporderinfo_id',
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
