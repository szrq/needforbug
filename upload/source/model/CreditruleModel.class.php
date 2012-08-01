<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   积分规则模型($)*/

!defined('DYHB_PATH') && exit;

class CreditruleModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'creditrule',
			'props'=>array(
				'creditrule_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'creditrule_id',
			'check'=>array(
			),
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
