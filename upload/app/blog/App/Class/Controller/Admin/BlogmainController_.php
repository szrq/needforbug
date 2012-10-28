<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   博客入口控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入博客模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/blog/App/Class/Model');

class BlogmainController extends InitController{

	public function index($sModel=null,$bDisplay=true){
		$this->display(Admin_Extend::template('blog','blogoption/index'));
	}

	public function update_option(){
		$arrOptions=G::getGpc('options','P');

		foreach($arrOptions as $sKey=>$val){
			$val=trim($val);
			$oOptionModel=GroupoptionModel::F('groupoption_name=?',$sKey)->getOne();
			$oOptionModel->groupoption_value=G::html($val);
			$oOptionModel->save(0,'update');
		}

		GroupCache_Extend::updateCache("option");

		$this->S(Dyhb::L('配置更新成功','__APP_ADMIN_LANG__@Controller/Groupoption'));
	}

}
