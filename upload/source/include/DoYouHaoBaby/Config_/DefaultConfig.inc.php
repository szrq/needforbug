<?php
/* [DoYouHaoBaby!] (C)Dianniu From 2010.
   系统默认配置文件($)*/

!defined('DYHB_PATH') && exit;

return array(
	'START_GZIP'=>true,
	'DEFAULT_APP'=>'@',
	'APP_DEBUG'=>FALSE,
	'DB_HOST'=>'localhost',
	'DB_USER'=>'root',
	'DB_PASSWORD'=>'',
	'DB_PREFIX'=>'doyouhaobaby_',
	'DB_CHAR'=>'utf8',
	'DB_NAME'=>'',
	'DB_TYPE'=>'mysql',
	'DB_SCHEMA'=>'',
	'DB_PORT'=>3306,
	'DB_CACHE'=>FALSE,
	'DB_META_CACHED'=>TRUE,
	'DB_DSN'=>'',
	'DB_PARAMS'=>array(),
	'DB_RW_SEPARATE'=>FALSE,
	'DB_DISTRIBUTED'=>FALSE,
	'DB_FIELDTYPE_CHECK'=>TRUE,
	'TEMPLATE_NOT_ALLOWS_FUNC'=>'echo,exit',
	'CACHE_LIFE_TIME'=>-1,
	'THEME_SWITCH'=>TRUE,
	'TPL_DIR'=>'default',
	'PHP_OFF'=>FALSE,
	'TEMPLATE_TAG_NOTE'=>FALSE,
	'TEMPLATE_SUFFIX'=>'.html',
	'ERROR_PAGE'=>'',
	'SHOW_ERROR_MSG'=>TRUE,
	'TMPL_ACTION_ERROR'=>'public+success',
	'TMPL_ACTION_SUCCESS'=>'public+success',
	'TMPL_MODULE_ACTION_DEPR'=>'_',
	'DEFAULT_AJAX_RETURN'=>'JSON',
	'TMPL_VAR_IDENTIFY'=>'',
	'AUTO_ACCEPT_LANGUAGE'=>true,
	'DYHB_AUTH_KEY'=>'dyhb_auth_key',
	'RBAC_DATA_PREFIX'=>'rbac_data_prefix',
	'HTML_CACHE_ON'=>false,
	'HTML_CACHE_TIME'=>86400,
	'HTML_READ_TYPE'=>0,
	'HTML_FILE_SUFFIX'=>'.html',
	'TIME_ZONE'=>'Asia/Shanghai',
	'COOKIE_PREFIX'=>'dyhb_',
	'COOKIE_DOMAIN'=>'',
	'COOKIE_PATH'=>'/',
	'COOKIE_EXPIRE'=>86400,
	'SESSION_PREFIX'=>'dyhb_',
	'URL_MODEL'=>1,
	'START_ROUTER'=>FALSE,
	'URL_PATHINFO_MODEL'=>2,
	'URL_PATHINFO_DEPR'=>'/',
	'URL_HTML_SUFFIX'=>'',
	'DEFAULT_CONTROL'=>'index',
	'DEFAULT_ACTION'=>'index',
	'LOG_RECORD'=>FALSE,
	'LOG_FILE_SIZE'=>2097152,
	'LOG_RECORD_LEVEL'=>'EMERG|ALERT|CRIT|ERR',
	'LOG_MUST_RECORD_EXCEPTION'=>FALSE,
	'LOG_SQL_ENABLED'=>FALSE,
	'SHOW_RUN_TIME'=>FALSE,
	'SHOW_PAGE_TRACE'=>false,
	'SHOW_DETAIL_TIME'=>FALSE,
	'SHOW_USE_MEM'=>FALSE,
	'SHOW_DB_TIMES'=>FALSE,
	'SHOW_GZIP_STATUS'=>FALSE,
	'RUNTIME_CACHE_BACKEND'=>'FileCache',
	'EMPTY_MODULE_NAME'=>'empty',
	'EMPTY_ACTION_NAME'=>'empty_',
	'ALLOWED_PROBE'=>TRUE,
	'UPLOAD_FILE_RULE'=>'time',
	'LANG_SWITCH'=>TRUE,
	'LANG'=>'zh-cn',
	'URL_DOMAIN'=>'',
);
