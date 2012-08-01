<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台公用初始化文件($)*/

!defined('DYHB_PATH') && exit;

/** 导入Needforbug核心函数 */
require(NEEDFORBUG_PATH.'/source/function/Core_Extend.class.php');

/** 导入公用模型 */
Dyhb::import(NEEDFORBUG_PATH.'/source/model');

/** 定义应用的语言包 */
define('__APP_ADMIN_LANG__',NEEDFORBUG_PATH.'/app/home/App/Lang/Admin');
