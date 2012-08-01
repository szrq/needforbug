<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   后台基本配置文件($)*/

!defined('DYHB_PATH') && exit;

$arrAppConfigs=array(
	//'START_ROUTER'=>TRUE,// 是否开启URL路由
	'URL_MODEL'=>0, // URLMODE,
	'PHP_OFF'=>TRUE,
	'CACHE_LIFE_TIME'=>8640000,
	'TMPL_MODULE_ACTION_DEPR'=>'/',
);

return array_merge($arrAppConfigs,require(NEEDFORBUG_PATH.'/config/Config.inc.php'));
