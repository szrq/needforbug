<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   当前CSS资源配置文件($)*/

!defined('DYHB_PATH') && exit;

return array(
	'index'=>'public::index',
	'pm'=>'pm',
	'userhome'=>'ucenter',
	'attachmentupload'=>'attachment::add',
	'attachmentthumbnaillist'=>'attachment::attachment,attachment::attachmentcategory,attachment::my_attachment,my_attachmentcategory,attachment::index',
	'thumbnaillistattachment'=>'attachment::attachment',
	'thumbnaillistattachmentcategory'=>'attachment::attachmentcategory',
	'attachmentinfoitem'=>'attachment::attachmentinfo',
	'dialogthumbnaillistattachment'=>'attachment::attachment,attachment::my_attachment',
	'dialogthumbnaillistattachmentcategory'=>'attachment::attachmentcategory,attachment::my_attachmentcategory',
	'thumbnaillistattachmentindex'=>'attachment::index',
);
