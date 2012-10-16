<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台路由配置文件($)*/

!defined('DYHB_PATH') && exit;

return array(
	// for home app
	'space'=>array('space/index','id'),
	'file'=>array('attachment/show','id'),
	// end home
	'topic'=>array('grouptopic/view','id'),
	'category'=>array('group/index2','id'),
	'name'=>array('group/show','id'),
);
