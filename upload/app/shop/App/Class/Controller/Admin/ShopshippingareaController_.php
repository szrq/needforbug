<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商品配送方式区域控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入商城模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/shop/App/Class/Model');

class ShopshippingareaController extends InitController{

	public function filter_(&$arrMap){
		$nShopshippingid=intval(G::getGpc('sid','G'));
		if(empty($nShopshippingid)){
			$this->E('你没有指定配送方方式');
		}
	}

	public function index($sModel=null,$bDisplay=true){
		parent::index('shopshippingarea',false);

		$this->display(Admin_Extend::template('shop','shopshippingarea/index'));
	}
	
}
