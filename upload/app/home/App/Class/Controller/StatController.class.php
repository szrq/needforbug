<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   站点统计显示($)*/

!defined('DYHB_PATH') && exit;

class StatController extends InitController{

	public function index(){
		Core_Extend::loadCache('site');

		$this->assign('arrSite',$GLOBALS['_cache_']['site']);

		$this->display('stat+base');
	}
	
	public function userlist(){
		require_once(Core_Extend::includeFile('function/Profile_Extend'));

		$arrWhere=array();
		
		$sKey=trim(G::getGpc('key'));
		if(!empty($sKey)){
			$arrWhere['user_name']=array('like',"%".$sKey."%");
		}
		
		$sSortBy=strtoupper(G::getGpc('sort_'))=='ASC'?'ASC':'DESC';
		$sOrder=G::getGpc('order_','G')?G::getGpc('order_','G'):'create_dateline';

		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		// 用户列表
		$nTotalRecord=UserModel::F()->where($arrWhere)->all()->getCounts();

		$oPage=Page::RUN($nTotalRecord,$arrOptionData['user_list_num'],G::getGpc('page','G'));

		$arrUsers=UserModel::F()->where($arrWhere)->order($sOrder.' '.$sSortBy)->limit($oPage->returnPageStart(),$arrOptionData['user_list_num'])->getAll();
		$this->assign('arrUsers',$arrUsers);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('sKey',$sKey);
		
		$this->display('stat+userlist');
	}
	
}
