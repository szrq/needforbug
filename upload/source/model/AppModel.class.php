<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   应用模型($)*/

!defined('DYHB_PATH') && exit;

class AppModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'app',
			'props'=>array(
				'app_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'app_id',
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

	public function safeInput(){
		$_POST['app_identifier']=G::html($_POST['app_identifier']);
		$_POST['app_name']=G::html($_POST['app_name']);
		$_POST['app_author']=G::html($_POST['app_author']);

		if(isset($_POST['app_version'])){
			$_POST['app_version']=G::html($_POST['app_version']);
		}
	}

}
