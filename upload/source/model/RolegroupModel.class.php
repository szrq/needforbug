<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   角色分组模型($)*/

!defined('DYHB_PATH') && exit;

class RolegroupModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'rolegroup',
			'props'=>array(
				'rolegroup_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'rolegroup_id',
			'check'=>array(
				'rolegroup_name'=>array(
					array('require',Dyhb::L('组名不能为空','__COMMON_LANG__@Model/Rolegroup')),
					array('number_underline_english',Dyhb::L('组名只能是由数字，下划线，字母组成','__COMMON_LANG__@Model/Rolegroup')),
					array('rolegroupName',Dyhb::L('组名已经存在','__COMMON_LANG__@Model/Rolegroup'),'condition'=>'must','extend'=>'callback'),
				),
				'rolegroup_title'=>array(
					array('require',Dyhb::L('组显示名不能为空','__COMMON_LANG__@Model/Rolegroup')),
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

	public function rolegroupName(){
		$nId=G::getGpc('id','P');

		$sRolegroupName=G::getGpc('rolegroup_name','P');
		$sRolegroupInfo='';

		if($nId){
			$arrRolegroup=self::F('rolegroup_id=?',$nId)->asArray()->getOne();
			$sRolegroupInfo=trim($arrRolegroup['rolegroup_name']);
		}

		if($sRolegroupName !=$sRolegroupInfo){
			$arrResult=self::F()->getByrolegroup_name($sRolegroupName)->toArray();
			if(!empty($arrResult['rolegroup_id'])){
				return false;
			}else{
				return true;
			}
		}

		return true;
	}

	public function safeInput(){
		if(isset($_POST['rolegroup_name'])){
			$_POST['rolegroup_name']=G::html($_POST['rolegroup_name']);
		}

		$_POST['rolegroup_title']=G::html($_POST['rolegroup_title']);
	}

}
