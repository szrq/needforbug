<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   后台快捷菜单模型($)*/

!defined('DYHB_PATH') && exit;

class AdminctrlmenuModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'adminctrlmenu',
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
