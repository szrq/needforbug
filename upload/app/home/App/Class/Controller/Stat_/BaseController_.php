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

	public function index_title_(){
		return '基本概况';
	}

	public function index_keywords_(){
		return $this->index_title_();
	}

	public function index_description_(){
		return $this->index_title_();
	}
	
}
