<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   编辑好友备注($)*/

!defined('DYHB_PATH') && exit;

class EditController extends Controller{

	public function index(){
		$nFriendId=G::getGpc('friendid');
		$sComment=trim(G::getGpc('comment'));
		$nFan=intval(G::getGpc('fan'));

		$oFriendModel=Dyhb::instance('FriendModel');
		$oFriendModel->editFriendComment($nFriendId,$GLOBALS['___login___']['user_id'],$sComment,$nFan);
		
		if($oFriendModel->isError()){
			$this->E($oFriendModel->getErrorMessage());
		}else{
			$this->S(Dyhb::L('更新备注成功','Controller/Friend'));
		}
	}

}
