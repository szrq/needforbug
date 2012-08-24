<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   站点基本信息($)*/

!defined('DYHB_PATH') && exit;

class BaseController extends Controller{

	public function index(){
		Core_Extend::loadCache('site');

		$this->assign('arrSite',$GLOBALS['_cache_']['site']);

		$this->display('stat+base');
	}
	
}
