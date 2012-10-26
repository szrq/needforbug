<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   附件读取管理($)*/

!defined('DYHB_PATH') && exit;

class AttachmentreadController extends InitController{
	
	public function index(){
		if(empty($_GET['k'])){
			$bEncodeMethod=TRUE;
			@list($_GET['id'],$_GET['k'],$_GET['t'],$_GET['sid'])=explode('|',base64_decode(G::getGpc('id','G')));
		}else{
			$bEncodeMethod=FALSE;
		}

		$nAttachmentId=intval(G::getGpc('id','G'));
		$nThumb=intval(G::getGpc('thumb','G'));

		if(empty($nAttachmentId)){
			$this->E('你未指定请求附件的ID');
		}

		$oAttachment=AttachmentModel::F('attachment_id=?',$nAttachmentId)->getOne();
		if(empty($oAttachment['attachment_id'])){
			$this->E('你请求的附件不存在');
		}

		// 附件过期检测
		if($GLOBALS['_option_']['upload_attach_expirehour']){
			$k=G::getGpc('k','G');
			$t=G::getGpc('t','G');

			$sAuthk=md5($nAttachmentId.md5($GLOBALS['_commonConfig_']['DYHB_AUTH_KEY']).$t);
			$sAuthk=$bEncodeMethod?substr($sAuthk,0,8):$sAuthk;

			if(empty($k) || empty($t) || $k!=$sAuthk || CURRENT_TIMESTAMP-$t>$GLOBALS['_option_']['upload_attach_expirehour']*3600){
				if(in_array($oAttachment['attachment_extension'],array('gif','jpg','png','bmp','jpeg'))){
					header('location: '.$GLOBALS['_option_']['site_url'].'/Public/images/common/none.gif');
				}else{
					$this->E('你请求的附件已过期');
				}
			}
		}

		// 防盗链处理
		$bCheckLimitUploadLeechOk=true;
		if($GLOBALS['_option_']['upload_limit_leech']){
			$arrAllowHosts=Dyhb::normalize(explode('|',$GLOBALS['_option_']['upload_notlimit_leechdomail']));
			if(isset($_SERVER['HTTP_HOST'])){
				$arrAllowHosts[]=$_SERVER['HTTP_HOST'];
			}

			
			if(isset($_SERVER['HTTP_REFERER'])){
				$arrReferer=parse_url($_SERVER['HTTP_REFERER']);
				if(!in_array($arrReferer['host'],$arrAllowHosts)){
					$bCheckLimitUploadLeechOk=false;
				}
			}
		}

		if($bCheckLimitUploadLeechOk===false){
			$this->generate_leech_error_();
		}

		// 记录下载
		$bDownload=false;
		if($sAttachmentCookie=Dyhb::cookie('attachment_read')){
			$arrAttachmentIds=explode(',',$sAttachmentCookie);
			if(in_array($nAttachmentId,$arrAttachmentIds)){
				$bDownload=true;
			}
		}

		if($bDownload===false){
			$oAttachment->attachment_download=$oAttachment->attachment_download+1;
			$oAttachment->setAutofill(false);
			$oAttachment->save(0,'update');

			if($oAttachment->isError()){
				$this->E($oAttachment->getErrorMessage());
			}

			$sAttachmentCookie.=empty($sAttachmentCookie)?$nAttachmentId:','.$nAttachmentId;
			Dyhb::cookie('attachment_read',$sAttachmentCookie,86400);
		}

		$sAttachmentpathBackup='/data/upload/attachment/'.
			($oAttachment->attachment_isthumb && $nThumb==1?$oAttachment->attachment_thumbpath.'/'.$oAttachment->attachment_thumbprefix:$oAttachment->attachment_savepath.'/').$oAttachment->attachment_savename;

		// 是否直接跳转到真实路径
		if($GLOBALS['_option_']['upload_directto_reallypath']){
			$sAttachmentPath=$GLOBALS['_option_']['site_url'].$sAttachmentpathBackup;

			header("Location: {$sAttachmentPath}");
			exit();
		}

		// 取得附件真实地址
		$sAttachmentreallypath=NEEDFORBUG_PATH.$sAttachmentpathBackup;

		// 取得附件
		if(is_readable($sAttachmentreallypath)){
			$sBrowser=$this->get_browser_detection_();
			if(in_array($sBrowser,array('Firefox','Mozilla','Opera'))){
				$sAttachmentName=urldecode($oAttachment->attachment_name);
			}

			$sAttachmentName=!empty($oAttachment->attachment_name)?$oAttachment->attachment_name:$oAttachment->attachment_savename;
			$sAttachmenttype=$oAttachment->attachment_type?$oAttachment->attachment_type:'application/octet-stream';
			$sDisposition=$GLOBALS['_option_']['uplod_isinline']?'inline':'attachment';

			ob_end_clean();
			header('Cache-control: max-age=31536000');
			header('Expires: '.date('D, d M Y H:i:s',$oAttachment->create_dateline).' GMT');
			header('Last-Modified: '.date('D, d M Y H:i:s',$oAttachment->update_dateline).' GMT');
			header('Content-Encoding: none');
			header('Content-type: '.$sAttachmenttype);
			header('Content-Disposition:'.$sDisposition.'; filename='.$sAttachmentName);
			header('Content-Length: '.filesize($sAttachmentreallypath));

			$hFp=fopen($sAttachmentreallypath,'rb');
			fpassthru($hFp);
			fclose($hFp);

			exit();
		}else{
			$this->E('你请求的附件不可读，可能已经损坏');
		}
	}

	protected function generate_leech_error_(){
		header('Content-Encoding: none');
		header('Content-Type: image/gif');
		header('Content-Disposition: inline; filename="no_leech.gif"');

		$sNoleechpath=NEEDFORBUG_PATH.'/Public/images/common/no_leech.gif';

		$oFp=fopen($sNoleechpath,'rb');
		fpassthru($oFp);
		fclose($oFp);

		exit();
	}

	protected function get_browser_detection_(){
		if(strpos($_SERVER['HTTP_USER_AGENT'],'Gecko')!==false){
			if(strpos($_SERVER['HTTP_USER_AGENT'],'Netscape')){
				$sBrowser='Netscape';
			}elseif(strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')!==false){
				$sBrowser='Firefox';
			}else{
				$sBrowser='Mozilla';
			}
		}elseif(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false){
			if(strpos($_SERVER['HTTP_USER_AGENT'],'Opera')!==false){
				$sBrowser='Opera'; // Opera 8.0
			}else{
				$sBrowser='IE';
			}
		}elseif(strpos($_SERVER['HTTP_USER_AGENT'],'Opera')!==false){
			$sBrowser='Opera'; // Opera 9.0
		}else{
			$sBrowser='Other';
		}

		return $sBrowser;
	}

}
