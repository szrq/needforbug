<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Flash上传逻辑处理($)*/

!defined('DYHB_PATH') && exit;

class FlashuploadController extends Controller{

	public function index(){
		require(Core_Extend::includeFile('function/Upload_Extend'));

		try{
			$_POST['attachmentcategory_id']=intval(G::getGpc('attachmentcategory_id'));

			$arrUploadids=Upload_Extend::uploadFlash();
			echo ($arrUploadids[0]);
		}catch(Exception $e){
			echo '<div class="upload-error">'.
						sprintf('&#8220;%s&#8221; has failed to upload due to an error',htmlspecialchars($_FILES['Filedata']['name'])).'</strong><br />'.
						htmlspecialchars($e->getMessage()).
				'</div>';
			exit;
		}
	}

}
