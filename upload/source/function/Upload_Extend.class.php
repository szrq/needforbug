<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   文件上传相关函数($)*/

!defined('DYHB_PATH') && exit;

class Upload_Extend{

	public static function getUploadDir(){
		$sUploadDir='';
		
		$sUploadStoreType=$GLOBALS['_option_']['upload_store_type'];
		if($sUploadStoreType=='month'){
			$sUploadDir='/month_'.date('Ym',CURRENT_TIMESTAMP);
		}elseif($sUploadStoreType=='day'){
			$sUploadDir='/day_'.date('Ymd',CURRENT_TIMESTAMP);
		}else{
			$sUploadDir='';
		}
		
		return $sUploadDir;
	}
	
	public static function getIconName($sType,$nId){
		return $sType.'_'.$nId.'_icon';
	}
	
	public static function getGroupIconName(){
		$nId=intval(G::getGpc('id'));
		
		return self::getIconName('group',$nId);
	}
	
	public static function uploadIcon($sType){
		if(empty($_FILES)){
			Dyhb::E(Dyhb::L('你没有选择任何文件','__COMMON_LANG__@Function/Upload_Extend'));
		}

		Core_Extend::loadCache($sType.'_option');

		$sUploadDir=Upload_Extend::getUploadDir();
		$nUploadfileMaxsize=Core_Extend::getUploadSize($GLOBALS['_cache_'][$sType.'_option'][$sType.'_icon_uploadfile_maxsize']);
		$oUploadfile=new UploadFile($nUploadfileMaxsize,array('gif','jpeg','jpg','png'),'',NEEDFORBUG_PATH.'/Data/Upload/'.$sType.$sUploadDir);
		
		// 缩略图设置
		$oUploadfile->_sThumbPrefix='';
		$oUploadfile->_bThumb=true;
		$oUploadfile->_nThumbMaxHeight=48;
		$oUploadfile->_nThumbMaxWidth=48;
		$oUploadfile->_sThumbPath=NEEDFORBUG_PATH."/data/upload/{$sType}{$sUploadDir}";
		$oUploadfile->_bThumbRemoveOrigin=true;
		$oUploadfile->_bThumbFixed=true;
			
		// 文件上传规则
		$oUploadfile->_sSaveRule=array('Upload_Extend','get'.ucfirst($sType).'IconName');
			
		// 自动创建附件储存目录
		$oUploadfile->setAutoCreateStoreDir(TRUE);
			
		$sPhotoDir='';
		$arrUploadInfo=array();
		if(!$oUploadfile->upload()){
			Dyhb::E($oUploadfile->getErrorMessage());
		}else{
			$arrPhotoInfo=$oUploadfile->getUploadFileInfo();
			$sPhotoDir=str_replace(NEEDFORBUG_PATH.'/data/upload/'.strtolower($sType).'/','',$arrPhotoInfo[0]['thumbpath']).'/'.$arrPhotoInfo[0]['savename'].'.'.$arrPhotoInfo[0]['extension'];
		}
		
		return $sPhotoDir;
	}
	
	public static function deleteicon($sType,$sUrl){
		$sFile=NEEDFORBUG_PATH.'/data/upload/'.$sType.'/'.$sUrl;
		$sDir=dirname($sFile);

		if(file_exists($sFile)){
			@unlink($sFile);
		}
		
		$arrFiles=G::listDir($sDir,false,true);
		if(count($arrFiles)==1 && $arrFiles[0]=='index.html'){
			if(file_exists($sDir.'/index.html')){
				@unlink($sDir.'/index.html');
			}

			if(is_dir($sDir)){
				@rmdir($sDir);
			}
		}
	}
	
}
