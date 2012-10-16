<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组首页控制器($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		Core_Extend::loadCache('sociatype');

		$sType=G::getGpc('type','G');
		if(empty($sType)){
			$sType='create_dateline';
		}elseif($sType=="view"){
			$sType='grouptopic_views';
		}elseif($sType=="com"){
			$sType='grouptopic_comments';
		}else{
			$sType='create_dateline';
		}
		$this->assign('sType',$sType);

		$arrWhere=array();
		$nEverynum=$GLOBALS['_cache_']['group_option']['group_indextopicnum'];
		$arrWhere['grouptopic_status']=1;
		$arrWhere['grouptopic_isaudit']=1;
		$nTotalRecord=GrouptopicModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,$nEverynum,G::getGpc('page','G'));

		$arrGrouptopics=GrouptopicModel::F()->where($arrWhere)->order("{$sType} DESC")->limit($oPage->returnPageStart(),$nEverynum)->getAll();
		$this->assign('arrGrouptopics',$arrGrouptopics);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));

		$arrGrouptopic=GrouptopicModel::F()->order('grouptopic_comments DESC')->top(5)->get();
		$this->assign('arrGrouptopic',$arrGrouptopic);

		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
		$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);
		$this->assign('arrBindeds',$GLOBALS['_cache_']['sociatype']);

		$this->display('public+index');
	}

	public function group(){
		$arrGroupcategorys=GroupcategoryModel::F('groupcategory_parentid=?',0)->getAll();
		$this->assign('arrGroupcategorys',$arrGroupcategorys);

		$this->display('public+group');
	}

	public function add(){
		$this->display('public+add');
	}

	public function unserialize($slatestcomment){
		$arrLatestcomment=unserialize($slatestcomment);
		return $arrLatestcomment;
	}
}
