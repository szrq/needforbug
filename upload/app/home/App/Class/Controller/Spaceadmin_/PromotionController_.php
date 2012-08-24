<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   访问推广($)*/

!defined('DYHB_PATH') && exit;

class PromotionController extends Controller{

	public function index(){
		$this->assign('nUserId',Core_Extend::aidencode(intval($GLOBALS['___login___']['user_id'])));
		$this->assign('sUserName',rawurlencode(trim($GLOBALS['___login___']['user_name'])));
		$this->assign('sSiteName',$GLOBALS['_option_']['site_name']);
		$this->assign('sSiteUrl',$GLOBALS['_option_']['site_url']);

		$this->display('spaceadmin+promotion');
	}

}
