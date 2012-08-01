<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组相关函数($)*/

!defined('DYHB_PATH') && exit;

class Group_Extend{

	public static function getGroupIcon($sImgname){
		if(!empty($sImgname)){
			$sImgname=__ROOT__.'/data/upload/group/'.$sImgname;
			return $sImgname;
		}else{
			return __APPPUB__.'/Js/Images/common/group_icon.gif';
		}
	}
	
}
