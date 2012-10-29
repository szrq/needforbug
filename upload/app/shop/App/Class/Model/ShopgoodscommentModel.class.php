<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城商品评论模型($)*/

!defined('DYHB_PATH') && exit;

class ShopgoodscommentModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shopgoodscomment',
			'props'=>array(
				'shopgoodscomment_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shopgoodscomment_id',
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
