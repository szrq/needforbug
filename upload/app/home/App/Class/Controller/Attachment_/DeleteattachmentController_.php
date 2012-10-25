<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   删除附件操作($)*/

!defined('DYHB_PATH') && exit;

class DeleteattachmentController extends Controller{

	public function index($nId=''){
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

	public function all(){
		$arrAttachmentid=G::getGpc('ids','P');
		$arrAttachmentid=explode(',',$arrAttachmentid);

		if(is_array($arrAttachmentid)){
			foreach($arrAttachmentid as $nAttachmentid){
				$this->delete_attachment($nAttachmentid);
			}
		}
			
		$this->S('批量删除附件成功');
	}

}
