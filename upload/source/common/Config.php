<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台公用配置文件($)*/

!defined('DYHB_PATH') && exit;

// 基础应用配置
$arrAppConfigs=array(
	'PHP_OFF'=>TRUE,
	'DEFAULT_CONTROL'=>'public',
	'TMPL_ACTION_ERROR'=>'message',
	'TMPL_ACTION_SUCCESS'=>'message',
	'START_ROUTER'=>true,
);

// 读取全局配置
$arrGlobalConfig=(array)require(NEEDFORBUG_PATH.'/config/Config.inc.php');

// 模板设置
$arrAppConfigs['TPL_DIR']=$arrGlobalConfig['FRONT_TPL_DIR'];
unset($arrGlobalConfig['FRONT_TPL_DIR']);

// 语言包设置
$arrAppConfigs['LANG']=$arrGlobalConfig['FRONT_LANGUAGE_DIR'];
unset($arrGlobalConfig['FRONT_LANGUAGE_DIR']);

return array_merge($arrAppConfigs,$arrGlobalConfig);
