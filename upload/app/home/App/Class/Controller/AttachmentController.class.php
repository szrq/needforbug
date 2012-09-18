<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   ¸½¼þ¹ÜÀí($)*/

!defined('DYHB_PATH') && exit;

class AttachmentController extends InitController{
		
	public function index(){
		$this->display('attachment+index');
	}

	public function add(){
		$this->display('attachment+add');
	}	
	
	public function flash_upload(){
		require(Core_Extend::includeFile('function/Upload_Extend'));

		try{
			$arrUploadids=Upload_Extend::uploadFlash();
			G::dump($arrUploadids);
		}catch(Exception $e){
			echo '<div class="error-div">
						<a class="dismiss" href="#" onclick="jQuery(this).parents(\'div.media-item\').slideUp(200, function(){jQuery(this).remove();});">' . 'Dismiss' . '</a>
						<strong>' . sprintf('&#8220;%s&#8221; has failed to upload due to an error',htmlspecialchars($_FILES['Filedata']['name'])) . '</strong><br />' .
						htmlspecialchars($e->getMessage()).
					'</div>';
			exit;
		}
	}

}
