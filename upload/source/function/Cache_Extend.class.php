<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   缓存文件($)*/

!defined('DYHB_PATH') && exit;

class Cache_Extend{

	public static function updateCache($sCacheName=''){
		$arrUpdateList=empty($sCacheName)?array():(is_array($sCacheName)?$sCacheName:array($sCacheName));

		if(!$arrUpdateList){
			call_user_func('updateCache');
		}else{
			foreach($arrUpdateList as $sCache){
				$Callback=array('Cache_Extend','updateCache'.ucfirst($sCache));

				if(is_callable($Callback)){
					call_user_func($Callback);
				}else{
					$arrCaches=explode('_',$sCache);
					$Callback=array(ucfirst($arrCaches[0]).'Cache_Extend','updateCache'.ucfirst($arrCaches[1]));

					if(is_callable($Callback)){
						call_user_func($Callback);
					}else{
						Dyhb::E('$Callback is not a callback');
					}
				}
			}
		}
	}

	public static function updateCacheOption(){
		$arrData=array();

		$arrOptionData=OptionModel::F()->asArray()->all()->query();
		foreach($arrOptionData as $nKey=>$arrValue){
			$arrData[$arrValue['option_name']]=$arrValue['option_value'];
		}

		Core_Extend::saveSyscache('option',$arrData);
	}

	public static function updateCacheNav(){
		$arrNavs=array();

		// 主导航菜单
		$arrNavs['main']=array();
		$arrNavs['main']=self::getNav_(0);

		// 头部菜单
		$arrNavs['header']=array();
		$arrNavs['header']=self::getNav_(1);

		// 底部菜单
		$arrNavs['footer']=array();
		$arrNavs['footer']=self::getNav_(2);

		Core_Extend::saveSyscache('nav',$arrNavs);
	}

	static private function getNav_($nLocation=0){
		$arrReturnNav=array();

		if($nLocation==2){
			$arrWhere=array('nav_status'=>1,'nav_location'=>2);
			$arrWhere2=array('nav_status'=>1,'nav_location'=>2);
		}elseif($nLocation==1){
			$arrWhere=array('nav_status'=>1,'nav_location'=>1);
			$arrWhere2=array('nav_status'=>1,'nav_location'=>1);
		}else{
			$arrWhere=array('nav_parentid'=>0,'nav_status'=>1,'nav_location'=>0);
			$arrWhere2=array('nav_status'=>1,'nav_location'=>0);
		}
		
		$arrNavs=NavModel::F($arrWhere)->order('nav_sort DESC')->getAll();
		foreach($arrNavs as $key=>$oNav){
			$arrReturnNav[$key]=array(
				'title'=>$oNav['nav_name'],
				'description'=>self::getDescription_($oNav),
				'link'=>self::getNavUrl_($oNav),
				'style'=>self::getColorAndStyle_($oNav),
				'target'=>self::getTarget_($oNav),
			);

			// 查询子菜单
			$arrReturnNav[$key]['sub']=array();

			$arrWhere2['nav_parentid']=$oNav['nav_id'];
			$arrNavSubs=NavModel::F($arrWhere2)->order('nav_sort DESC')->getAll();
			foreach($arrNavSubs as $oNavSub){
				$arrReturnNav[$key]['sub'][]=array(
					'title'=>$oNavSub['nav_name'],
					'description'=>self::getDescription_($oNavSub),
					'link'=>self::getNavUrl_($oNavSub),
					'style'=>self::getColorAndStyle_($oNavSub),
					'target'=>self::getTarget_($oNavSub),
				);
			}
		}

		return $arrReturnNav;
	}

	static private function getNavUrl_($oNav){
		if($oNav['nav_identifier']=='sethomepage'){
			return "javascript:void(0)";
		}

		if($oNav['nav_identifier']=='setfavorite'){
			return $GLOBALS['_option_']['site_url'];
		}

		return (!$oNav['nav_type']?Dyhb::U($oNav['nav_url']):$oNav['nav_url']);
	}

	static private function getColorAndStyle_($oNav){
		$sStyle='';

		$arrStyle=array();
		if(!empty($oNav->nav_style)){
			$arrStyle=unserialize($oNav->nav_style);
		}else{
			$arrStyle=array(0=>0,1=>0,2=>0);
		}

		$sStyle.=self::getColor_($oNav['nav_color']);
		$sStyle.=self::getStyle_($arrStyle);

		if(!empty($sStyle)){
			$sStyle="style=\"{$sStyle}\";";
		}

		if($oNav['nav_identifier']=='sethomepage'){
			$sStyle.=" onclick=\"setHomepage('{$GLOBALS['_option_']['site_url']}');\"";
		}

		if($oNav['nav_identifier']=='setfavorite'){
			$sStyle.=" onclick=\"addFavorite(this.href,'{$GLOBALS['_option_']['site_name']}');return false;\"";
		}

		return $sStyle;
	}

	static private function getColor_($nStyle){
		switch($nStyle){
			case 1:
				return 'color:red;';
				break;
			case 2:
				return 'color:orange;';
				break;
			case 3:
				return 'color:yellow;';
				break;
			case 4:
				return 'color:green;';
				break;
			case 5:
				return 'color:cyan;';
				break;
			case 6:
				return 'color:blue;';
				break;
			case 7:
				return 'color:purple;';
				break;
			case 8:
				return 'color:gray;';
				break;
			default:
				return '';
				break;
		}
	}

