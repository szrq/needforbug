<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城核心函数库文件($)*/

!defined('DYHB_PATH') && exit;

class Shop_Extend{

	public static function getShopgoodspath($sImgpath){
		return __ROOT__.'/data/upload/app/shop/shopgoods/'.$sImgpath;
	}

}
