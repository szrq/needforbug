<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   应用配置控制器($)*/

!defined('DYHB_PATH') && exit;

class AppconfigtoolController extends InitController{

	public function index($sName=null,$bDisplay=true){
		$sAppGlobalconfigFile=NEEDFORBUG_PATH.'/config/Config.inc.php';
		if(!is_file($sAppGlobalconfigFile)){
			$this->E(Dyhb::L('框架全局配置文件 %s 不存在','Controller/Appconfigtool',null,$sAppGlobalconfigFile));
		}

		$sAppGlobalconfig=nl2br(htmlspecialchars(file_get_contents($sAppGlobalconfigFile)));
		$arrAppGlobalconfigs=(array)(include $sAppGlobalconfigFile);

		$this->assign('sAppGlobalconfig',$sAppGlobalconfig);
		$this->assign('sAppGlobalconfigFile',str_replace(NEEDFORBUG_PATH,'{NEEDFORBUG_PATH}',$sAppGlobalconfigFile));
		$this->assign('arrAppGlobalconfigs',$arrAppGlobalconfigs);
		$this->assign('sAppGlobaldefaultconfigFile','{NEEDFORBUG_PATH}/config/ConfigDefault.inc.php');

		// 读取应用列表
		$arrWhere=array();
		$arrWhere['app_active']=1;

		$nTotalRecord=AppModel::F()->where($arrWhere)->all()->getCounts();

		$nEverynum=$GLOBALS['_option_']['admin_list_num'];
		$oPage=Page::RUN($nTotalRecord,$nEverynum,G::getGpc('page','G'));

		$arrSaveLists=array();

		$arrLists=AppModel::F()->where($arrWhere)->all()->order('app_id DESC')->limit($oPage->returnPageStart(),$nEverynum)->query();
		if(is_array($arrLists)){
			foreach($arrLists as $oList){
				$arrSaveLists[$oList['app_id']]['app_id']=$oList['app_id'];
				$arrSaveLists[$oList['app_id']]['app_identifier']=$oList['app_identifier'];
				$arrSaveLists[$oList['app_id']]['app_name']=$oList['app_name'];
				$arrSaveLists[$oList['app_id']]['logo']=Core_Extend::appLogo($oList['app_identifier']);
				$arrSaveLists[$oList['app_id']]['config_file']='{NEEDFORBUG_PATH}/app/'.$oList['app_identifier'].'/App/Config/Config.php';
				$sConfigcachefile='data/~runtime/'.$oList['app_identifier'].'/Config.php';
				$arrSaveLists[$oList['app_id']]['config_cache_file']='{NEEDFORBUG_PATH}/'.$sConfigcachefile;
				$arrSaveLists[$oList['app_id']]['config_cache_file_exist']=file_exists(NEEDFORBUG_PATH.'/'.$sConfigcachefile)?true:false;
			}
		}

		$arrSaveLists[0]['app_id']=0;
		$arrSaveLists[0]['app_identifier']='admin';
		$arrSaveLists[0]['app_name']=Dyhb::L('全局后台','Controller/Appconfigtool');
		$arrSaveLists[0]['logo']=__ROOT__.'/admin/logo.png';
		$arrSaveLists[0]['config_file']='{NEEDFORBUG_PATH}/admin/App/Config/Config.php';
		$sConfigcachefile='data/~runtime/admin/Config.php';
		$arrSaveLists[0]['config_cache_file']='{NEEDFORBUG_PATH}/'.$sConfigcachefile;
		$arrSaveLists[0]['config_cache_file_exist']=file_exists(NEEDFORBUG_PATH.'/'.$sConfigcachefile)?true:false;

		$this->assign('sPageNavbar',$oPage->P());
		$this->assign('arrLists',$arrSaveLists);

		$this->display();
	}

	public function default_config(){
		$sAppGlobaldefaultconfigFile=NEEDFORBUG_PATH.'/config/ConfigDefault.inc.php';
		if(!is_file($sAppGlobaldefaultconfigFile)){
			$this->error_message(Dyhb::L('框架全局惯性配置文件 %s 不存在','Controller/Appconfigtool',null,$sAppGlobaldefaultconfigFile));
		}

		$sAppGlobaldefaultconfig=nl2br(htmlspecialchars(file_get_contents($sAppGlobaldefaultconfigFile)));
		$arrAppGlobaldefaultconfigs=(array)(include $sAppGlobaldefaultconfigFile);

		$this->assign('sAppGlobaldefaultconfig',$sAppGlobaldefaultconfig);
		$this->assign('arrAppGlobaldefaultconfigs',$arrAppGlobaldefaultconfigs);

		$this->display();
	}

	public function app_config(){
		$sApp=trim(strtolower(G::getGpc('app')));
		$sType=trim(G::getGpc('type'));

		if($sApp!='admin'){
			$oApp=AppModel::F('app_identifier=? AND app_active=1',$sApp)->getOne();
			if(empty($oApp['app_id'])){
				$this->error_message(Dyhb::L('应用 %s 不存在或者尚未开启','Controller/Appconfigtool',null,$sApp));
			}
		}

		if($sApp=='admin'){
			$sAppConfigfile=NEEDFORBUG_PATH.'/admin/App/Config/Config.php';
		}else{
			$sAppConfigfile=NEEDFORBUG_PATH.'/app/'.$sApp.'/App/Config/Config.php';
		}

		if($sType=='file'){
			if(!is_file($sAppConfigfile)){
				$this->error_message(Dyhb::L('应用配置文件 %s 不存在','Controller/Appconfigtool',null,$sAppConfigfile));
			}

			$sAppconfig=nl2br(htmlspecialchars(file_get_contents($sAppConfigfile)));
			$this->assign('sAppconfig',$sAppconfig);

			$this->display('appconfigtool+config_file');
		}else{
			$sAppConfigcachefile=NEEDFORBUG_PATH.'/data/~runtime/'.$sApp.'/Config.php';
			if(!is_file($sAppConfigcachefile)){
				$this->error_message(Dyhb::L('应用配置缓存文件 %s 不存在','Controller/Appconfigtool',null,$sAppConfigcachefile));
			}

			$arrAppFrameworkdefaultconfigs=(array)(include DYHB_PATH.'/Config_/DefaultConfig.inc.php');
			$arrAppconfigs=(array)(include $sAppConfigcachefile);
			
			$this->assign('arrAppconfigs',$arrAppconfigs);
			$this->assign('arrAppFrameworkdefaultconfigs',$arrAppFrameworkdefaultconfigs);

			$this->display();
		}
	}

	public function error_message($sMessage){
		$this->assign('sMessage',$sMessage);

		$this->display('appconfigtool+message');
		exit();
	}

	public function filter_value($Value){
		if(is_array($Value)){
			return G::dump($Value,false);
		}
		
		if($Value===false){
			return 'FALSE';
		}

		if($Value===true){
			return 'TRUE';
		}

		if($Value===null){
			return 'NULL';
		}

		if($Value==''){
			return "''";
		}

		return $Value;
	}

}
