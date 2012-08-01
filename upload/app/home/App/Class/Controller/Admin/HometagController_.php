<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   用户标签控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入主页模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/home/App/Class/Model');

class HometagController extends InitController{

	public function filter_(&$arrMap){
		$arrMap['hometag_name']=array('like','%'.G::getGpc('hometag_name').'%');
	}

	public function index($sModel=null,$bDisplay=true){
		parent::index('hometag',false);

		$this->display(Admin_Extend::template('home','hometag/index'));
	}

	public function edit($sMode=null,$nId=null,$bDidplay=true){
		$this->E(Dyhb::L('用户标签不允许被编辑','__APP_ADMIN_LANG__@Controller/Hometag'));
	}
	
	public function add(){
		$this->E(Dyhb::L('不允许添加用户标签','__APP_ADMIN_LANG__@Controller/Hometag'));
	}

	public function aForeverdelete($sId){
		$arrIds=explode(',',$sId);
		foreach($arrIds as $nId){
			// 清理标签索引
			HometagindexModel::M()->deleteWhere(array('hometag_id'=>$nId));
		}
	}
	
	public function foreverdelete($sModel=null,$sId=null){
		$sId=G::getGpc('value');

		parent::foreverdelete('hometag',$sId);
	}

	public function forbid($sModel=null,$sId=null,$bApp=false){
		$nId=intval(G::getGpc('value','G'));

		parent::forbid('hometag',$nId,true);
	}

	public function resume($sModel=null,$sId=null,$bApp=false){
		$nId=intval(G::getGpc('value','G'));

		parent::resume('hometag',$nId,true);
	}
	
}
