<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城支付函数库文件($)*/

!defined('DYHB_PATH') && exit;

class Shoppayment_Extend{

	static public function getPaymentrespondurl($sCode){
		return $GLOBALS['_option_']['site_url'].'/index.php?app=shop&c=paymentrespond&a=index&type='.$sCode;
	}

	static public function getPayment($sCode){
		$oShoppayment=ShoppaymentModel::F('shoppayment_code=? AND shoppayment_status=1',$sCode)->getOne();
		$oShoppayment->shoppayment_config=unserialize($oShoppayment->shoppayment_config);

		return $oShoppayment;
	}

	static public function checkMoney($nPaylogid,$nMoney){
		$oShoppaylog=ShoppaylogModel::F('shoppaylog_id=?',$nLogid)->getOne();

		if($nMoney==$oShoppaylog['shoppaylog_orderamount']){
			return true;
		}else{
			return false;
		}
	}

}
