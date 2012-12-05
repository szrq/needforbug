<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城订单函数库文件($)*/

!defined('DYHB_PATH') && exit;

class Shoporder_Extend{

	public static function getShopaddressto($arrShopaddressData){
		if(!empty($arrShopaddressData['shopaddress_handaddress'])){
			$sShopaddressto=$arrShopaddressData['shopaddress_handaddress'];
		}else{
			$sShopaddressto=$arrShopaddressData['shopaddress_province'].' '.
				(!empty($arrShopaddressData['shopaddress_city'])?$arrShopaddressData['shopaddress_city'].' ':'').
				(!empty($arrShopaddressData['shopaddress_district'])?$arrShopaddressData['shopaddress_district'].' ':'').
				(!empty($arrShopaddressData['shopaddress_community'])?$arrShopaddressData['shopaddress_community'].' ':'');
		}

		return $sShopaddressto;
	}

	public static function getShopaddressdistrict($sName,$arrCookiedata){
		if(isset($_POST['shopaddress'.$sName])){
			$sDistrict=trim(G::getGpc('shopaddress'.$sName,'P'));
		}else{
			$sDistrict=!empty($arrCookiedata['shopaddress_'.$sName])?$arrCookiedata['shopaddress_'.$sName]:'';
		}

		return $sDistrict;
	}

	public static function getShopaddressdistrictTwo($arrShopaddressData){
		$arrDistrictdata=array();
		foreach(array('province','city','district','community') as $sDistrict){
			if(!empty($arrShopaddressData['shopaddress_'.$sDistrict])){
				$arrDistrictdata['shopaddress'.$sDistrict]=$arrShopaddressData['shopaddress_'.$sDistrict];
			}
		}

		require_once(Core_Extend::includeFile('function/Profile_Extend'));
		$sDistrict=Profile_Extend::getDistrict($arrDistrictdata,'shopaddress',true,'',false);

		return $sDistrict;
	}

	public static function getShoppaymentreturnhtml($oShoppayment){
		$sShoppaymentcode=strtolower($oShoppayment['shoppayment_code']);

		require(APP_PATH.'/App/Class/Extension/Payment/'.$sShoppaymentcode.'/'.ucfirst($sShoppaymentcode).'_.php');
			
		$oShoppaymentapi=Dyhb::instance(ucfirst($sShoppaymentcode).'_Payment');
		$sShoppaymentReturnhtml=$oShoppaymentapi->paymentCode($oShoppayment,$oShoporderinfo);

		return $sShoppaymentReturnhtml;
	}

