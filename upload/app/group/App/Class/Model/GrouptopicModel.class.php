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
				'grouptopiccategory'=>array(Db::BELONGS_TO=>'GrouptopiccategoryModel','source_key'=>'grouptopiccategory_id','target_key'=>'grouptopiccategory_id'),
				'userprofile'=>array(Db::BELONGS_TO=>'UserprofileModel','source_key'=>'user_id','target_key'=>'user_id'),
				'grouptopiccategory'=>array(Db::BELONGS_TO=>'GrouptopiccategoryModel','source_key'=>'grouptopiccategory_id','target_key'=>'grouptopiccategory_id'),
				'group'=>array(Db::BELONGS_TO=>'GroupModel','source_key'=>'group_id','target_key'=>'group_id'),
			),
			'attr_protected'=>'grouptopic_id',
			'autofill'=>array(
				array('user_id','userId','create','callback'),
				array('grouptopic_username','userName','create','callback'),
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
	
	protected function userName(){
		$sUserName=$GLOBALS['___login___']['user_name'];

		return $sUserName?$sUserName:Dyhb::L('佚名','Model/Grouptopic');
	}

}
