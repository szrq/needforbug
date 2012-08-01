<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   菜单模型($)*/

!defined('DYHB_PATH') && exit;

class NavModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'nav',
			'props'=>array(
				'nav_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'nav_id',
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
		$_POST['nav_name']=G::html($_POST['nav_name']);
		$_POST['nav_title']=G::html($_POST['nav_title']);
		$_POST['nav_url']=G::html($_POST['nav_url']);
	}

}
