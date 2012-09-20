<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   附件管理($)*/

!defined('DYHB_PATH') && exit;

class AttachmentController extends InitController{
		
	public function init__(){
		// 读取发送过来的COOKIE
		$sHash=trim(G::getGpc('hash'));
		$sAuth=trim(G::getGpc('auth'));
		if(!empty($sHash) && !empty($sAuth)){
			Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'hash',$sHash);
			Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'auth',$sAuth);
		}

		parent::init__();
		$this->is_login();
	}
	
	public function index(){
		$this->display('attachment+index');
	}

	public function add(){
		$nUploadfileMaxsize=Core_Extend::getUploadSize($GLOBALS['_option_']['uploadfile_maxsize']);
		$nUploadFileMode=$GLOBALS['_option_']['upload_file_mode'];
		$sAllAllowType=$GLOBALS['_option_']['upload_allowed_type'];
		if(empty($sAllAllowType)){
			$sAllAllowType='*.*';
		}else{
			$arrTempAllAllowType=array();
			foreach(explode('|',$sAllAllowType) as $sValue){
				$arrTempAllAllowType[]='*.'.$sValue;
			}
			$sAllAllowType=implode(';',$arrTempAllAllowType);
		}

		$nUploadFlashLimit=intval($GLOBALS['_option_']['upload_flash_limit']);
		if($nUploadFlashLimit<0){
			$nUploadFlashLimit=0;
		}

		$nFileInputNum=$GLOBALS['_option_']['upload_input_num'];

		// 登录使用COOKIE
		$sHash=Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'hash');
		$sAuth=Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'auth');

		$this->assign('sHash',$sHash);
		$this->assign('sAuth',$sAuth);

		$nUploadIsauto=$GLOBALS['_option_']['upload_isauto'];
		$this->assign('nUploadIsauto',$nUploadIsauto);

		$this->assign('nUploadfileMaxsize',$nUploadfileMaxsize);
		$this->assign('nUploadFileMode',$nUploadFileMode);
		$this->assign('sAllAllowType',$sAllAllowType);
		$this->assign('nUploadFlashLimit',$nUploadFlashLimit);
		$this->assign('nFileInputNum',$nFileInputNum);

		$this->display('attachment+add');
	}	

	public function normal_upload(){
		require(Core_Extend::includeFile('function/Upload_Extend'));

		try{
			$sHashcode=G::randString(32);
			Dyhb::cookie('_upload_hashcode_',$sHashcode,3600);

			$arrUploadids=Upload_Extend::uploadNormal();
			$sUploadids=implode(',',$arrUploadids);

			$this->assign('__JumpUrl__',Dyhb::U('home://attachment/attachmentinfo?id='.$sUploadids.'&hash='.$sHashcode));
			$this->assign('hashcode',$sHashcode);

			$this->S('附件上传成功');
		}catch(Exception $e){
			$this->E($e->getMessage());
		}
	}
	
	public function flash_upload(){
		require(Core_Extend::includeFile('function/Upload_Extend'));

		try{
			$arrUploadids=Upload_Extend::uploadFlash();
			echo ($arrUploadids[0]);
		}catch(Exception $e){
			echo '<div class="upload-error">'.
						sprintf('&#8220;%s&#8221; has failed to upload due to an error',htmlspecialchars($_FILES['Filedata']['name'])) . '</strong><br />' .
						htmlspecialchars($e->getMessage()).
				'</div>';
			exit;
		}
	}

	public function attachmentinfo(){
		$sUploadids=trim(G::getGpc('id','G'));
		$sHashcode=trim(G::getGpc('hash','G'));
		$sCookieHashcode=Dyhb::cookie('_upload_hashcode_');
		
		Dyhb::cookie('_upload_hashcode_',null,-1);

		if(empty($sCookieHashcode)){
			//$this->assign('__JumpUrl__',Dyhb::U('home://attachment/add'));
			//$this->E('附件信息编辑页面已过期');
		}

		if($sCookieHashcode!=$sHashcode){
			//$this->assign('__JumpUrl__',Dyhb::U('home://attachment/add'));
			//$this->E('附件信息编辑页面Hash验证失败');
		}

		if(empty($sUploadids)){
			//$this->assign('__JumpUrl__',Dyhb::U('home://attachment/add'));
			$this->E('你没有选择需要编辑的附件');
		}

		$arrAttachments=AttachmentModel::F('user_id=? AND attachment_id in('.$sUploadids.')',$GLOBALS['___login___']['user_id'])->getAll();
		$this->assign('arrAttachments',$arrAttachments);

		$this->display('attachment+attachmentinfo');
	}

	public function attachmentinfo_save(){
		$arrAttachments=G::getGpc('attachments','P');

		if(is_array($arrAttachments)){
			foreach($arrAttachments as $nKey=>$arrAttachment){
				$oAttachment=AttachmentModel::F('attachment_id=?',$nKey)->getOne();
				if(!empty($oAttachment['attachment_id'])){
					$oAttachment->changeProp($arrAttachment);
					$oAttachment->save(0,'update');

					if($oAttachment->isError()){
						$this->E($oAttachment->getErrorMessage());
					}
				}
			}
		}

		$this->assign('__JumpUrl__',Dyhb::U('home://attachment/add'));

		$this->S('附件信息保存成功');
	}

	public function get_image_size($oAttachment){
		if(in_array($oAttachment['attachment_extension'],array('gif','jpg','jpeg','png','bmp'))){
			$sAttachmentFilepath=NEEDFORBUG_PATH.'/data/upload/attachment/'.(
				$oAttachment['attachment_isthumb']?
				$oAttachment['attachment_thumbpath'].'/'.$oAttachment['attachment_savename']:
				$oAttachment['attachment_savepath'].'/'.$oAttachment['attachment_savename']
			);

			if(!is_file($sAttachmentFilepath)){
				$sAttachmentFilepath=NEEDFORBUG_PATH.'/data/upload/attachment/'.$oAttachment['attachment_savepath'].'/'.$oAttachment['attachment_savename'];

				if(!is_file($sAttachmentFilepath)){
					echo (sprintf('图像文件 %s 不存在',$sAttachmentFilepath));
				}
			}

			$arrAttachmentInfo=array();
			$arrTempAttachmentInfo=@getimagesize($sAttachmentFilepath);

			if(empty($arrTempAttachmentInfo)){
				$arrAttachmentInfo[0]=0;
				$arrAttachmentInfo[1]=0;
			}else{
				$arrAttachmentInfo[0]=$arrTempAttachmentInfo[0];
				$arrAttachmentInfo[1]=$arrTempAttachmentInfo[1];
			}

			return $arrAttachmentInfo;
		}else{
			return false;
		}
	}

	public function get_attachment_url($oAttachment){
		return $_SERVER['HTTP_HOST'].__ROOT__.'/data/upload/attachment/'.
			$oAttachment['attachment_savepath'].'/'.$oAttachment['attachment_savename'];
	}

}
