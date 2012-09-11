<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组帖子模型($)*/

!defined('DYHB_PATH') && exit;

class GrouptopicModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'grouptopic',
			'props'=>array(
				'grouptopic_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'grouptopic_id',
			'autofill'=>array(
				array('user_id','userId','create','callback'),
			),
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
	}

	protected function userId(){
		$nUserId=$GLOBALS['___login___']['user_id'];

		return $nUserId>0?$nUserId:0;
	}

}
