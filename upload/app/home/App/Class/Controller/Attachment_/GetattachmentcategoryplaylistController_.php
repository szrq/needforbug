<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   音乐专辑播放($)*/

!defined('DYHB_PATH') && exit;

class GetattachmentcategoryplaylistController extends Controller{

	public function index($oAttachment){
		return $GLOBALS['_option_']['site_url'].'/index.php?app=home&c=attachment&a=mp3list&cid='.
			$oAttachment['attachmentcategory_id'].'&uid='.$oAttachment['user_id'];
	}

}
