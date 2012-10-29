<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城商品收藏模型($)*/

!defined('DYHB_PATH') && exit;

class ShopcollectModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shopcollect',
			'props'=>array(
				'shopcollect_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shopcollect_id',
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
