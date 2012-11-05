<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   后台基本配置文件($)*/

!defined('DYHB_PATH') && exit;

$arrAppConfigs=array(
	'PHP_OFF'=>TRUE,
	'TMPL_MODULE_ACTION_DEPR'=>'/',
	'DEFAULT_APP'=>'admin',
);

// 读取全局配置
$arrGlobalConfig=(array)require(NEEDFORBUG_PATH.'/config/Config.inc.php');

// 关闭调试
$arrGlobalConfig['SHOW_RUN_TIME']=FALSE;
$arrGlobalConfig['SHOW_DB_TIMES']=FALSE;
$arrGlobalConfig['SHOW_GZIP_STATUS']=FALSE;

// 后台模板重设置
$arrAppConfigs['TPL_DIR']=$arrGlobalConfig['ADMIN_TPL_DIR'];
unset($arrGlobalConfig['ADMIN_TPL_DIR']);

// 后台模板和主题COOKIE前缀
$arrGlobalConfig['COOKIE_LANG_TEMPLATE_INCLUDE_APPNAME']=TRUE;

// 使用普通URL模式
$arrGlobalConfig['URL_MODEL']=0;

// 后台语言包相关
$arrAppConfigs['LANG']=$arrGlobalConfig['ADMIN_LANGUAGE_DIR'];
unset($arrGlobalConfig['ADMIN_LANGUAGE_DIR']);
$arrGlobalConfig['LANG_SWITCH']=TRUE;

return array_merge($arrAppConfigs,$arrGlobalConfig);
