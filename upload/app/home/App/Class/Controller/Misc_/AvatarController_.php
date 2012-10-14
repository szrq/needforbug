<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   头像控制器($)*/

!defined('DYHB_PATH') && exit;

class AvatarController extends Controller{

	public function index(){
		$nUserid=intval(G::getGpc('id','G'));

		if(empty($nUserid)){
			return '';
		}

		$oUser=UserModel::F('user_id=?',$nUserid)->getOne();
		if(empty($oUser['user_id'])){
			return '';
		}

		$oUserprofile=UserprofileModel::F('user_id=?',$nUserid)->getOne();
		if(empty($oUserprofile['user_id'])){
			return '';
		}

		// 取得性别图标
		$sUsergender='';
		switch($oUserprofile['userprofile_gender']){
			case '0':
				$sUsergender=__PUBLIC__.'/images/common/sex/secrecy.png';
				break;
			case '1':
				$sUsergender=__PUBLIC__.'/images/common/sex/male.png';
				break;
			case '2':
				$sUsergender=__PUBLIC__.'/images/common/sex/female.png';
				break;
		}

		$this->assign('oUser',$oUser);
		$this->assign('sUsergender',$sUsergender);
		$this->assign('oUserprofile',$oUserprofile);

		$this->display('misc+avatar');
	}

}
