<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   应用配置控制器($)*/

!defined('DYHB_PATH') && exit;

class AppconfigtoolController extends InitController{

	public function index($sName=null,$bDisplay=true){
		$sAppGlobalconfigFile=NEEDFORBUG_PATH.'/config/Config.inc.php';
		if(!is_file($sAppGlobalconfigFile)){
			$this->E(Dyhb::L('框架全局配置文件 %s 不存在，请修复','Controller/Appconfigtool',null,$sAppGlobalconfigFile));
		}

		$sAppGlobalconfig=nl2br(htmlspecialchars(file_get_contents($sAppGlobalconfigFile)));
		$arrAppGlobalconfigs=(array)(include $sAppGlobalconfigFile);

		$this->assign('sAppGlobalconfig',$sAppGlobalconfig);
		$this->assign('sAppGlobalconfigFile',str_replace(NEEDFORBUG_PATH,'{NEEDFORBUG_PATH}',$sAppGlobalconfigFile));
		$this->assign('arrAppGlobalconfigs',$arrAppGlobalconfigs);
		$this->assign('sAppGlobaldefaultconfigFile','{NEEDFORBUG_PATH}/config/ConfigDefault.inc.php');
		
		$this->display();
	}

	public function default_config(){
		$sAppGlobaldefaultconfigFile=NEEDFORBUG_PATH.'/config/ConfigDefault.inc.php';
		if(!is_file($sAppGlobaldefaultconfigFile)){
			$this->E(Dyhb::L('框架全局惯性配置文件 %s 不存在，请修复','Controller/Appconfigtool',null,$sAppGlobaldefaultconfigFile));
		}

		$sAppGlobaldefaultconfig=nl2br(htmlspecialchars(file_get_contents($sAppGlobaldefaultconfigFile)));
		$arrAppGlobaldefaultconfigs=(array)(include $sAppGlobaldefaultconfigFile);

		$this->assign('sAppGlobaldefaultconfig',$sAppGlobaldefaultconfig);
		$this->assign('arrAppGlobaldefaultconfigs',$arrAppGlobaldefaultconfigs);

		$this->display();
	}

}
