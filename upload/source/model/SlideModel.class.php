<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   滑动幻灯片模型($)*/

!defined('DYHB_PATH') && exit;

class SlideModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'slide',
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
		$_POST['slide_title']=G::html($_POST['slide_title']);
	}

}
