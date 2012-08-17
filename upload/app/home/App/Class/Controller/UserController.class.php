<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台首页显示($)*/

!defined('DYHB_PATH') && exit;

class UserController extends InitController{

	public function init__(){
		parent::init__();

		$this->is_login();
	}
	
	public function index(){
		$arrWhere=array();
		
		$sType=trim(G::getGpc('type','G'));
		if(empty($sType)){
			$sType='';
		}
		$this->assign('sType',$sType);
		
		switch($sType){
			case 'myself':
				$arrWhere['user_id']=$GLOBALS['___login___']['user_id'];
				break;
			case 'friend':
				// 仅好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
				
				if(!empty($arrUserIds)){
					$arrWhere['user_id']=$arrUserIds;
				}else{
					$arrWhere['user_id']='';
				}
				break;
			case 'all':
				// 这里可以设置用户隐私，比如用户不愿意将动态放出
				break;
			default:
				// 我和好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
				$arrUserIds[]=$GLOBALS['___login___']['user_id'];

				if(!empty($arrUserIds)){
					$arrWhere['user_id']=array('in',$arrUserIds);
				}else{
					$arrWhere['user_id']='';
				}
				break;
		}
		
		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		// 新鲜事
		$arrWhere['homefresh_status']=1;
		$nTotalRecord=HomefreshModel::F()->where($arrWhere)->all()->getCounts();

		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefresh_list_num'],G::getGpc('page','G'));

		$arrHomefreshs=HomefreshModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefresh_list_num'])->getAll();
		$this->assign('arrHomefreshs',$arrHomefreshs);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_publish_status']);
		
		$this->display('user+index');
	}

