<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   用户动态模型($)*/

!defined('DYHB_PATH') && exit;

class FeedModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'feed',
			'props'=>array(
				'feed_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'feed_id',
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
