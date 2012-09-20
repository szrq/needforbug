<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   附件管理($)*/

!defined('DYHB_PATH') && exit;

class AttachmentController extends InitController{
		
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
		$sUserauthkey=Dyhb::cookie(md5($GLOBALS['_commonConfig_']['USER_AUTH_KEY']));
		$sAdminauthkey=Dyhb::cookie(md5($GLOBALS['_commonConfig_']['ADMIN_AUTH_KEY']));
		$sHash=Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'hash');
		$sAuth=Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'auth');
		$sAccess=Dyhb::cookie(md5(APP_NAME.MODULE_NAME.ACTION_NAME));

		$this->assign('sUserauthkey',$sUserauthkey);
		$this->assign('sAdminauthkey',$sAdminauthkey);
		$this->assign('sHash',$sHash);
		$this->assign('sAuth',$sAuth);
		$this->assign('sAccess',$sAccess);

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
			$arrUploadids=Upload_Extend::uploadNormal();
			$this->S('附件上传成功');
		}catch(Exception $e){
			$this->E($e->getMessage());
		}
	}
	
	public function flash_upload(){
		require(Core_Extend::includeFile('function/Upload_Extend'));

		// 读取发送过来的COOKIE
		/*$sUserauthkey=trim(G::getGcp('user_auth_key'));
		$sAdminauthkey=trim(G::getGcp('admin_auth_key'));
		$sHash=trim(G::getGcp('hash'));
		$sAuth=trim(G::getGcp('auth'));
		$sAccess=trim(G::getGcp('access'));

		Dyhb::cookie(md5($GLOBALS['_commonConfig_']['USER_AUTH_KEY']),$sUserauthkey);
		Dyhb::cookie(md5($GLOBALS['_commonConfig_']['ADMIN_AUTH_KEY']),$sAdminauthkey);
		Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'hash',$sHash);
		Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'auth',$sAuth);
		Dyhb::cookie(md5(APP_NAME.MODULE_NAME.ACTION_NAME),$sAccess);*/

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

}
