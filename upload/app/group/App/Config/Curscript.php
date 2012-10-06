<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   当前CSS资源配置文件($)*/

!defined('DYHB_PATH') && exit;

return array(
	'public::index',
	'public::group',
	'group::show',
	'grouptopic::view'=>'media',
	'grouptopic::reply'=>'media',
	'grouptopic::add'=>'media',
	'grouptopic::edit'=>'media','userhome'=>'@public::index',
);
