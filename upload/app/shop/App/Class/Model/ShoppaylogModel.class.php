<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城支付记录模型($)*/

!defined('DYHB_PATH') && exit;

class ShoppaylogModel extends Model{

	static public function init__(){
		return array(
			'table_name'=>'shoppaylog',
			'props'=>array(
				'shoppaylog_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'shoppaylog_id',
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
