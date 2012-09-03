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
				array('homefreshcomment_ip','getIp','create','callback'),
			),
			'check'=>array(
				'homefreshcomment_name'=>array(
					array('require',Dyhb::L('评论名字不能为空','__APP_ADMIN_LANG__@Model/Homefreshcomment')),
					array('max_length',25,Dyhb::L('评论名字的最大字符数为25','__APP_ADMIN_LANG__@Model/Homefreshcomment'))
				),
				'homefreshcomment_email'=>array(
					array('empty'),
					array('max_length',300,Dyhb::L('评论Email 最大字符数为300','__APP_ADMIN_LANG__@Model/Homefreshcomment')),
					array('email',Dyhb::L('评论的邮件必须为正确的Email 格式','__APP_ADMIN_LANG__@Model/Homefreshcomment'))
				),
				'homefreshcomment_url'=>array(
					array('empty'),
					array('max_length',300,Dyhb::L('评论URL 最大字符数为300','__APP_ADMIN_LANG__@Model/Homefreshcomment')),
					array('url',Dyhb::L('评论的邮件必须为正确的URL 格式','__APP_ADMIN_LANG__@Model/Homefreshcomment'))
				),
				'homefreshcomment_content'=>array(
					array('require',Dyhb::L('评论的内容不能为空','__APP_ADMIN_LANG__@Model/Homefreshcomment'))
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

	protected function userId(){
		$arrUserData=$GLOBALS['___login___'];

		return $arrUserData['user_id']?$arrUserData['user_id']:0;
	}

	protected function getIp(){
		return G::getIp();
	}

	public function safeInput(){
		if(isset($_POST['homefreshcomment_content'])){
			$_POST['homefreshcomment_content']=G::html($_POST['homefreshcomment_content']);
		}
	}

}
