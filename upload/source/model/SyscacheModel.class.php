<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   缓存模型($)*/

!defined('DYHB_PATH') && exit;

class SyscacheModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'syscache',
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
