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
);

return array_merge($arrAppConfigs,require(NEEDFORBUG_PATH.'/config/Config.inc.php'));
