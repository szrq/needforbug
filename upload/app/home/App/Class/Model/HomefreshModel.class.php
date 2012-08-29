<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   新鲜事模型($)*/

!defined('DYHB_PATH') && exit;

class HomefreshModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'homefresh',
			'props'=>array(
				'homefresh_id'=>array('readonly'=>true),
				'user'=>array(Db::BELONGS_TO=>'UserModel','source_key'=>'user_id','target_key'=>'user_id'),
			),
			'attr_protected'=>'homefresh_id',
			'autofill'=>array(
				array('user_id','userId','create','callback'),
				array('homefresh_ip','homefreshIp','create','callback'),
			),
			'check'=>array(
				'homefresh_message'=>array(
					array('require',Dyhb::L('新鲜事内容不能为空','__APP_ADMIN_LANG__@Model/Homefresh')),
					array('max_length',100000,Dyhb::L('新鲜事内容最大长度为100000','__APP_ADMIN_LANG__@Model/Homefresh'))
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
	
	protected function homefreshIp(){
		return G::getIp();
	}

	public function getHomefreshComments($nHomefreshId){
		if(empty($nHomefreshId)){
			return 0;
		}

		return HomecommentModel::F('homefresh_id=?',$nHomefreshId)->all()->getCounts();
	}	
	
	public function safeInput(){
		if(isset($_POST['homefresh_message'])){
			$_POST['homefresh_message']=G::cleanJs($_POST['homefresh_message']);
		}
	}
	

}
