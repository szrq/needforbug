<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台基本配置文件($)*/

!defined('DYHB_PATH') && exit;

$arrAppConfigs=array(
	//'START_ROUTER'=>TRUE,// 是否开启URL路由
	'PHP_OFF'=>TRUE,
	'CACHE_LIFE_TIME'=>8640000,
	'DEFAULT_CONTROL'=>'public',
	'TMPL_ACTION_ERROR'=>'message',
	'TMPL_ACTION_SUCCESS'=>'message',
	'START_ROUTER'=>true,
);

$arrGlobalConfig=(array)require(NEEDFORBUG_PATH.'/config/Config.inc.php');
$arrAppConfigs['TPL_DIR']=$arrGlobalConfig['FRONT_TPL_DIR'];
unset($arrGlobalConfig['FRONT_TPL_DIR']);
$arrAppConfigs['LANG']=$arrGlobalConfig['FRONT_LANGUAGE_DIR'];
unset($arrGlobalConfig['FRONT_LANGUAGE_DIR']);

return array_merge($arrAppConfigs,$arrGlobalConfig);
