<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   博客配置模型($)*/

!defined('DYHB_PATH') && exit;

class BlogoptionModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'blogoption',
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