	public function add_homefresh(){
		if($GLOBALS['_option_']['seccode_publish_status']==1){
			$this->check_seccode(true);
		}

		$sMessage=trim(G::cleanJs(G::getGpc('homefresh_message','P')));
		if(empty($sMessage)){
			$this->E(Dyhb::L('新鲜事内容不能为空','Controller/User'));
		}
		
		$oHomefresh=new HomefreshModel();
		$oHomefresh->safeInput();
		$oHomefresh->homefresh_status=1;
		$oHomefresh->save(0,'save');

		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}else{
			// 判断是否将新鲜事更新到签名
			if(G::getGpc('synchronized-to-sign','P')==1){
				if(strlen($sMessage)>1000){
					$sMessage=Core_Extend::htmlSubstring($sMessage,1000);
				}
				
				// 更新到前用户的签名信息
				$oUser=UserModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();
				$oUser->user_sign=$sMessage;
				$oUser->save(0,'update');
		
				if($oUser->isError()){
					$this->E($oUser->getErrorMessage());
				}
			}
			
			$this->S(Dyhb::L('添加新鲜事成功','Controller/User'));
		}
	}

	public function base(){
		require_once(Core_Extend::includeFile('function/Profile_Extend'));
		
		$sDo=G::getGpc('do','G');
		if(!in_array($sDo,array('','base','contact','edu','work','info'))){
			$sDo='';
		}

		Core_Extend::loadCache('userprofilesetting');
		$this->assign('arrUserprofilesettingDatas',$GLOBALS['_cache_']['userprofilesetting']);
		
		$arrUserData=$GLOBALS['___login___'];
		$oUserInfo=UserModel::F()->getByuser_id($arrUserData['user_id']);
		$this->assign('oUserInfo',$oUserInfo);

		$arrUserprofile=$oUserInfo->userprofile->toArray();
		$nNowYear=date('Y',CURRENT_TIMESTAMP);
		if(in_array($arrUserprofile['userprofile_birthmonth'],array(1,3,5,7,8,10,12))){
			$nDays=31;
		}elseif(in_array($arrUserprofile['userprofile_birthmonth'],array(4,6,9,11))){
			$nDays=30;
		}elseif($arrUserprofile['userprofile_birthyear'] &&
			(($arrUserprofile['userprofile_birthyear']%400==0) || ($arrUserprofile['userprofile_birthyear']%4==0 && $arrUserprofile['userprofile_birthyear']%400!=0))
		){
			$nDays=29;
		}else{
			$nDays=28;
		}

		$this->assign('nNowYear',$nNowYear);
		$this->assign('nNowDays',$nDays);
		$this->assign('sDirthDistrict',Profile_Extend::getDistrict($arrUserprofile,'birth'));
		$this->assign('sResideDistrict',Profile_Extend::getDistrict($arrUserprofile,'reside'));
		$this->assign('sDo',$sDo);

		// 视图
		$arrProfileSetting=Profile_Extend::getProfileSetting();

		$this->assign('arrBases',$arrProfileSetting[0]);
		$this->assign('arrContacts',$arrProfileSetting[1]);
		$this->assign('arrEdus',$arrProfileSetting[2]);
		$this->assign('arrWorks',$arrProfileSetting[3]);
		$this->assign('arrInfos',$arrProfileSetting[4]);

		$arrInfoMenus=Profile_Extend::getInfoMenu();

		$this->assign('arrInfoMenus',$arrInfoMenus);
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_changeinformation_status']);

		$this->display('user+base');
	}

	public function change_info(){
		if($GLOBALS['_option_']['seccode_changeinformation_status']==1){
			$this->check_seccode(true);
		}

		$nUserId=G::getGpc('user_id','P');
		$oUser=UserModel::F('user_id=?',$nUserId)->query();
		$oUser->safeInput();
		$arrUserprofilesettings=UserprofilesettingModel::F()->getAll();
		foreach($arrUserprofilesettings as $oUserprofilesetting){
			if(isset($_POST[$oUserprofilesetting['userprofilesetting_id']])){
				if(in_array($oUserprofilesetting['userprofilesetting_id'],array('userprofile_bio','userprofile_interest','user_remark','user_sign'))){
					$oUser->userprofile->{$oUserprofilesetting['userprofilesetting_id']}=G::cleanJs($_POST[$oUserprofilesetting['userprofilesetting_id']]);
				}else{
					$oUser->userprofile->{$oUserprofilesetting['userprofilesetting_id']}=$_POST[$oUserprofilesetting['userprofilesetting_id']];
				}
			}
		}

		$oUser->save(1,'update');

		if($oUser->isError()){
			$this->E($oUser->getErrorMessage());
		}else{
			$this->S(Dyhb::L('修改用户资料成功','Controller/User'));
		}
	}

	public function avatar(){
		$arrAvatarInfo=array();
		$arrAvatarInfo=Core_Extend::avatars($GLOBALS['___login___']['user_id']);
		
		$arrOptionData=$GLOBALS['_option_'];
		
		$this->assign('arrAvatarInfo',$arrAvatarInfo);
		$this->assign('nUploadSize',Core_Extend::getUploadSize($arrOptionData['avatar_uploadfile_maxsize']));
		
		$this->display('user+avatar');
	}

	public function avatar_upload(){
		if($_FILES['image']['error']==4){
			$this->E(Dyhb::L('你没有选择任何文件','Controller/User'));
			return;
		}

		if(!is_dir(dirname(NEEDFORBUG_PATH.'/data/avatar/temp')) && !G::makeDir(NEEDFORBUG_PATH.'/data/avatar/temp')){
			$this->E(Dyhb::L('上传目录 %s 不可写','Controller/User',null,NEEDFORBUG_PATH.'/data/avatar/temp'));
		}

		require_once(Core_Extend::includeFile('function/Avatar_Extend'));
		$oUploadfile=Avatar_Extend::avatarTemp();
		if(!$oUploadfile->upload()){
			$this->E($oUploadfile->getErrorMessage());
		}else{
			$arrPhotoInfo=$oUploadfile->getUploadFileInfo();
		}

		$this->assign('arrPhotoInfo',reset($arrPhotoInfo));

		$this->display('user+avatarupload');
	}

	public function save_crop(){
		require_once(Core_Extend::includeFile('function/Avatar_Extend'));
		$bResult=Avatar_Extend::saveCrop();
		if($bResult===false){
			$this->E(Dyhb::L('你的PHP 版本或者配置中不支持如下的函数 “imagecreatetruecolor”、“imagecopyresampled”等图像函数，所以创建不了头像','Controller/User'));
		}

		$this->assign('__JumpUrl__',Dyhb::U('user/avatar'));

		$this->S(Dyhb::L('头像上传成功','Controller/User'));
	}

	public function password(){
		$this->is_login();

		$arrUserData=$GLOBALS['___login___'];
		$this->assign('nUserId',$arrUserData['user_id']);
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_changepassword_status']);

		$this->display('user+password');
	}

	public function change_pass(){
		if($GLOBALS['_option_']['seccode_changepassword_status']==1){
			$this->check_seccode(true);
		}

		$sPassword=G::getGpc('user_password','P');
		$sNewPassword=G::getGpc('new_password','P');
		$sOldPassword=G::getGpc('old_password','P');

		$oUserModel=Dyhb::instance('UserModel');
		$oUserModel->changePassword($sPassword,$sNewPassword,$sOldPassword);
		if($oUserModel->isError()){
			$this->E($oUserModel->getErrorMessage());
		}else{
			$this->S(Dyhb::L('密码修改成功，你需要重新登录','Controller/User'));
		}
	}

	public function tag(){
		$oUser=UserModel::F()->getByuser_id($GLOBALS['___login___']['user_id']);

		$arrHometags=array();
		$oTag=Dyhb::instance('HometagModel');
		$arrHometags=$oTag->getTagsByUserid($oUser['user_id']);

		$this->assign('oUser',$oUser);
		$this->assign('arrHometags',$arrHometags);

		$this->display('user+tag');
	}

	public function add_hometag(){
		$nUserId=$GLOBALS['___login___']['user_id'];
		$sHometagName=G::getGpc('hometag_name');

		$oTag=Dyhb::instance('HometagModel');
		$oTag->addTag($nUserId,$sHometagName);

		if($oTag->isError()){
			$this->E($oTag->getErrorMessage());
		}

		$this->S(Dyhb::L('添加用户标签成功','Controller/User'));
	}

	public function delete_hometag(){
		$nUserId=$GLOBALS['___login___']['user_id'];
		$nHometagId=intval(G::getGpc('id'));

		$oHometag=HometagindexModel::F('hometag_id=? AND user_id=?',$nHometagId,$nUserId)->getOne();
		if(!empty($oHometag['user_id'])){
			$oHometag->destroy();
		}

		$this->S(Dyhb::L('删除用户标签成功','Controller/User'));
	}

	public function promotion(){
		$this->assign('nUserId',Core_Extend::aidencode(intval($GLOBALS['___login___']['user_id'])));
		$this->assign('sUserName',rawurlencode(trim($GLOBALS['___login___']['user_name'])));
		$this->assign('sSiteName',$GLOBALS['_option_']['site_name']);
		$this->assign('sSiteUrl',$GLOBALS['_option_']['site_url']);

		$this->display('user+promotion');
	}

}
