<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   后台基本配置文件($)*/

!defined('DYHB_PATH') && exit;

$arrAppConfigs=array(
	//'START_ROUTER'=>TRUE,// 是否开启URL路由
	'PHP_OFF'=>TRUE,
	'CACHE_LIFE_TIME'=>8640000,
	'TMPL_MODULE_ACTION_DEPR'=>'/',
);

$arrGlobalConfig=(array)require(NEEDFORBUG_PATH.'/config/Config.inc.php');
$arrGlobalConfig['SHOW_RUN_TIME']=FALSE;
$arrGlobalConfig['SHOW_DB_TIMES']=FALSE;
$arrGlobalConfig['SHOW_GZIP_STATUS']=FALSE;
$arrAppConfigs['TPL_DIR']=$arrGlobalConfig['ADMIN_TPL_DIR'];
unset($arrGlobalConfig['ADMIN_TPL_DIR']);
$arrGlobalConfig['COOKIE_LANG_TEMPLATE_INCLUDE_APPNAME']=TRUE;
$arrGlobalConfig['URL_MODEL']=0;
$arrAppConfigs['LANG']=$arrGlobalConfig['ADMIN_LANGUAGE_DIR'];
unset($arrGlobalConfig['ADMIN_LANGUAGE_DIR']);

return array_merge($arrAppConfigs,$arrGlobalConfig);
