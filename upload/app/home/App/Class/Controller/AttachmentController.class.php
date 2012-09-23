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

	public function get_allowed_type(){
		return explode('|',$GLOBALS['_option_']['upload_allowed_type']);
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

		// 附件分类
		$arrAttachmentcategorys=$this->get_attachmentcategory();
		$this->assign('arrAttachmentcategorys',$arrAttachmentcategorys);

		// 所有允许的分类
		$arrAllowedTypes=$this->get_allowed_type();
		$this->assign('arrAllowedTypes',$arrAllowedTypes);

		$this->assign('nUploadfileMaxsize',$nUploadfileMaxsize);
		$this->assign('nUploadFileMode',$nUploadFileMode);
		$this->assign('sAllAllowType',$sAllAllowType);
		$this->assign('nUploadFlashLimit',$nUploadFlashLimit);
		$this->assign('nFileInputNum',$nFileInputNum);

		$this->display('attachment+add');
	}

	public function get_attachmentcategory(){
		$oAttachmentcategory=Dyhb::instance('AttachmentcategoryModel');
		return $oAttachmentcategory->getAttachmentcategoryByUserid($GLOBALS['___login___']['user_id']);
	}

	public function new_attachmentcategory(){
		$this->display('attachment+newattachmentcategory');
	}

	public function new_attachmentcategorysave(){
		$nAttachmentcategoryCompositor=intval(G::getGpc('attachmentcategory_compositor','G'));
		$sAttachmentcategoryName=trim(G::getGpc('attachmentcategory_name','G'));
		$sAttachmentcategoryDescription=trim(G::getGpc('attachmentcategory_description','G'));

		$oAttachmentcategory=new AttachmentcategoryModel();
		$oAttachmentcategory->attachmentcategory_compositor=$nAttachmentcategoryCompositor;
		$oAttachmentcategory->attachmentcategory_name=$sAttachmentcategoryName;
		$oAttachmentcategory->attachmentcategory_description=$sAttachmentcategoryDescription;
		$oAttachmentcategory->save(0);

		if($oAttachmentcategory->isError()){
			$this->E($oAttachmentcategory->getErrorMessage());
		}

		$this->A($oAttachmentcategory->toArray(),'新增专辑成功',1);
	}

	public function normal_upload(){
		require(Core_Extend::includeFile('function/Upload_Extend'));

		try{
			$nAttachmentcategoryid=intval(G::getGpc('attachmentcategory_id'));

			$sHashcode=G::randString(32);
			Dyhb::cookie('_upload_hashcode_',$sHashcode,3600);

			$arrUploadids=Upload_Extend::uploadNormal();
			$sUploadids=implode(',',$arrUploadids);

			$this->assign('__JumpUrl__',Dyhb::U('home://attachment/attachmentinfo?id='.$sUploadids.'&hash='.$sHashcode.'&cid='.$nAttachmentcategoryid));

			$this->S('附件上传成功');
		}catch(Exception $e){
			$this->E($e->getMessage());
		}
	}
	
	public function flash_upload(){
		require(Core_Extend::includeFile('function/Upload_Extend'));

		try{
			$_POST['attachmentcategory_id']=intval(G::getGpc('attachmentcategory_id'));

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

	public function flashinfo(){
		$arrUploadids=G::getGpc('attachids','P');
		$nAttachmentcategoryid=intval(G::getGpc('attachmentcategory_id_flash'));

		$sHashcode=G::randString(32);
		Dyhb::cookie('_upload_hashcode_',$sHashcode,3600);

		$sUploadids=implode(',',$arrUploadids);

		$this->U('home://attachment/attachmentinfo?id='.$sUploadids.'&hash='.$sHashcode.'&cid='.$nAttachmentcategoryid);
	}

	public function attachmentinfo(){
		$sUploadids=trim(G::getGpc('id','G'));
		$sHashcode=trim(G::getGpc('hash','G'));
		$sCookieHashcode=Dyhb::cookie('_upload_hashcode_');
		$nAttachmentcategoryid=intval(G::getGpc('cid'));

		if(empty($sCookieHashcode)){
			$this->assign('__JumpUrl__',Dyhb::U('home://attachment/add'));
			$this->E('附件信息编辑页面已过期');
		}

		if($sCookieHashcode!=$sHashcode){
			$this->assign('__JumpUrl__',Dyhb::U('home://attachment/add'));
			$this->E('附件信息编辑页面Hash验证失败');
		}

		if(empty($sUploadids)){
			$this->assign('__JumpUrl__',Dyhb::U('home://attachment/add'));
			$this->E('你没有选择需要编辑的附件');
		}

		$arrAttachments=AttachmentModel::F('user_id=? AND attachment_id in('.$sUploadids.')',$GLOBALS['___login___']['user_id'])->getAll();

		$this->assign('arrAttachments',$arrAttachments);
		$this->assign('nAttachmentcategoryid',$nAttachmentcategoryid);

		$this->display('attachment+attachmentinfo');
	}

	public function attachmentinfo_save(){
		$arrAttachments=G::getGpc('attachments','P');
		$nAttachmentcategoryid=intval(G::getGpc('attachmentcategory_id'));

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

		Dyhb::cookie('_upload_hashcode_',null,-1);

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
					echo(sprintf('图像文件 %s 不存在',$sAttachmentFilepath));
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

	public function get_attachmentpreview_imagesize($oAttachmentcategory){
		$sAttachmentcategorypreview=Core_Extend::getAttachmentcategoryPreview($oAttachmentcategory,false);

		$arrAttachmentcategorypreview=array();
		$arrTempAttachmentcategorypreview=@getimagesize($sAttachmentcategorypreview);

		if(empty($arrTempAttachmentcategorypreview)){
			$arrAttachmentcategorypreview[0]=0;
			$arrAttachmentcategorypreview[1]=0;
		}else{
			$arrAttachmentcategorypreview[0]=$arrTempAttachmentcategorypreview[0];
			$arrAttachmentcategorypreview[1]=$arrTempAttachmentcategorypreview[1];
		}

		return $arrAttachmentcategorypreview;
	}

	public function get_attachment_url($oAttachment){
		return $_SERVER['HTTP_HOST'].__ROOT__.'/data/upload/attachment/'.
			$oAttachment['attachment_savepath'].'/'.$oAttachment['attachment_savename'];
	}

	public function my_attachmentcategory(){
		$arrWhere=array();
		$arrWhere['user_id']=$GLOBALS['___login___']['user_id'];

		// 取得专辑列表
		$nTotalRecord=AttachmentcategoryModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,10,G::getGpc('page','G'));
		$arrAttachmentcategorys=AttachmentcategoryModel::F()->where($arrWhere)->order('attachmentcategory_compositor DESC,create_dateline DESC')->limit($oPage->returnPageStart(),10)->getAll();

		$this->assign('arrAttachmentcategorys',$arrAttachmentcategorys);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));

		$this->display('attachment+myattachmentcategory');
	}

	public function edit_attachmentcategory(){
		$nAttachmentcategoryid=intval(G::getGpc('id'));

		if(empty($nAttachmentcategoryid)){
			exit('你没有选择你要编辑的专辑');
		}

		$oAttachmentcategory=AttachmentcategoryModel::F('attachmentcategory_id=?',$nAttachmentcategoryid)->getOne();
		if(empty($oAttachmentcategory['attachmentcategory_id'])){
			exit('你要编辑的专辑不存在');
		}

		if($oAttachmentcategory['user_id']!=$GLOBALS['___login___']['user_id']){
			exit('你不能编辑别人的专辑');
		}

		$this->assign('oAttachmentcategory',$oAttachmentcategory);

		$this->display('attachment+editattachmentcategory');
	}

	public function my_attachment(){
		$sType=trim(G::getGpc('type','G'));
		$nAttachmentcategoryid=G::getGpc('cid','G');
		$nPhoto=G::getGpc('photo','G');
		
		$arrWhere=array();

		if($sType){
			$arrWhere['attachment_extension']=$sType;
		}

		if($nPhoto=='1'){
			$arrWhere['attachment_extension']=array('in','gif,jpeg,jpg,png,bmp');
		}elseif($nPhoto=='0'){
			$arrWhere['attachment_extension']=array('not in','gif,jpeg,jpg,png,bmp');
		}

		if($nAttachmentcategoryid!==null){
			$arrWhere['attachmentcategory_id']=intval($nAttachmentcategoryid);

			// 取得专辑信息
			$arrAttachmetncategoryinfo=array();
			if($nAttachmentcategoryid==0){
				$nDefaultattachmentnum=AttachmentModel::F('user_id=? AND attachmentcategory_id=0',$GLOBALS['___login___']['user_id'])->all()->getCounts();
				$arrAttachmetncategoryinfo['totalnum']=$nDefaultattachmentnum;
			}elseif($nAttachmentcategoryid>0){
				$oAttachmentcategoryinfo=AttachmentcategoryModel::F('attachmentcategory_id=?',$nAttachmentcategoryid)->getOne();
				if(!empty($oAttachmentcategoryinfo['attachmentcategory_id'])){
					$arrAttachmetncategoryinfo=$oAttachmentcategoryinfo->toArray();
				}else{
					$arrAttachmetncategoryinfo=false;
				}
			}

			$this->assign('arrAttachmetncategoryinfo',$arrAttachmetncategoryinfo);
		}

		$arrWhere['user_id']=$GLOBALS['___login___']['user_id'];

		// 取得附件列表
		$nTotalRecord=AttachmentModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,10,G::getGpc('page','G'));
		$arrAttachments=AttachmentModel::F()->where($arrWhere)->order('attachment_id DESC')->limit($oPage->returnPageStart(),10)->getAll();

		// 附件分类
		$arrAttachmentcategorys=$this->get_attachmentcategory();
		$this->assign('arrAttachmentcategorys',$arrAttachmentcategorys);

		// 所有允许的分类
		$arrAllowedTypes=$this->get_allowed_type();
		$this->assign('arrAllowedTypes',$arrAllowedTypes);

		$this->assign('arrAttachments',$arrAttachments);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nAttachmentcategoryid',$nAttachmentcategoryid);

		$this->display('attachment+myattachment');
	}

	public function edit_attachmentcategorysave(){
		$nAttachmentcategoryid=intval(G::getGpc('attachmentcategory_id','G'));
		$sAttachmentcategoryname=trim(G::getGpc('attachmentcategory_name','G'));
		$sAttachmentcategorycompositor=intval(G::getGpc('attachmentcategory_compositor','G'));
		$sAttachmentcategorydescription=trim(G::getGpc('attachmentcategory_description','G'));

		$oAttachmentcategory=AttachmentcategoryModel::F('attachmentcategory_id=?',$nAttachmentcategoryid)->getOne();
		$oAttachmentcategory->attachmentcategory_name=$sAttachmentcategoryname;
		$oAttachmentcategory->attachmentcategory_compositor=$sAttachmentcategorycompositor;
		$oAttachmentcategory->attachmentcategory_description=$sAttachmentcategorydescription;
		$oAttachmentcategory->save(0,'update');

		if($oAttachmentcategory->isError()){
			$this->E($oAttachmentcategory->getErrorMessage());
		}

		$this->A($oAttachmentcategory->toArray(),'更新专辑信息成功',1);
	}

	public function delete_attachmentcategory($nId=''){
		if(empty($nId)){
			$nAttachmentcategoryid=intval(G::getGpc('id','G'));
		}else{
			$nAttachmentcategoryid=$nId;
		}

		if(empty($nAttachmentcategoryid)){
			$this->E('你没有选择你要删除的专辑');
		}

		$oAttachmentcategory=AttachmentcategoryModel::F('attachmentcategory_id=?',$nAttachmentcategoryid)->getOne();
		if(empty($oAttachmentcategory['attachmentcategory_id'])){
			$this->E('你要删除的专辑不存在');
		}

		if($oAttachmentcategory['user_id']!=$GLOBALS['___login___']['user_id']){
			$this->E('你不能删除别人的专辑');
		}

		$nTotalRecord=AttachmentModel::F('attachmentcategory_id=?',$oAttachmentcategory['attachmentcategory_id'])->all()->getCounts();
		if($nTotalRecord>0){
			$this->E('专辑含有照片，请先删除照片后再删除专辑');
		}

		$oAttachmentcategory->destroy();

		if(!$nId){
			$this->S('专辑删除成功');
		}
	}

	public function edit_attachment(){
		$nAttachmentid=intval(G::getGpc('id'));

		if(empty($nAttachmentid)){
			exit('你没有选择你要编辑的附件');
		}

		$oAttachment=AttachmentModel::F('attachment_id=?',$nAttachmentid)->getOne();
		if(empty($oAttachment['attachment_id'])){
			exit('你要编辑的附件不存在');
		}

		if($oAttachment['user_id']!=$GLOBALS['___login___']['user_id']){
			exit('你不能编辑别人的附件');
		}

		$this->assign('oAttachment',$oAttachment);

		$this->display('attachment+editattachment');
	}

	public function edit_attachmentsave(){
		$nAttachmentid=intval(G::getGpc('attachment_id','G'));
		$sAttachmentname=trim(G::getGpc('attachment_name','G'));
		$sAttachmentalt=trim(G::getGpc('attachment_alt','G'));
		$sAttachmentdescription=trim(G::getGpc('attachment_description','G'));

		$oAttachment=AttachmentModel::F('attachment_id=?',$nAttachmentid)->getOne();
		$oAttachment->attachment_name=$sAttachmentname;
		$oAttachment->attachment_alt=$sAttachmentalt;
		$oAttachment->attachment_description=$sAttachmentdescription;
		$oAttachment->save(0,'update');

		if($oAttachment->isError()){
			$this->E($oAttachment->getErrorMessage());
		}

		$this->A($oAttachment->toArray(),'更新附件信息成功',1);
	}

	public function delete_attachment($nId=''){
		if(empty($nId)){
			$nAttachmentid=intval(G::getGpc('id','G'));
		}else{
			$nAttachmentid=$nId;
		}

		if(empty($nAttachmentid)){
			$this->E('你没有选择你要删除的附件');
		}

		$oAttachment=AttachmentModel::F('attachment_id=?',$nAttachmentid)->getOne();
		if(empty($oAttachment['attachment_id'])){
			$this->E('你要删除的附件不存在');
		}

		if($oAttachment['user_id']!=$GLOBALS['___login___']['user_id']){
			$this->E('你不能删除别人的附件');
		}

		// 删除附件图片
		$sFilepath=NEEDFORBUG_PATH.'/data/upload/attachment/'.$oAttachment['attachment_savepath'].'/'.$oAttachment['attachment_savename'];
		$sThumbfilepath=NEEDFORBUG_PATH.'/data/upload/attachment/'.$oAttachment['attachment_thumbpath'].'/'.$oAttachment['attachment_savename'];

		if(is_file($sFilepath)){
			@unlink($sFilepath);
		}

		if(is_file($sThumbfilepath)){
			@unlink($sThumbfilepath);
		}

		$oAttachment->destroy();

		if(!$nId){
			$this->S('附件删除成功');
		}
	}

	public function delete_attachments(){
		$arrAttachmentid=G::getGpc('ids','P');
		$arrAttachmentid=explode(',',$arrAttachmentid);

		if(is_array($arrAttachmentid)){
			foreach($arrAttachmentid as $nAttachmentid){
				$this->delete_attachment($nAttachmentid);
			}
		}
			
		$this->S('批量删除附件成功');
	}

	public function attachmentcategory(){
		$nRecommend=intval(G::getGpc('recommend','G'));

		$arrWhere=array();
		if($nRecommend==1){
			$arrWhere['attachmentcategory_recommend']=1;
		}

		// 取得专辑列表
		$nTotalRecord=AttachmentcategoryModel::F($arrWhere)->all(array())->getCounts();
		$oPage=Page::RUN($nTotalRecord,10,G::getGpc('page','G'));
		$arrAttachmentcategorys=AttachmentcategoryModel::F($arrWhere)->order('attachmentcategory_id DESC')->limit($oPage->returnPageStart(),10)->getAll();

		$this->assign('arrAttachmentcategorys',$arrAttachmentcategorys);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));

		$this->display('attachment+attachmentcategory');
	}

	public function attachment(){
		$nAttachmentcategoryid=G::getGpc('cid','G');
		$nRecommend=intval(G::getGpc('recommend','G'));
		$sType=trim(G::getGpc('type','G'));
		$nPhoto=G::getGpc('photo','G');
		$nRecommend=intval(G::getGpc('recommend','G'));

		$arrWhere=array();

		if($sType){
			$arrWhere['attachment_extension']=$sType;
		}

		if($nPhoto=='1'){
			$arrWhere['attachment_extension']=array('in','gif,jpeg,jpg,png,bmp');
		}elseif($nPhoto=='0'){
			$arrWhere['attachment_extension']=array('not in','gif,jpeg,jpg,png,bmp');
		}

		if($nRecommend==1){
			$arrWhere['attachment_recommend']=1;
		}

		if($nAttachmentcategoryid!==null){
			$arrWhere['attachmentcategory_id']=intval($nAttachmentcategoryid);

			// 取得专辑信息
			$arrAttachmetncategoryinfo=array();
			if($nAttachmentcategoryid==0){
				$nDefaultattachmentnum=AttachmentModel::F('user_id=? AND attachmentcategory_id=0',$GLOBALS['___login___']['user_id'])->all()->getCounts();
				$arrAttachmetncategoryinfo['totalnum']=$nDefaultattachmentnum;
			}elseif($nAttachmentcategoryid>0){
				$oAttachmentcategoryinfo=AttachmentcategoryModel::F('attachmentcategory_id=?',$nAttachmentcategoryid)->getOne();
				if(!empty($oAttachmentcategoryinfo['attachmentcategory_id'])){
					$arrAttachmetncategoryinfo=$oAttachmentcategoryinfo->toArray();
				}else{
					$arrAttachmetncategoryinfo=false;
				}
			}

			$this->assign('arrAttachmetncategoryinfo',$arrAttachmetncategoryinfo);
		}

		// 取得附件列表
		$nTotalRecord=AttachmentModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,10,G::getGpc('page','G'));
		$arrAttachments=AttachmentModel::F()->where($arrWhere)->order('attachment_id DESC')->limit($oPage->returnPageStart(),10)->getAll();

		// 附件分类
		$arrAttachmentcategorys=$this->get_attachmentcategory();
		$this->assign('arrAttachmentcategorys',$arrAttachmentcategorys);

		// 所有允许的分类
		$arrAllowedTypes=$this->get_allowed_type();
		$this->assign('arrAllowedTypes',$arrAllowedTypes);

		$this->assign('arrAttachments',$arrAttachments);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nAttachmentcategoryid',$nAttachmentcategoryid);

		$this->display('attachment+attachment');
	}

	public function show(){
		$nAttachmentid=intval(G::getGpc('id','G'));

		if(empty($nAttachmentid)){
			$this->E('你没有指定要查看的附件');
		}

		$oAttachment=AttachmentModel::F('attachment_id=?',$nAttachmentid)->getOne();
		if(empty($oAttachment['attachment_id'])){
			$this->E('你要查看的文件不存在');
		}

		$this->assign('oAttachment',$oAttachment);

		$this->display('attachment+show');
	}

	public function show_attachment($oAttachment){
		$sAttachmentType=$this->get_attachmenttype($oAttachment);

		if(in_array($sAttachmentType,array('img','swf','wmp','mp3','real','flv','url'))){
			if(is_callable(array('AttachmentController','show_'.$sAttachmentType))){
				call_user_func(array('AttachmentController','show_'.$sAttachmentType),$oAttachment);
			}else{
				Dyhb::E('callback not exist');
			}
		}else{
			$this->show_download($oAttachment);
		}
	}

	public function get_attachmenttype($oAttachment){
		$arrAttachmentTypes=array(
			'img'=>array('jpg','jpeg','gif','png','bmp'),
			'swf'=>array('swf'),
			'wmp'=>array('wma','asf','wmv'),
			'mp3'=>array('mp3'),
			'real'=>array('rm','rmvb','ra','ram'),
			'flv'=>array('flv','mp4','aac'),
			'url'=>array('html','htm','txt'),
			'download'=>array(),
		);
		
		$sAttachmentExtension=$oAttachment['attachment_extension'];

		foreach($arrAttachmentTypes as $sKey=>$arrAttachmentType){
			if(in_array($sAttachmentExtension,$arrAttachmentType)){
				return $sKey;
			}
		}
			
		return 'download';
	}

	public function get_ajaximg(){
		$nAttachmentid=intval(G::getGpc('id','G'));
		$nAttachmentcategoryid=intval(G::getGpc('cid','G'));

		$arrAttachments=AttachmentModel::F('user_id=? AND attachmentcategory_id=? AND attachment_extension in(\'gif\',\'jpeg\',\'jpg\',\'png\',\'bmp\')',$GLOBALS['___login___']['user_id'],$nAttachmentcategoryid)->order('attachment_id DESC')->getAll();

		
		$nIndex=0;
		$sContent='';
		if(is_array($arrAttachments)){
			foreach($arrAttachments as $nKey=>$oAttachment){
				if($nAttachmentid==$oAttachment['attachment_id']){
					$nIndex=$nKey;
				}

				$sContent.='<li>
						<a href="'.__ROOT__.'/data/upload/attachment/'.$oAttachment['attachment_savepath'].'/'.$oAttachment['attachment_savename'].'">
							<img height="60px" src="'.Core_Extend::getAttachmentPreview($oAttachment).'" title="'.$oAttachment['attachment_name'].'" alt="'.$oAttachment['attachment_alt'].'" class="image'.$oAttachment['attachment_id'].'">
						</a>
					</li>';
			}
		}

		exit(json_encode(array('index'=>$nIndex,'content'=>$sContent)));
	}

	public function show_img($oAttachment){
		$this->assign('oAttachment',$oAttachment);
		$this->display('attachment+showimg');
	}

	public function show_download($oAttachment){
		$this->assign('sAttachmentIcon',__PUBLIC__.'/images/common/media/download.gif');
		$this->assign('oAttachment',$oAttachment);
		$this->display('attachment+download');
	}

	public function get_attachmentdownload_url($oAttachment,$bThumb=false){
		return $oAttachment['attachment_isthumb'] && $bThumb===true?
				__ROOT__.'/data/upload/attachment/'.$oAttachment['attachment_thumbpath'].'/'.
				$oAttachment['attachment_thumbprefix'].$oAttachment['attachment_savename']:
				__ROOT__.'/data/upload/attachment/'.$oAttachment['attachment_savepath'].'/'.$oAttachment['attachment_savename'];
	}

}
