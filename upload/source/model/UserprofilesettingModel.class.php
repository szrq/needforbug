<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   用户个人信息字段配置模型($)*/

!defined('DYHB_PATH') && exit;

class UserprofilesettingModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'userprofilesetting',
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
