<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城购物车控制器($)*/

!defined('DYHB_PATH') && exit;

class ShopcartController extends InitController{
	
	public function index(){
		$arrData=$this->getShopcartdata_();
		
		$arrShopcartsData=$arrData[0];
		$this->assign('arrShopcartsData',$arrShopcartsData);

		// 计算商品总价格
		$arrShopcartsTotal=$arrData[1];
		$this->assign('arrShopcartsTotal',$arrShopcartsTotal);

		$this->display('shopcart+index');
	}

	protected function getShopcartdata_(){
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

		// 计算商品总价格
		$arrCarts=$oCart->view();
		$arrShopcartsTotal=$oCart->countPrice();

		return array($arrShopcartsData,$arrShopcartsTotal);
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

	public function notlogin(){
		Dyhb::cookie('___notlogin___',1);

		$this->U('shop://shopcart/checkout');
	}

	public function checkout(){
		$nNotlogin=Dyhb::cookie('___notlogin___');

		if($nNotlogin!=1 && $GLOBALS['___login___']===FALSE){
			$this->U('shop://shopcart/login');
		}else{
			$arrData=$this->getShopcartdata_();
			
			$arrShopcartsData=$arrData[0];
			$this->assign('arrShopcartsData',$arrShopcartsData);

			// 计算商品总价格
			$arrShopcartsTotal=$arrData[1];
			$this->assign('arrShopcartsTotal',$arrShopcartsTotal);

			if(empty($arrShopcartsData)){
				$this->E('购物车为空，无法结算');
			}

		
			//$arrShopaddressData=Dyhb::cookie('___shopaddress___');
			//$this->assign('arrShopaddressData',$arrShopaddressData);

			// 获取支付方式
			$arrShoppayments=ShoppaymentModel::F('shoppayment_status=?',1)->getAll();
			$this->assign('arrShoppayments',$arrShoppayments);
			
			// 获取配送方式
			$arrShopshippings=ShopshippingModel::F('shopshipping_status=?',1)->getAll();
			$this->assign('arrShopshippings',$arrShopshippings);

			$this->assign('nNotlogin',$nNotlogin);

			$this->display('shopcart+checkout');
		}
	}

	public function save_consignee(){
		// 这里保存配送地址
		$arrShopaddressData=array();
		$arrShopaddressData['shopaddress_province']=trim(G::getGpc('shopaddressprovince','P'));
		$arrShopaddressData['shopaddress_city']=trim(G::getGpc('shopaddresscity','P'));
		$arrShopaddressData['shopaddress_district']=trim(G::getGpc('shopaddressdist','P'));
		$arrShopaddressData['shopaddress_community']=trim(G::getGpc('shopaddresscommunity','P'));

		$arrShopaddressData['shopaddress_handaddress']=trim(G::getGpc('shopaddress_handaddress','P'));
		$arrShopaddressData['shopaddress_consignee']=trim(G::getGpc('shopaddress_consignee','P'));

		$arrShopaddressData['shopaddress_email']=trim(G::getGpc('shopaddress_email','P'));
		$arrShopaddressData['shopaddress_address']=trim(G::getGpc('shopaddress_address','P'));

		$arrShopaddressData['shopaddress_zipcode']=intval(G::getGpc('shopaddress_zipcode','P'));
		$arrShopaddressData['shopaddress_tel']=trim(G::getGpc('shopaddress_tel','P'));
		$arrShopaddressData['shopaddress_mobile']=trim(G::getGpc('shopaddress_mobile','P'));
		$arrShopaddressData['shopaddress_signbuilding']=trim(G::getGpc('shopaddress_signbuilding','P'));

		$arrShopaddressData['shopaddress_besttime']=trim(G::getGpc('shopaddress_besttime','P'));

		$arrShopaddressData['shopaddress_id']=intval(G::getGpc('shopaddress_id','P'));
	

		if(isset($_POST['shopaddress_consignee'])){
			// 使用cookie临时保存数据
			Dyhb::cookie('___shopaddress___',$arrShopaddressData);
		}

		Dyhb::cookie('___shopconsignee___',1);

		$this->A($arrShopaddressData,'地址保存成功',1);
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

	public function indb(){
		if($GLOBALS['___login___']===false){
			$this->E('你没有登录无法保存购物车');
		}
	}

	public function done(){
		// 生成订单
		//echo '生成订单';

		//G::dump($_POST);

		// 订单入库

		// 读取并且检查购物车中的商品
		$arrShopcarTempdata=$this->getShopcartdata_();
		$arrShopcartsData=$arrShopcarTempdata[0];
		$arrShopcartsTotal=$arrShopcarTempdata[1];// 计算商品总价格
		
		if(empty($arrShopcartsData)){
			$this->E('购物车中的商品为空');
		}
		//G::dump($arrShopcartsData);

		// 商品库存检查
		// 暂无不做，等哈做

		// 用户登陆,如果不是不直接登录购买，则跳转到登录地址
		$nNotlogin=Dyhb::cookie('___notlogin___');
		if($nNotlogin!=1 && $GLOBALS['___login___']===FALSE){
			$this->U('home://public/login');
		}

		// 收货人信息
		$arrShopaddressData=Dyhb::cookie('___shopaddress___');
		if(empty($arrShopaddressData['shopaddress_consignee'])){
			$this->assign('__JumpUrl__',Dyhb::U('shop://shopcart/consignee'));
			$this->E('收货人信息不完整');
		}

		// 生成商品订单入库信息
		$_POST['shoporderinfo_postscript']=isset($_POST['shoporderinfo_postscript'])?htmlspecialchars($_POST['shoporderinfo_postscript']):'';
		$_POST['shoporderinfo_howoos']=isset($_POST['shoporderinfo_howoos'])?intval($_POST['shoporderinfo_howoos']):0;
		
		$arrShoporderinfo=array();
		
		$arrShoporderinfo['shoporderinfo_sn']=date('Ymd',CURRENT_TIMESTAMP).G::randString(10);

		$arrShoporderinfo['shoporderinfo_consignee']=$arrShopaddressData['shopaddress_consignee'];
		//$arrShoporderinfo['shoporderinfo_country']='中国';
		$arrShoporderinfo['shoporderinfo_province']=$arrShopaddressData['shopaddress_province'];
		$arrShoporderinfo['shoporderinfo_city']=$arrShopaddressData['shopaddress_city'];
		$arrShoporderinfo['shoporderinfo_district']=$arrShopaddressData['shopaddress_district'];
		$arrShoporderinfo['shoporderinfo_community']=$arrShopaddressData['shopaddress_community'];
		$arrShoporderinfo['shoporderinfo_address']=$arrShopaddressData['shopaddress_address'];
		$arrShoporderinfo['shoporderinfo_zipcode']=$arrShopaddressData['shopaddress_zipcode'];
		$arrShoporderinfo['shoporderinfo_tel']=$arrShopaddressData['shopaddress_tel'];
		$arrShoporderinfo['shoporderinfo_mobile']=$arrShopaddressData['shopaddress_mobile'];
		$arrShoporderinfo['shoporderinfo_email']=$arrShopaddressData['shopaddress_email'];
		$arrShoporderinfo['shoporderinfo_besttime']=$arrShopaddressData['shopaddress_besttime'];
		$arrShoporderinfo['shoporderinfo_signbuilding']=$arrShopaddressData['shopaddress_signbuilding'];


		// --------- 根据配送方式取得配送方式名字
		$nShopshippingid=intval(G::getGpc('shopshipping_id','P'));
		if(empty($nShopshippingid)){
			$this->E('你没有选择任何配送方式');
		}

		$oShopshipping=ShopshippingModel::F('shopshipping_id=? AND shopshipping_status=1',$nShopshippingid)->getOne();
		if(empty($oShopshipping['shopshipping_id'])){
			$this->E('你选择的配送方式不存在或者尚未启用');
		}

		$arrShoporderinfo['shoporderinfo_shippingname']=$oShopshipping['shopshipping_name'];

		// 取得支付方式
		$nShoppaymentid=intval(G::getGpc('shoppayment_id','P'));
		if(empty($nShoppaymentid)){
			$this->E('你没有选择任何支付方式');
		}

		$oShoppayment=ShoppaymentModel::F('shoppayment_id=? AND shoppayment_status=1',$nShoppaymentid)->getOne();
		if(empty($oShoppayment['shoppayment_id'])){
			$this->E('你选择的支付方式不存在或者尚未启用');
		}

		$arrShoporderinfo['shoporderinfo_paymentname']=$oShoppayment['shoppayment_name'];


		// 商品价格
		$arrShoporderinfo['shoporderinfo_goodsamount']=$arrShopcartsTotal['goods_price'];

		// 配送费用
		$arrShoporderinfo['shoporderinfo_shippingfee']=0;
		$arrShoporderinfo['shoporderinfo_insurefee']=0;

		// 支付费用
		$arrShoporderinfo['shoporderinfo_payfee']=0;

		// 包装费用
		$arrShoporderinfo['shoporderinfo_packfee']=0;



		// 商品订单入库
		$oShoporderinfo=new ShoporderinfoModel();
		$oShoporderinfo->changeProp($arrShoporderinfo);
		$oShoporderinfo->save(0);

		if($oShoporderinfo->isError()){
			$this->E($oShoporderinfo->getErrorMessage());
		}

		// 订单商品入库
		//G::dump($arrShopcartsData);
		if(!empty($arrShopcartsData)){
			foreach($arrShopcartsData as $arrShopcart){
				// 
				$oShopgoods=ShopgoodsModel::F('shopgoods_id=?',$arrShopcart['goods_id'])->getOne();
				if(empty($oShopgoods['shopgoods_id'])){
					$this->E('购物车中的商品不存在');
				}

				$oShopordergoods=new ShopordergoodsModel();
				$oShopordergoods->shoporderinfo_id=$oShoporderinfo->shoporderinfo_id;
				$oShopordergoods->shopgoods_id=$arrShopcart['goods_id'];
				$oShopordergoods->shopordergoods_goodsname=$oShopgoods->shopgoods_name;
				$oShopordergoods->shopordergoods_goodssn=$oShopgoods->shopgoods_sn;
				$oShopordergoods->shopordergoods_goodsnumber=$oShopgoods->shopgoods_number;
				$oShopordergoods->shopordergoods_price=$oShopgoods->shopgoods_price;
				$oShopordergoods->shopordergoods_shopprice=$oShopgoods->shopgoods_shopprice;
				$oShopordergoods->shopordergoods_isreal=$oShopgoods->shopgoods_isreal;
				$oShopordergoods->shopordergoods_parentid=$oShopgoods->shopgoods_parentid;
				$oShopordergoods->save(0);

				if($oShopordergoods->isError()){
					$this->E($oShopordergoods->getErrorMessage());
				}
			}
		}

		// 支付日志
		$oShoppaylog=new ShoppaylogModel();
		$oShoppaylog->shoporderinfo_id=$oShoporderinfo['shoporderinfo_id'];
		$oShoppaylog->shoppaylog_orderamount=$oShoporderinfo['shoporderinfo_orderamount'];
		$oShoppaylog->save(0);

		if($oShoppaylog->isError()){
			$this->E($oShoppaylog->getErrorMessage());
		}

		// 支付按钮
		require(APP_PATH.'/App/Class/Extension/Payment/'.strtolower($oShoppayment['shoppayment_code']).'/'.ucfirst($oShoppayment['shoppayment_code']).'_.php');
			
		$oShoppaymentapi=Dyhb::instance(ucfirst($oShoppayment['shoppayment_code']).'_Payment');
		$sShoppaymentReturnhtml=$oShoppaymentapi->paymentCode($oShoppayment,$oShoporderinfo);

		// 商品库存变更

		// 清理购物车等等

		// 支付记录

		// 显示当前订单号

		// 如果在线支付，提供在线支付的按钮

		// 订单结束


		$this->assign('oShoporderinfo',$oShoporderinfo);
		$this->assign('oShopshipping',$oShopshipping);
		$this->assign('oShoppayment',$oShoppayment);
		$this->assign('sShoppaymentReturnhtml',$sShoppaymentReturnhtml);

		$this->display('shopcart+done');
	}

	public function clearnotlogin(){
		Dyhb::cookie('___notlogin___',null,-1);

		$this->S('清除不登录直接购买状态');
	}

	public function shopaddress(){
		// 配货地址
		require_once(Core_Extend::includeFile('function/Profile_Extend'));
		$this->assign('sDirthDistrict',Profile_Extend::getDistrict(array(),'shopaddress',true,''));

		$this->display('shopcart+address');
	}

}
