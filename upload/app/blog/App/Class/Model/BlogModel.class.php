<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   博客模型($)*/

!defined('DYHB_PATH') && exit;

class BlogModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'blog',
			'props'=>array(
				'blog_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'blog_id',
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
