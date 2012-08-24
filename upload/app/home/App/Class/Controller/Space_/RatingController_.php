<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   个人空间等级显示($)*/

!defined('DYHB_PATH') && exit;

class RatingController extends Controller{

	public function index(){
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

		$this->display('space+rating');
	}

}
