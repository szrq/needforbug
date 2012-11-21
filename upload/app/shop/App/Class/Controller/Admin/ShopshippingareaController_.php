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

		$oShopshipping=ShopshippingModel::F('shopshipping_id=?',$nShopshippingid)->getOne();
		if(empty($oShopshipping['shopshipping_id'])){
			$this->E('你指定的配送方式不存在');
		}
		
		$this->assign('oShopshipping',$oShopshipping);
	}

	public function index($sModel=null,$bDisplay=true){
		parent::index('shopshippingarea',false);

		$this->display(Admin_Extend::template('shop','shopshippingarea/index'));
	}

	public function add(){
		$this->display(Admin_Extend::template('shop','shopshippingarea/add'));
	}
	
}
