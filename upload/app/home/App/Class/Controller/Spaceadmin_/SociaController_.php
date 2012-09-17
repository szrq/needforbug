<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化帐号管理($)*/

!defined('DYHB_PATH') && exit;

// 导入社会化登录组件
Dyhb::import(NEEDFORBUG_PATH.'/source/extension/socialization');

class SociaController extends Controller{

	public function index(){
		Socia::clearCookie();
		Core_Extend::loadCache('sociatype');

		$arrBindeds=$GLOBALS['_cache_']['sociatype'];
		$arrBindedData=array();

		$arrSociausers=SociauserModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getAll();
		if(is_array($arrSociausers)){
			foreach($arrSociausers as $oSociauser){
				if(isset($arrBindeds[$oSociauser['sociauser_vendor']])){
					$arrBindedData[]=$oSociauser['sociauser_vendor'];
				}
			}
		}

		$this->assign('arrBindedData',$arrBindedData);
		$this->assign('arrBindeds',$arrBindeds);

		$this->display('spaceadmin+socia');
	}

	public function socia_title_(){
		return '社会化帐号';
	}

}