	static private function getStyle_($arrStyle){
		$sBackStyle='';

		if(!empty($arrStyle[0])){
			$sBackStyle.="text-decoration: underline;";
		}

		if(!empty($arrStyle[1])){
			$sBackStyle.="font-style: italic;";
		}

		if(!empty($arrStyle[2])){
			$sBackStyle.="font-weight: bold;";
		}

		return $sBackStyle;
	}

	static private function getTarget_($oNav){
		return ($oNav->nav_target==1?'target="_blank"':'');
	}

	static private function getDescription_($oNav){
		return ($oNav['nav_title']?$oNav['nav_title']:$oNav['nav_name']);
	}

	public static function updateCacheLink(){
		$sTightlinkContent=$sTightlinkText=$sTightlinkLogo='';

		$arrLinks=LinkModel::F('link_status=?',1)->order('link_sort DESC')->getAll();
		foreach($arrLinks as $oLink){
			if($oLink['link_description']){
				if($oLink['link_logo']){
					$sTightlinkContent.='<li><div class="home-logo"><img src="'.$oLink['link_logo'].'" border="0" alt="'.$oLink['link_name'].'" /></div>
						<div class="home-content"><h5><a href="'.$oLink['link_url'].'" target="_blank">'.
						$oLink['link_name'].'</a></h5><p>'.$oLink['link_description'].'</p></div></li>';
				}else{
					$sTightlinkContent.='<li><div class="home-content"><h5><a href="'.$oLink['link_url'].'" target="_blank">'.
						$oLink['link_name'].'</a></h5><p>'.$oLink['link_description'].'</p></div></li>';
				}
			}else{
				if($oLink['link_logo']){
					$sTightlinkLogo.='<a href="'.$oLink['link_url'].'" target="_blank"><img src="'.$oLink['link_logo'].
						'" border="0" alt="'.$oLink['link_name'].'" /></a>';
				}else{
					$sTightlinkText.='<li><a href="'.$oLink['link_url'].'" target="_blank" title="'.
						$oLink['link_name'].'">'.$oLink['link_name'].'</a></li>';
				}
			}
		}

		$arrData['link_content']=$sTightlinkContent;
		$arrData['link_text']=$sTightlinkText;
		$arrData['link_logo']=$sTightlinkLogo;

		Core_Extend::saveSyscache('link',$arrData);
	}

	public static function link_($oLink){
		$arrLink=$oLink->toArray();

		unset($arrLink['link_id'],$arrLink['create_dateline'],$arrLink['update_dateline'],
			$arrLink['link_status'],$arrLink['link_sort']);

		return $arrLink;
	}

	public static function updateCacheUserprofilesetting(){
		$arrUserprofilesettingDatas=array();

		$arrUserprofilesettings=UserprofilesettingModel::F('userprofilesetting_status=?',1)->asArray()->getAll();
		foreach($arrUserprofilesettings as $arrUserprofilesetting){
			$arrUserprofilesettingDatas[$arrUserprofilesetting['userprofilesetting_id']]=$arrUserprofilesetting;
		}

		Core_Extend::saveSyscache('userprofilesetting',$arrUserprofilesettingDatas);
	}

	public static function updateCacheBadword(){
		$arrBadwordDatas=BadwordModel::F()->order('badword_id ASC')->all()->query();

		$arrSaveData=array();
		foreach($arrBadwordDatas as $nKey=>$oBadwordData){
			$arrSaveData[$oBadwordData['badword_id']]['regex']=$oBadwordData['badword_findpattern'];
			$arrSaveData[$oBadwordData['badword_id']]['value']=$oBadwordData['badword_replacement'];
		}

		Core_Extend::saveSyscache('badword',$arrSaveData);
	}

	public static function updateCacheSite(){
		$arrData=array();

		$arrData['app']=AppModel::F()->all()->getCounts();
		$arrData['user']=UserModel::F()->all()->getCounts();
		$arrData['adminuser']=UserModel::F()->where(array('user_id'=>array('IN',Dyhb::C('ADMIN_USERID'))))->all()->getCounts();

		$nCurrentTimeStamp=CURRENT_TIMESTAMP;
		$arrData['newuser']=UserModel::F("{$nCurrentTimeStamp}-create_dateline<86400")->all()->getCounts();

		Core_Extend::saveSyscache('site',$arrData);
	}

	public static function updateCacheRatinggroup(){
		$arrData=array();
		
		$arrRatinggroupDatas=RatinggroupModel::F('ratinggroup_status=?',1)->order('ratinggroup_id ASC')->asArray()->all()->query();
		foreach($arrRatinggroupDatas as $arrRatinggroup){
			$arrData[$arrRatinggroup['ratinggroup_id']]=$arrRatinggroup;
		}
		
		Core_Extend::saveSyscache('ratinggroup',$arrData);
	}

	public static function updateCacheRating(){
		$arrData=array();

		$arrRatingDatas=RatingModel::F()->order('rating_id ASC')->asArray()->all()->query();
		foreach($arrRatingDatas as $arrRating){
			$arrData[$arrRating['rating_id']]=$arrRating;
		}
		
		Core_Extend::saveSyscache('rating',$arrData);
	}

	public static function updateCacheCreditrule(){
		$arrData=array();

		$arrCreditruls=CreditruleModel::F()->asArray()->getAll();
		foreach($arrCreditruls as $arrRule){
			$arrRule['creditrule_rulenameuni']=urlencode($arrRule['creditrule_name']);
			$arrData[$arrRule['creditrule_action']]=$arrRule;
		}

		Core_Extend::saveSyscache('creditrule',$arrData);
	}

}
