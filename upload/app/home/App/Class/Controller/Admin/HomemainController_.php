<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   home入口控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入主页模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/home/App/Class/Model');

class HomemainController extends InitController{

	public function index($sModel=null,$bDisplay=true){
		Core_Extend::loadCache('home_option');

		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		$this->assign('nId',intval(G::getGpc('id','G')));
		$this->assign('arrOptions',$arrOptionData);
		
		$this->display(Admin_Extend::template('home','homeoption/index'));
	}

	public function update_option(){
		$arrOptions=G::getGpc('options','P');

		foreach($arrOptions as $sKey=>$val){
			$val=trim($val);
			$oOptionModel=HomeoptionModel::F('homeoption_name=?',$sKey)->getOne();
			$oOptionModel->homeoption_value=G::html($val);
			$oOptionModel->save(0,'update');
		}

		HomeCache_Extend::updateCacheOption();

		$this->S(Dyhb::L('配置更新成功','__APP_ADMIN_LANG__@Controller/Homeoption'));
	}

}