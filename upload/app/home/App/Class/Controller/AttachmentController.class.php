<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   附件管理($)*/

!defined('DYHB_PATH') && exit;

require_once(Core_Extend::includeFile('function/Attachment_Extend'));

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
		Core_Extend::doControllerAction('Attachment@Index','index');
	}

	public function add(){
		Core_Extend::doControllerAction('Attachment@Add','index');
	}

	public function dialog_add(){
		$sFunction=trim(G::getGpc('function','G'));
		$this->assign('sFunction',$sFunction);
		$this->assign('bDialog',true);

		$this->add(true);
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
		Core_Extend::doControllerAction('Attachment@Normalupload','index');
	}
	
	public function flash_upload(){
		Core_Extend::doControllerAction('Attachment@Flashupload','index');
	}

	public function flashinfo(){
		$arrUploadids=G::getGpc('attachids','P');
		$nAttachmentcategoryid=intval(G::getGpc('attachmentcategory_id_flash'));
		$nDialog=intval(G::getGpc('dialog'));
		$sFunction=trim(G::getGpc('function'));

		$sHashcode=G::randString(32);
		Dyhb::cookie('_upload_hashcode_',$sHashcode,3600);

		$sUploadids=implode(',',$arrUploadids);

		if($nDialog==1){
			$this->U('home://attachment/attachmentinfo?id='.$sUploadids.'&hash='.$sHashcode.'&cid='.$nAttachmentcategoryid.'&dialog=1&functon='.$sFunction);
		}else{
			$this->U('home://attachment/attachmentinfo?id='.$sUploadids.'&hash='.$sHashcode.'&cid='.$nAttachmentcategoryid);
		}
	}

	public function attachmentinfo(){
		$sUploadids=trim(G::getGpc('id','G'));
		$sHashcode=trim(G::getGpc('hash','G'));
		$sCookieHashcode=Dyhb::cookie('_upload_hashcode_');
		$nAttachmentcategoryid=intval(G::getGpc('cid'));
		$nDialog=intval(G::getGpc('dialog'));
		$sFunction=trim(G::getGpc('function'));

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
		$this->assign('nDialog',$nDialog);
		$this->assign('sFunction',$sFunction);

		if($nDialog==1){
			$this->display('attachment+dialogattachmentinfo');
		}else{
			$this->display('attachment+attachmentinfo');
		}
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

	public function my_attachmentcategory(){
		Core_Extend::doControllerAction('Attachment@Myattachmentcategory','index');
	}

	public function dialog_addattachmentcategory(){
		$nDialog=intval(G::getGpc('dialog','G'));
		$sFunction=trim(G::getGpc('function','G'));

		$this->assign('nDialog',$nDialog);
		$this->assign('sFunction',$sFunction);
		
		$this->display('attachment+dialogaddattachmentcategory');
	}

	public function dialog_attachmentcategorysave(){
		$nDialog=intval(G::getGpc('dialog','P'));
		$sFunction=trim(G::getGpc('function','P'));

		$oAttachmentcategory=new AttachmentcategoryModel();
		$oAttachmentcategory->save(0);

		if($oAttachmentcategory->isError()){
			$this->E($oAttachmentcategory->getErrorMessage());
		}

		$this->U(Dyhb::U('home://attachment/my_attachmentcategory?dialog=1&function='.$sFunction),1,'专辑保存成功');
	}

	public function edit_attachmentcategory(){
		Core_Extend::doControllerAction('Attachment@Editattachmentcategory','index');
	}

	public function edit_attachmentcategorysave(){
		Core_Extend::doControllerAction('Attachment@Editattachmentcategory','save');
	}

	public function my_attachment(){
		Core_Extend::doControllerAction('Attachment@Myattachment','index');
	}

	public function dialog_editattachmentcategorysave(){
		$nAttachmentcategoryid=intval(G::getGpc('attachmentcategory_id','G'));
		$nDialog=intval(G::getGpc('dialog'));
		$sFunction=trim(G::getGpc('function'));

		$oAttachmentcategory=AttachmentcategoryModel::F('attachmentcategory_id=?',$nAttachmentcategoryid)->getOne();
		$oAttachmentcategory->save(0,'update');

		if($oAttachmentcategory->isError()){
			$this->E($oAttachmentcategory->getErrorMessage());
		}

		G::urlGoTo(Dyhb::U('home://attachment/my_attachmentcategory?dialog=1&function='.$sFunction),1,'更新专辑信息成功');
	}

	public function delete_attachmentcategory(){
		Core_Extend::doControllerAction('Attachment@Deleteattachmentcategory','index');
	}

	public function edit_attachment(){
		Core_Extend::doControllerAction('Attachment@Editattachment','index');
	}

	public function edit_attachmentsave(){
		Core_Extend::doControllerAction('Attachment@Editattachment','save');
	}

	public function delete_attachment(){
		Core_Extend::doControllerAction('Attachment@Deleteattachment','index');
	}

	public function delete_attachments(){
		Core_Extend::doControllerAction('Attachment@Deleteattachment','all');
	}

	public function attachmentcategory(){
		Core_Extend::doControllerAction('Attachment@Attachmentcategory','index');
	}

	public function attachment(){
		Core_Extend::doControllerAction('Attachment@Attachmentlist','index');
	}

	public function show(){
		Core_Extend::doControllerAction('Attachment@Show','index');
	}

	public function get_ajaximg(){
		Core_Extend::doControllerAction('Attachment@Getajaximg','index');
	}

	public function get_attachmentcategory_playlist(){
		Core_Extend::doControllerAction('Attachment@Getattachmentcategoryplaylist','index');
	}

	public function recommend_attachment(){
		Core_Extend::doControllerAction('Attachment@Recommendattachment','index');
	}

	public function unrecommend_attachment(){
		Core_Extend::doControllerAction('Attachment@Recommendattachment','un');
	}

	public function recommend_attachmentcategory(){
		Core_Extend::doControllerAction('Attachment@Recommendattachmentcategory','index');
	}	
	
	public function unrecommend_attachmentcategory(){
		Core_Extend::doControllerAction('Attachment@Recommendattachmentcategory','un');
	}

}
