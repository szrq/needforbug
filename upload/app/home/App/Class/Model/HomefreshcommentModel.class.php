<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   新鲜事评论模型($)*/

!defined('DYHB_PATH') && exit;

class HomefreshcommentModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'homefreshcomment',
			'props'=>array(
				'homefreshcomment_id'=>array('readonly'=>true),
				'user'=>array(Db::BELONGS_TO=>'UserModel','source_key'=>'user_id','target_key'=>'user_id'),
			),
			'attr_protected'=>'homefreshcomment_id',
			'autofill'=>array(
				array('user_id','userId','create','callback'),
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

	protected function userId(){
		$arrUserData=$GLOBALS['___login___'];

		return $arrUserData['user_id']?$arrUserData['user_id']:0;
	}

}
