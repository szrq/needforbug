<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   博客基本配置文件($)*/

!defined('DYHB_PATH') && exit;

$arrAppConfigs=array(
	//'START_ROUTER'=>TRUE,// 是否开启URL路由
	'PHP_OFF'=>TRUE,
	'CACHE_LIFE_TIME'=>8640000,
	'TMPL_MODULE_ACTION_DEPR'=>'/',
);

$arrGlobalConfig=(array)require(NEEDFORBUG_PATH.'/config/Config.inc.php');
$arrAppConfigs['TPL_DIR']=$arrGlobalConfig['FRONT_TPL_DIR'];
unset($arrGlobalConfig['FRONT_TPL_DIR']);

return array_merge($arrAppConfigs,$arrGlobalConfig);