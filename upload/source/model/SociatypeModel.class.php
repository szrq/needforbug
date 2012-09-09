<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化帐号模型($)*/

!defined('DYHB_PATH') && exit;

class SociatypeModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'sociatype',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function safeInput(){
		$_POST['sociatype_title']=G::html($_POST['sociatype_title']);
		$_POST['sociatype_appid']=G::html($_POST['sociatype_appid']);
		$_POST['sociatype_appkey']=G::html($_POST['sociatype_appkey']);
	}

}
