<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   文件归类(专辑)模型($)*/

!defined('DYHB_PATH') && exit;

class AttachmentcategoryModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'attachmentcategory',
			'props'=>array(
				'attachmentcategory_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'attachmentcategory_id',
			'autofill'=>array(
				array('user_id','userId','create','callback'),
				array('attachmentcategory_username','userName','create','callback'),
			),
			'check'=>array(
				'attachment_name'=>array(
					array('require',Dyhb::L('附件名不能为空','__COMMON_LANG__@Model/Attachment')),
					array('max_length',100,Dyhb::L('附件名最大长度为100个字符','__COMMON_LANG__@Model/Attachment')),
				),
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

	public function getAttachmentcategoryByUserid($nUserid){
		return self::F('user_id=?',$nUserid)->getAll();
	}

	protected function userId(){
		return intval($GLOBALS['___login___']['user_id']);
	}

	protected function userName(){
		return $GLOBALS['___login___']['user_name'];
	}

}
