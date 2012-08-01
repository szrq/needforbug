<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   短消息模型($)*/

!defined('DYHB_PATH') && exit;

class PmModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'pm',
			'props'=>array(
				'pm_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'pm_id',
			'check'=>array(
				'pm_message'=>array(
					array('require',Dyhb::L('短消息内容不能为空','__COMMON_LANG__@Model/Pm')),
					array('max_length',1000,Dyhb::L('短消息内容最大长度为1000个字符','__COMMON_LANG__@Model/Pm')),
				),
				'pm_subject'=>array(
					array('empty'),
					array('max_length',1000,Dyhb::L('短消息主题最大长度为225个字符','__COMMON_LANG__@Model/Pm')),
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

	public function sendAPm($sMessageto,$nUserId,$sUserName,$sSubject='',$sApp=''){
		$oUser=UserModel::F()->getByuser_name($sMessageto);
		
		$oPm=new self();
		$oPm->pm_msgfrom=$sUserName;
		$oPm->pm_msgfromid=$nUserId;
		$oPm->pm_msgtoid=$oUser['user_id'];
		$oPm->pm_status=1;
		$oPm->pm_subject=$sSubject;
		$oPm->pm_fromapp=$sApp;
		$oPm->save(0);
		
		if($oPm->isError()){
			$this->setErrorMessage($oPm->setErrorMessage());
			return false;
		}else{
			return $oPm;
		}
	}

}