	public static function getShopcartdata(){
		$oCart=Dyhb::instance('Cart');
		$arrCarts=$oCart->view();

		$arrShopcartsData=array();
		if(is_array($arrCarts['goods_id'])){
			foreach($arrCarts['goods_id'] as $nShopgoodsid){
				$oShopgoods=ShopgoodsModel::F('shopgoods_id=? AND shopgoods_isonsale=1',$nShopgoodsid)->getOne();
				if(empty($oShopgoods['shopgoods_id'])){
					// 商品不存在或者下架等等 && 删除购物车中的商品
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

	public static function getShoporderinfosn(){
		return date('Ymd',CURRENT_TIMESTAMP).G::randString(10);
	}

	public static function orderinfoFee($arrShoporderinfo){
		$arrTotalprice=array(
			'real_goods_count'=>0,
			'gift_amount'=>0,
			'goods_price'=>0,
			'market_price'=>0,
			'discount'=>0,
			'shipping_fee'=>0,
			'shipping_insure'=>0,
			'integral_money'=>0,
			'bonus'=>0,
			'surplus'=>0,
			'cod_fee'=>0,
			'pay_fee'=>0,
			'tax'=>0
		);

		$nShopgoodsweight=0;

		exit();









		/* 商品总价 */
		foreach ($goods AS $val)
		{
			/* 统计实体商品的个数 */
			if ($val['is_real'])
			{
				$total['real_goods_count']++;
			}

			$total['goods_price']  += $val['goods_price'] * $val['goods_number'];
			$total['market_price'] += $val['market_price'] * $val['goods_number'];
		}

		$total['saving']    = $total['market_price'] - $total['goods_price'];
		$total['save_rate'] = $total['market_price'] ? round($total['saving'] * 100 / $total['market_price']) . '%' : 0;

		$total['goods_price_formated']  = price_format($total['goods_price'], false);
		$total['market_price_formated'] = price_format($total['market_price'], false);
		$total['saving_formated']       = price_format($total['saving'], false);

		/* 折扣 */
		if ($order['extension_code'] != 'group_buy')
		{
			$discount = compute_discount();
			$total['discount'] = $discount['discount'];
			if ($total['discount'] > $total['goods_price'])
			{
				$total['discount'] = $total['goods_price'];
			}
		}
		$total['discount_formated'] = price_format($total['discount'], false);

		/* 税额 */
		if (!empty($order['need_inv']) && $order['inv_type'] != '')
		{
			/* 查税率 */
			$rate = 0;
			foreach ($GLOBALS['_CFG']['invoice_type']['type'] as $key => $type)
			{
				if ($type == $order['inv_type'])
				{
					$rate = floatval($GLOBALS['_CFG']['invoice_type']['rate'][$key]) / 100;
					break;
				}
			}
			if ($rate > 0)
			{
				$total['tax'] = $rate * $total['goods_price'];
			}
		}
		$total['tax_formated'] = price_format($total['tax'], false);

		/* 包装费用 */
		if (!empty($order['pack_id']))
		{
			$total['pack_fee']      = pack_fee($order['pack_id'], $total['goods_price']);
		}
		$total['pack_fee_formated'] = price_format($total['pack_fee'], false);

		/* 贺卡费用 */
		if (!empty($order['card_id']))
		{
			$total['card_fee']      = card_fee($order['card_id'], $total['goods_price']);
		}
		$total['card_fee_formated'] = price_format($total['card_fee'], false);

		/* 红包 */

		if (!empty($order['bonus_id']))
		{
			$bonus          = bonus_info($order['bonus_id']);
			$total['bonus'] = $bonus['type_money'];
		}
		$total['bonus_formated'] = price_format($total['bonus'], false);

		/* 线下红包 */
		 if (!empty($order['bonus_kill']))
		{
			$bonus          = bonus_info(0,$order['bonus_kill']);
			$total['bonus_kill'] = $order['bonus_kill'];
			$total['bonus_kill_formated'] = price_format($total['bonus_kill'], false);
		}



		/* 配送费用 */
		$shipping_cod_fee = NULL;

		if ($order['shipping_id'] > 0 && $total['real_goods_count'] > 0)
		{
			$region['country']  = $consignee['country'];
			$region['province'] = $consignee['province'];
			$region['city']     = $consignee['city'];
			$region['district'] = $consignee['district'];
			$shipping_info = shipping_area_info($order['shipping_id'], $region);

			if (!empty($shipping_info))
			{
				if ($order['extension_code'] == 'group_buy')
				{
					$weight_price = cart_weight_price(CART_GROUP_BUY_GOODS);
				}
				else
				{
					$weight_price = cart_weight_price();
				}

				// 查看购物车中是否全为免运费商品，若是则把运费赋为零
				$sql = 'SELECT count(*) FROM ' . $GLOBALS['ecs']->table('cart') . " WHERE  `session_id` = '" . SESS_ID. "' AND `extension_code` != 'package_buy' AND `is_shipping` = 0";
				$shipping_count = $GLOBALS['db']->getOne($sql);

				$total['shipping_fee'] = ($shipping_count == 0 AND $weight_price['free_shipping'] == 1) ?0 :  shipping_fee($shipping_info['shipping_code'],$shipping_info['configure'], $weight_price['weight'], $total['goods_price'], $weight_price['number']);

				if (!empty($order['need_insure']) && $shipping_info['insure'] > 0)
				{
					$total['shipping_insure'] = shipping_insure_fee($shipping_info['shipping_code'],
						$total['goods_price'], $shipping_info['insure']);
				}
				else
				{
					$total['shipping_insure'] = 0;
				}

				if ($shipping_info['support_cod'])
				{
					$shipping_cod_fee = $shipping_info['pay_fee'];
				}
			}
		}

		$total['shipping_fee_formated']    = price_format($total['shipping_fee'], false);
		$total['shipping_insure_formated'] = price_format($total['shipping_insure'], false);

		// 购物车中的商品能享受红包支付的总额
		$bonus_amount = compute_discount_amount();
		// 红包和积分最多能支付的金额为商品总额
		$max_amount = $total['goods_price'] == 0 ? $total['goods_price'] : $total['goods_price'] - $bonus_amount;

		/* 计算订单总额 */
		if ($order['extension_code'] == 'group_buy' && $group_buy['deposit'] > 0)
		{
			$total['amount'] = $total['goods_price'];
		}
		else
		{
			$total['amount'] = $total['goods_price'] - $total['discount'] + $total['tax'] + $total['pack_fee'] + $total['card_fee'] +
				$total['shipping_fee'] + $total['shipping_insure'] + $total['cod_fee'];

			// 减去红包金额
			$use_bonus        = min($total['bonus'], $max_amount); // 实际减去的红包金额
			if(isset($total['bonus_kill']))
			{
				$use_bonus_kill   = min($total['bonus_kill'], $max_amount);
				$total['amount'] -=  $price = number_format($total['bonus_kill'], 2, '.', ''); // 还需要支付的订单金额
			}

			$total['bonus']   = $use_bonus;
			$total['bonus_formated'] = price_format($total['bonus'], false);

			$total['amount'] -= $use_bonus; // 还需要支付的订单金额
			$max_amount      -= $use_bonus; // 积分最多还能支付的金额

		}

		/* 余额 */
		$order['surplus'] = $order['surplus'] > 0 ? $order['surplus'] : 0;
		if ($total['amount'] > 0)
		{
			if (isset($order['surplus']) && $order['surplus'] > $total['amount'])
			{
				$order['surplus'] = $total['amount'];
				$total['amount']  = 0;
			}
			else
			{
				$total['amount'] -= floatval($order['surplus']);
			}
		}
		else
		{
			$order['surplus'] = 0;
			$total['amount']  = 0;
		}
		$total['surplus'] = $order['surplus'];
		$total['surplus_formated'] = price_format($order['surplus'], false);

		/* 积分 */
		$order['integral'] = $order['integral'] > 0 ? $order['integral'] : 0;
		if ($total['amount'] > 0 && $max_amount > 0 && $order['integral'] > 0)
		{
			$integral_money = value_of_integral($order['integral']);

			// 使用积分支付
			$use_integral            = min($total['amount'], $max_amount, $integral_money); // 实际使用积分支付的金额
			$total['amount']        -= $use_integral;
			$total['integral_money'] = $use_integral;
			$order['integral']       = integral_of_value($use_integral);
		}
		else
		{
			$total['integral_money'] = 0;
			$order['integral']       = 0;
		}
		$total['integral'] = $order['integral'];
		$total['integral_formated'] = price_format($total['integral_money'], false);

		/* 保存订单信息 */
		$_SESSION['flow_order'] = $order;

		$se_flow_type = isset($_SESSION['flow_type']) ? $_SESSION['flow_type'] : '';
		
		/* 支付费用 */
		if (!empty($order['pay_id']) && ($total['real_goods_count'] > 0 || $se_flow_type != CART_EXCHANGE_GOODS))
		{
			$total['pay_fee']      = pay_fee($order['pay_id'], $total['amount'], $shipping_cod_fee);
		}

		$total['pay_fee_formated'] = price_format($total['pay_fee'], false);

		$total['amount']           += $total['pay_fee']; // 订单总额累加上支付费用
		$total['amount_formated']  = price_format($total['amount'], false);

		/* 取得可以得到的积分和红包 */
		if ($order['extension_code'] == 'group_buy')
		{
			$total['will_get_integral'] = $group_buy['gift_integral'];
		}
		elseif ($order['extension_code'] == 'exchange_goods')
		{
			$total['will_get_integral'] = 0;
		}
		else
		{
			$total['will_get_integral'] = get_give_integral($goods);
		}
		$total['will_get_bonus']        = $order['extension_code'] == 'exchange_goods' ? 0 : price_format(get_total_bonus(), false);
		$total['formated_goods_price']  = price_format($total['goods_price'], false);
		$total['formated_market_price'] = price_format($total['market_price'], false);
		$total['formated_saving']       = price_format($total['saving'], false);

		if ($order['extension_code'] == 'exchange_goods')
		{
			$sql = 'SELECT SUM(eg.exchange_integral) '.
				   'FROM ' . $GLOBALS['ecs']->table('cart') . ' AS c,' . $GLOBALS['ecs']->table('exchange_goods') . 'AS eg '.
				   "WHERE c.goods_id = eg.goods_id AND c.session_id= '" . SESS_ID . "' " .
				   "  AND c.rec_type = '" . CART_EXCHANGE_GOODS . "' " .
				   '  AND c.is_gift = 0 AND c.goods_id > 0 ' .
				   'GROUP BY eg.goods_id';
			$exchange_integral = $GLOBALS['db']->getOne($sql);
			$total['exchange_integral'] = $exchange_integral;
		}

		return $total;
		echo '$arrShoporderinfo';
	}

}
