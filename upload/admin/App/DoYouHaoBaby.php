<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   后台公用初始化文件($)*/

!defined('DYHB_PATH') && exit;

/** 导入Needforbug核心函数 */
require(NEEDFORBUG_PATH.'/source/function/Core_Extend.class.php');

/** 导入Needforbug后台函数 */
require(NEEDFORBUG_PATH.'/source/function/Admin_Extend.class.php');

/** 导入公用模型 */
Dyhb::import(NEEDFORBUG_PATH.'/source/model');

/** 导入Home模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/home/App/Class/Model');

/** 定义Home的语言包 */
define('__APP_ADMIN_LANG__',NEEDFORBUG_PATH.'/app/home/App/Lang/Admin');
