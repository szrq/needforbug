<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   个人空间头像($)*/

!defined('DYHB_PATH') && exit;

class AvatarController extends Controller{

	public function index(){
		$nId=intval(G::getGpc('id','G'));
		if(empty($nId)){
			$nId=$GLOBALS['___login___']['user_id'];
		}
		
		$oUserInfo=UserModel::F()->getByuser_id($nId);
		if(empty($oUserInfo['user_id'])){
			$this->E(Dyhb::L('你指定的用户不存在','Controller/Space'));
		}else{
			$this->assign('oUserInfo',$oUserInfo);
		}

		$arrAvatarInfo=array();
		$arrAvatarInfo=Core_Extend::avatars($GLOBALS['___login___']['user_id']);

		$this->assign('arrAvatarInfo',$arrAvatarInfo);
		$this->assign('nId',$nId);

		$this->display('space+avatar');
	}

	public function index_title_(){
		return '我的头像';
	}

}
