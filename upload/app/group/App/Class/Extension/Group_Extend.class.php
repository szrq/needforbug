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
			return __ROOT__.'/app/group/Static/Images/group_icon.gif';
		}
	}

	public static function getIconName($sFilename){
		$nId=intval(G::getGpc('id'));
		return Upload_Extend::getIconName('group',$nId).'.'.G::getExtName($sFilename,2);
	}

	public static function getGroupurl($arrGroup){
		return Dyhb::U('group://gid@?id='.(!empty($arrGroup['group_name'])?$arrGroup['group_name']:$arrGroup['group_id']));
	}
	
}
