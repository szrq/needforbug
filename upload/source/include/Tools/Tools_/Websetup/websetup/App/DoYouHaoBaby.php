<?php
/**

 //  [Websetup!] 图像界面工具
 //  +---------------------------------------------------------------------
 //
 //  “Copyright”
 //  +---------------------------------------------------------------------
 //  | (C) 2010 - 2099 http://doyouhaobaby.net All rights reserved.
 //  | This is not a free software, use is subject to license terms
 //  +---------------------------------------------------------------------
 //
 //  “About This File”
 //  +---------------------------------------------------------------------
 //  | websetup 初始化文件
 //  +---------------------------------------------------------------------

*/

!defined('DYHB_PATH') && exit;

function includeDirPhpfile( $sPath,$bInclude=FALSE){
	$arrListFuncs = glob($sPath.'/*.php');
	
	if($bInclude===true){
		if($arrListFuncs){
			foreach($arrListFuncs as $sValue){
				include($sValue);
			}
		}

		unset($arrListFuncs);
	}else{
		return $arrListFuncs;
	}
}
