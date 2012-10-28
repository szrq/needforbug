<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城反馈模型($)*/

!defined('DYHB_PATH') && exit;

class ShopfeedModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shopfeed',
			'props'=>array(
				'shopfeed_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shopfeed_id',
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
