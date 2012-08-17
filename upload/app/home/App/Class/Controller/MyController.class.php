<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   个人空间显示($)*/

!defined('DYHB_PATH') && exit;

class MyController extends InitController{

	public function init__(){
		parent::init__();
	}
	
	public function user(){
		require_once(Core_Extend::includeFile('function/Profile_Extend'));
		
		$nId=intval(G::getGpc('id','G'));
		if(empty($nId)){
			$nId=$GLOBALS['___login___']['user_id'];
		}
		
		$oUserInfo=UserModel::F()->getByuser_id($nId);
		if(empty($oUserInfo['user_id'])){
			$this->E(Dyhb::L('你指定的用户不存在','Controller/My'));
		}else{
			$this->assign('oUserInfo',$oUserInfo);
		}
		
		$sDo=G::getGpc('do','G');
		if(!in_array($sDo,array('','base','contact','edu','work','info'))){
			$sDo='';
		}
		
		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		Core_Extend::loadCache('userprofilesetting');
		$this->assign('arrUserprofilesettingDatas',$GLOBALS['_cache_']['userprofilesetting']);
		
		$arrUserprofile=$oUserInfo->userprofile->toArray();
		$this->assign('sDirthDistrict',Profile_Extend::getDistrict($arrUserprofile,'birth',false));
		$this->assign('sResideDistrict',Profile_Extend::getDistrict($arrUserprofile,'reside',false));
		
		$arrFriends=FriendModel::F('user_id=? AND friend_status=1',$nId)->order('create_dateline DESC')->limit(0,$arrOptionData['my_friend_limit_num'])->getAll();
		
		$this->assign('sDo',$sDo);
		$this->assign('nId',$nId);
		$this->assign('arrFriends',$arrFriends);

		// 视图
		$arrProfileSetting=Profile_Extend::getProfileSetting();

		$this->assign('arrBases',$arrProfileSetting[0]);
		$this->assign('arrContacts',$arrProfileSetting[1]);
		$this->assign('arrEdus',$arrProfileSetting[2]);
		$this->assign('arrWorks',$arrProfileSetting[3]);
		$this->assign('arrInfos',$arrProfileSetting[4]);

		$arrInfoMenus=Profile_Extend::getInfoMenu();

		$this->assign('arrInfoMenus',$arrInfoMenus);

		$this->display('my+user');
	}

	public function rating(){
		Core_Extend::loadCache('rating');
		Core_Extend::loadCache('ratinggroup');

		$nId=intval(G::getGpc('id','G'));

		$arrRatinggroups=$GLOBALS['_cache_']['ratinggroup'];

		$arrRatinggroupIds=array();
		foreach($arrRatinggroups as $oRatinggroup){
			$arrRatinggroupIds[]=$oRatinggroup['ratinggroup_id'];
		}

		if(!empty($nId) && in_array($nId,$arrRatinggroupIds)){
			$arrRatings=array();
			foreach($GLOBALS['_cache_']['rating'] as $arrRating){
				if($arrRating['ratinggroup_id']==$nId){
					$arrRatings[]=$arrRating;
				}
			}
		}else{
			$arrRatings=$GLOBALS['_cache_']['rating'];
		}

		$this->assign('nId',$nId);
		$this->assign('arrRatings',$arrRatings);
		$this->assign('arrRatinggroups',$arrRatinggroups);

		$this->display('my+rating');
	}

	public function avatar(){
		$nId=intval(G::getGpc('id','G'));
		if(empty($nId)){
			$nId=$GLOBALS['___login___']['user_id'];
		}
		
		$oUserInfo=UserModel::F()->getByuser_id($nId);
		if(empty($oUserInfo['user_id'])){
			$this->E(Dyhb::L('你指定的用户不存在','Controller/My'));
		}else{
			$this->assign('oUserInfo',$oUserInfo);
		}

		$arrAvatarInfo=array();
		$arrAvatarInfo=Core_Extend::avatars($GLOBALS['___login___']['user_id']);

		$this->assign('arrAvatarInfo',$arrAvatarInfo);
		$this->assign('nId',$nId);

		$this->display('my+avatar');
	}

}
