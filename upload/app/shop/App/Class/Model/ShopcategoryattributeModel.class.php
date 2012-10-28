<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城商品分类属性模型($)*/

!defined('DYHB_PATH') && exit;

class ShopcategoryattributeModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shopcategoryattribute',
			'props'=>array(
				'shopcategoryattribute_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shopcategoryattribute_id',
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
