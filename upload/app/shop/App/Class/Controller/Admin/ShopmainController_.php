<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城入口控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入商城模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/shop/App/Class/Model');

class ShopmainController extends InitController{
	
	public function index($sModel=null,$bDisplay=true){
		$this->display(Admin_Extend::template('shop','shopoption/index'));
	}
	
	public function update_option(){
		$arrOptions=G::getGpc('options','P');
		
		foreach($arrOptions as $key=>$val){
			$val=trim($val);
			$oShopoption=ShopoptionModel::F("shopoption_name=?",$key)->getOne();
			$oShopoption->shopoption_value=G::html($val);
			$oShopoption->save(0,'update');
		}
		
		ShopCache_Extend::updateCacheOption("option");
		$this->S("配置更新成功");
	}
}