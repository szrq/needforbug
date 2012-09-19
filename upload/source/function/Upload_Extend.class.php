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
	
	public static function uploadIcon($sType){
		if(empty($_FILES)){
			Dyhb::E(Dyhb::L('你没有选择任何文件','__COMMON_LANG__@Function/Upload_Extend'));
		}

		Core_Extend::loadCache($sType.'_option');

		$sUploadDir=Upload_Extend::getUploadDir();
		$nUploadfileMaxsize=Core_Extend::getUploadSize($GLOBALS['_cache_'][$sType.'_option'][$sType.'_icon_uploadfile_maxsize']);
		$oUploadfile=new UploadFile($nUploadfileMaxsize,array('gif','jpeg','jpg','png'),'',NEEDFORBUG_PATH.'/data/upload/'.$sType.$sUploadDir);
		
		// 缩略图设置
		$oUploadfile->_sThumbPrefix='';
		$oUploadfile->_bThumb=true;
		$oUploadfile->_nThumbMaxHeight=48;
		$oUploadfile->_nThumbMaxWidth=48;
		$oUploadfile->_sThumbPath=NEEDFORBUG_PATH."/data/upload/{$sType}{$sUploadDir}";
		$oUploadfile->_bThumbRemoveOrigin=FALSE;
		$oUploadfile->_bThumbFixed=true;
			
		// 文件上传规则
		$oUploadfile->_sSaveRule=array(ucfirst($sType).'_Extend','getIconName');
			
		// 自动创建附件储存目录
		$oUploadfile->setAutoCreateStoreDir(TRUE);
			
		$sPhotoDir='';
		$arrUploadInfo=array();
		if(!$oUploadfile->upload()){
			Dyhb::E($oUploadfile->getErrorMessage());
		}else{
			$arrPhotoInfo=$oUploadfile->getUploadFileInfo();
			$sPhotoDir=str_replace(G::tidyPath(NEEDFORBUG_PATH.'/data/upload/'.strtolower($sType)).'/','',G::tidyPath($arrPhotoInfo[0]['thumbpath'])).'/'.$arrPhotoInfo[0]['savename'];
		}
		
		return $sPhotoDir;
	}
	
	public static function deleteicon($sType,$sUrl){
		$sFile=NEEDFORBUG_PATH.'/data/upload/'.$sType.'/'.$sUrl;
		$sDir=dirname($sFile);

		if(is_file($sFile)){
			@unlink($sFile);
		}
		
		$arrFiles=G::listDir($sDir,false,true);
		if(count($arrFiles)==1 && $arrFiles[0]=='index.html'){
			if(is_file($sDir.'/index.html')){
				@unlink($sDir.'/index.html');
			}

			if(is_dir($sDir)){
				@rmdir($sDir);
			}
		}
	}

	public static function getUploadSavename($sFilename){
		return md5(md5($sFilename).gmdate('YmdHis')).'.'.G::getExtName($sFilename,2);
	}

	public static function uploadFlash($bUploadFlash=true){
		if(empty($_FILES)){
			Dyhb::E('你没有选择任何文件');
			return;
		}

		$sUploadDir=self::getUploadDir();
		$arrAllAllowType=explode('|',$GLOBALS['_option_']['upload_allowed_type']);
		$nUploadfileMaxsize=Core_Extend::getUploadSize($GLOBALS['_option_']['uploadfile_maxsize']);

		if($bUploadFlash===true){
			$oUploadfile=new UploadFileForUploadify($nUploadfileMaxsize,$arrAllAllowType,'',NEEDFORBUG_PATH.'/data/upload/attachment'.$sUploadDir);
		}else{
			$oUploadfile=new UploadFile($nUploadfileMaxsize,$arrAllAllowType,'',NEEDFORBUG_PATH.'/data/upload/attachment'.$sUploadDir);
		}

		if($GLOBALS['_option_']['upload_create_thumb']==1){
			$oUploadfile->_bThumb=true;
			$arrThumbMax=explode('|',$GLOBALS['_option_']['upload_thumb_size']);
			$oUploadfile->_nThumbMaxHeight=$arrThumbMax[0];
			$oUploadfile->_nThumbMaxWidth=$arrThumbMax[1];
			$oUploadfile->_sThumbPath=NEEDFORBUG_PATH."/data/upload/attacement{$sUploadDir}/thumb";// 缩略图文件保存路径
		}

		$oUploadfile->_sSaveRule=array('Upload_Extend','getUploadSavename');// 设置上传文件规则
		
		if($GLOBALS['_option_']['upload_is_watermark']==1){
			$oUploadfile->_bIsImagesWaterMark=true;
			$oUploadfile->_sImagesWaterMarkType=$GLOBALS['_option_']['upload_images_watertype'];
			$oUploadfile->_arrImagesWaterMarkImg=array(
				'path'=>$GLOBALS['_option_']['upload_watermark_imgurl'],
				'offset'=>$GLOBALS['_option_']['upload_imageswater_offset']
			);
			$oUploadfile->_arrImagesWaterMarkText=array(
				'content'=>$GLOBALS['_option_']['upload_imageswater_text'],
				'textColor'=>$GLOBALS['_option_']['upload_imageswater_textcolor'],
				'textFont'=>$GLOBALS['_option_']['upload_imageswater_textfontsize'],
				'textFile'=>$GLOBALS['_option_']['upload_imageswater_textfontpath'],
				'textPath'=>$GLOBALS['_option_']['upload_imageswater_textfonttype'],
				'offset'=>$GLOBALS['_option_']['upload_imageswater_offset']
			);
			$oUploadfile->_nWaterPos=$GLOBALS['_option_']['upload_imageswater_position'];
		}

		$oUploadfile->setAutoCreateStoreDir(TRUE);

		if(!$oUploadfile->upload()){
			Dyhb::E($oUploadfile->getErrorMessage());
		}else{
			$arrPhotoInfo=$oUploadfile->getUploadFileInfo();
		}

		$oAttachment=Dyhb::instance('AttachmentModel');
		$arrUploadids=$oAttachment->upload($arrPhotoInfo);

		if($oAttachment->isError()){
			Dyhb::E($oAttachment->getErrorMessage());
			return false;
		}

		return $arrUploadids;
	}

	public static function uploadNormal(){
		self::uploadFlash(false);
	}
	
}
