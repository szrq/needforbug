<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城购物车控制器($)*/

!defined('DYHB_PATH') && exit;

class ShopcartController extends InitController{
	
	public function index(){
		$oCart=Dyhb::instance('Cart');
		$arrCarts=$oCart->view();

		$arrShopcartsData=array();
		if(is_array($arrCarts['goods_id'])){
			foreach($arrCarts['goods_id'] as $nShopgoodsid){
				$oShopgoods=ShopgoodsModel::F('shopgoods_id=?',$nShopgoodsid)->getOne();
				if(empty($oShopgoods['shopgoods_id'])){
					// 商品不存在或者下架等等
					// 这里需要删除购物车中的商品
					$oCart->edit($nShopgoodsid,0,3);
				}else{
					if($oShopgoods['shopgoods_thumb']){
						$arrShopcartsData[$nShopgoodsid]['goods_img']=Shopgoods_Extend::getShopgoodspath($oShopgoods['shopgoods_thumb']);
					}else{
						$arrShopcartsData[$nShopgoodsid]['goods_img']=__APPPUB__.'/Images/shopgoods/default_1.jpg';
					}

					$arrShopcartsData[$nShopgoodsid]['goods_id']=$nShopgoodsid;
					$arrShopcartsData[$nShopgoodsid]['goods_name']=$arrCarts['goods_name'][$nShopgoodsid];
					$arrShopcartsData[$nShopgoodsid]['goods_price']=$arrCarts['goods_price'][$nShopgoodsid];
					$arrShopcartsData[$nShopgoodsid]['goods_count']=$arrCarts['goods_count'][$nShopgoodsid];
				}
			}
		}

		$this->assign('arrShopcartsData',$arrShopcartsData);

		// 计算商品总价格
		$arrShopcartsTotal=$oCart->countPrice();
		$this->assign('arrShopcartsTotal',$arrShopcartsTotal);

		$this->display('shopcart+index');
	}
	
	public function add(){
		$nShopgoodsnumber=intval(G::getGpc('number','P'));
		$nShopgoodsid=intval(G::getGpc('shopgoods_id','P'));
		$sShopgoodsprice=trim(G::getGpc('shopgoods_shopprice','P'));
		$sShopgoodname=trim(G::getGpc('shopgoods_name','P'));

		// 检查商品ID
		if($nShopgoodsnumber<1){
			$this->E('购买的商品数量不能为空');
		}

		if(empty($sShopgoodname)){
			$this->E('购买的商品名字不能为空');
		}

		// 检查商品
		if(empty($nShopgoodsid)){
			$this->E('你没有指定购买商品的ID');
		}

		$oShopgoods=ShopgoodsModel::F('shopgoods_id=?',$nShopgoodsid)->getOne();
		if(empty($oShopgoods['shopgoods_id'])){
			$this->E('你购买的商品不存在或者已经下架');
		}

		// 更多商品检查，比如商品库存没有了，等等，先放到后面

		// 商品进入购物车
		$oCart=Dyhb::instance('Cart');
		$oCart->addCart($nShopgoodsid,$sShopgoodname,$sShopgoodsprice,$nShopgoodsnumber);

		$this->U('shop://shopcart/index');
	}

	public function clear(){
		$oCart=Dyhb::instance('Cart');
		$oCart->clear();

		$this->S('购物车清理成功');
	}

	public function update(){
		$arrShopcartcount=G::getGpc('shopcartcount','P');

		if(empty($arrShopcartcount)){
			$this->E('购物车为空');
		}

		$oCart=Dyhb::instance('Cart');
		foreach($arrShopcartcount as $nKey=>$nValue){
			$nValue=intval($nValue);
			if($nValue<1){
				$this->E('购物车中商品数量不能少于1');
			}

			$oCart->edit($nKey,$nValue,2);
		}

		$this->S('更新购物车成功');
	}

	public function delete(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E('你没有指定待购物车待删除的商品');
		}

		$oCart=Dyhb::instance('Cart');

		if(!$oCart->checkItem($nId)){
			$this->E('购物车中不存在该商品');
		}

		$oCart->edit($nId,0,3);

		$this->S('删除购物车中的商品成功');
	}

	public function checkout(){
		// 商品结算
		$nNotlogin=intval(G::getGpc('notlogin','G'));

		if($nNotlogin==1){
			Dyhb::cookie('___notlogin___',1);
		}

		if($nNotlogin!=1 && $GLOBALS['___login___']===FALSE){
			$this->U('shop://shopcart/login');
		}else{
			// 跳转到配货地址
			$this->U('shop://shopcart/consignee');
		}
	}

	public function login(){
		// 登陆相关
		Core_Extend::loadCache('sociatype');
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
		$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);
		$this->assign('arrBindeds',$GLOBALS['_cache_']['sociatype']);

		
		$this->display('shopcart+login');
	}

	public function consignee(){
		// 配货地址

		require_once(Core_Extend::includeFile('function/Profile_Extend'));

		$this->assign('sDirthDistrict',Profile_Extend::getDistrict(array(),'shopaddress',true,''));

		$this->display('shopcart+consignee');
	}

}
