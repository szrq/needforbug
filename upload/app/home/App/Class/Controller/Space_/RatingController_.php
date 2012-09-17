<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   个人空间等级显示($)*/

!defined('DYHB_PATH') && exit;

class RatingController extends Controller{

	public function index(){
		Core_Extend::loadCache('rating');
		Core_Extend::loadCache('ratinggroup');

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

		$nCId=intval(G::getGpc('cid','G'));

		$arrRatinggroups=$GLOBALS['_cache_']['ratinggroup'];

		$arrRatinggroupIds=array();
		foreach($arrRatinggroups as $oRatinggroup){
			$arrRatinggroupIds[]=$oRatinggroup['ratinggroup_id'];
		}

		if(!empty($nCId) && in_array($nCId,$arrRatinggroupIds)){
			$arrRatings=array();
			foreach($GLOBALS['_cache_']['rating'] as $arrRating){
				if($arrRating['ratinggroup_id']==$nCId){
					$arrRatings[]=$arrRating;
				}
			}
		}else{
			$arrRatings=$GLOBALS['_cache_']['rating'];
		}

		$this->assign('nId',$nId);
		$this->assign('nCId',$nCId);
		$this->assign('arrRatings',$arrRatings);
		$this->assign('arrRatinggroups',$arrRatinggroups);

		$this->display('space+rating');
	}

	public function index_title_(){
		return '积分';
	}

}
