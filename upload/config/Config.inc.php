<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   System default config($)*/

!defined('DYHB_PATH') && exit;

return array(
	'DB_PASSWORD'=>'123456',
	'DB_PREFIX'=>'needforbug_',
	'DB_NAME'=>'needforbug',
	'DB_CACHE_FIELDS'=>TRUE,
	'DB_CACHE'=>TRUE,
	'DB_CACHE_TIME'=>86400000000,
	'APP_DEBUG'=>TRUE,
	'RBAC_DATA_PREFIX'=>'rbac_data_prefix_needforbug_',
	'COOKIE_PREFIX'=>'needforbug_',
	'URL_DOMAIN'=>'http://localhost',
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
	'TEMPLATE_TAG_NOTE'=>true,
	'APP_DEVELOP'=>0,
);
