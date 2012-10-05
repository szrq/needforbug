<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   当前CSS资源配置文件($)*/

!defined('DYHB_PATH') && exit;

return array(
	'userhome'=>'@public::index',
	'grouptopicview'=>'grouptopic::view,grouptopic::reply',
	'media'=>'grouptopic::view,grouptopic::add,grouptopic::edit',
	'grouptopicadd'=>'grouptopic::add,grouptopic::edit',
	'publicmodulelist'=>'public::index',
	'taghot'=>'public::index',
	'grouphottopic'=>'public::index',
	'groupuserinfo'=>'public::index',
	'grouplist'=>'public::group',
	'grouptopiclist'=>'public::index,group::show',
);
