<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   System default config($)*/

!defined('DYHB_PATH') && exit;

return array(
	// 数据库相关
	'DB_PASSWORD'=>'123456',
	'DB_PREFIX'=>'needforbug_',
	'DB_NAME'=>'needforbug',
	'DB_CACHE_FIELDS'=>TRUE,
	'DB_CACHE'=>TRUE,
	'DB_CACHE_TIME'=>86400000000,

	// 系统调试
	'APP_DEBUG'=>TRUE,

	// 重要前缀
	'RBAC_DATA_PREFIX'=>'rbac_data_prefix_needforbug_',
	'COOKIE_PREFIX'=>'needforbug_',

	// RBAC
	'RBAC_ROLE_TABLE'=>'role',
	'RBAC_USERROLE_TABLE'=>'userrole',
	'RBAC_ACCESS_TABLE'=>'access',
	'RBAC_NODE_TABLE'=>'node',
	'USER_AUTH_ON'=>true,
	'USER_AUTH_TYPE'=>1,
	'USER_AUTH_KEY'=>'auth_id',
	'ADMIN_USERID'=>'1',
	'ADMIN_AUTH_KEY'=>'administrator',
	'USER_AUTH_MODEL'=>'user',
	'AUTH_PWD_ENCODER'=>'md5',
	'USER_AUTH_GATEWAY'=>'public/login',
	'NOT_AUTH_MODULE'=>'public',
	'REQUIRE_AUTH_MODULE'=>'',
	'NOT_AUTH_ACTION'=>'',
	'REQUIRE_AUTH_ACTION'=>'',
	'GUEST_AUTH_ON'=>false,
	'GUEST_AUTH_ID'=>0,
	'RBAC_ERROR_PAGE'=>'',

	// 时区
	'TIME_ZONE'=>'Asia/Shanghai',
	
	// 开启注释版模板标签风格
	'TEMPLATE_TAG_NOTE'=>true,

	// 开发者中心
	'APP_DEVELOP'=>0,// 是否开启后台应用设计，仅应用开发者设置为1
);
