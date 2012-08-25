<?php
/**

 //  [DoYouHaoBaby!] Init APP - install
 //  +---------------------------------------------------------------------
 //
 //  “Copyright”
 //  +---------------------------------------------------------------------
 //  | (C) 2010 - 2099 http://doyouhaobaby.net All rights reserved.
 //  | This is not a free software, use is subject to license terms
 //  +---------------------------------------------------------------------
 //
 //  “About This File”
 //  +---------------------------------------------------------------------
 //  | install 基本配置文件
 //  +---------------------------------------------------------------------

*/

!defined('DYHB_PATH') && exit;

return array(
	// 模板缓存时间
	'CACHE_LIFE_TIME'=>86400000,

	// 禁止空模块直接加载视图
	'NOT_ALLOWED_EMPTYCONTROL_VIEW'=>true,

	// 语言包和模板COOKIE是否包含应用名字
	'COOKIE_LANG_TEMPLATE_INCLUDE_APPNAME'=>false,
);
