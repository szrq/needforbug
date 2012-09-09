<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   缓存文件($)*/

!defined('DYHB_PATH') && exit;

class Cache_Extend{

	public static function updateCache($sCacheName=''){
		$arrUpdateList=empty($sCacheName)?array():(is_array($sCacheName)?$sCacheName:array($sCacheName));

		if(!$arrUpdateList){
			$arrUpdateMethod=array();

			$arrAllMethod=get_class_methods('Cache_Extend');
			foreach($arrAllMethod as $sMethod){
				if(preg_match('|^updateCache(.+)|',$sMethod)){
					$arrUpdateMethod[]=$sMethod;
				}
			}

			foreach($arrUpdateMethod as $sUpdateMethod){
				$Callback=array('Cache_Extend',$sUpdateMethod);
				call_user_func($Callback);
			}
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
		if(is_array($arrOptionData)){
			foreach($arrOptionData as $nKey=>$arrValue){
				$arrData[$arrValue['option_name']]=$arrValue['option_value'];
			}
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
		if(is_array($arrNavs)){
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

		return (!$oNav['nav_type']?Dyhb::U($oNav['nav_url']):Core_Extend::getEvalValue($oNav['nav_url']));
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
		if(is_array($arrLinks)){
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
		if(is_array($arrUserprofilesettings)){
			foreach($arrUserprofilesettings as $arrUserprofilesetting){
				$arrUserprofilesettingDatas[$arrUserprofilesetting['userprofilesetting_id']]=$arrUserprofilesetting;
			}
		}

		Core_Extend::saveSyscache('userprofilesetting',$arrUserprofilesettingDatas);
	}

	public static function updateCacheBadword(){
		$arrBadwordDatas=BadwordModel::F()->order('badword_id ASC')->all()->query();

		$arrSaveData=array();
		if(is_array($arrBadwordDatas)){
			foreach($arrBadwordDatas as $nKey=>$oBadwordData){
				$arrSaveData[$oBadwordData['badword_id']]['regex']=$oBadwordData['badword_findpattern'];
				$arrSaveData[$oBadwordData['badword_id']]['value']=$oBadwordData['badword_replacement'];
			}
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
		if(is_array($arrRatinggroupDatas)){
			foreach($arrRatinggroupDatas as $arrRatinggroup){
				$arrData[$arrRatinggroup['ratinggroup_id']]=$arrRatinggroup;
			}
		}
		
		Core_Extend::saveSyscache('ratinggroup',$arrData);
	}

	public static function updateCacheRating(){
		$arrData=array();

		$arrRatingDatas=RatingModel::F()->order('rating_id ASC')->asArray()->all()->query();
		if(is_array($arrRatingDatas)){
			foreach($arrRatingDatas as $arrRating){
				$arrData[$arrRating['rating_id']]=$arrRating;
			}
		}
		
		Core_Extend::saveSyscache('rating',$arrData);
	}

	public static function updateCacheCreditrule(){
		$arrData=array();

		$arrCreditruls=CreditruleModel::F()->asArray()->getAll();
		if(is_array($arrCreditruls)){
			foreach($arrCreditruls as $arrRule){
				$arrRule['creditrule_rulenameuni']=urlencode($arrRule['creditrule_name']);
				$arrData[$arrRule['creditrule_action']]=$arrRule;
			}
		}

		Core_Extend::saveSyscache('creditrule',$arrData);
	}

	public static function updateCacheStyle(){
		$arrData=array();

		$arrStylevars=$arrStyledata=array();
		$nDefaultStyleid=$GLOBALS['_option_']['front_style_id'];
		$arrStylevarOjbects=StylevarModel::F()->getAll();
		if(is_array($arrStylevarOjbects)){
			foreach(StylevarModel::F()->getAll() as $oStylevar){
				$arrStylevars[$oStylevar['style_id']][$oStylevar['stylevar_variable']]=$oStylevar['stylevar_substitute'];
			}
		}

		$arrCacheStyledir=$arrTheStyles=array();
		$arrCacheStyledir=G::listDir(NEEDFORBUG_PATH.'/data/~runtime/style_');

		$arrStyleObjects=StyleModel::F('style_status=?',1)->asArray()->getAll();
		if(is_array($arrStyleObjects)){
			foreach($arrStyleObjects as $arrStyle){
				$arrTheStyles[]=$arrStyle['style_id'];
				
				$oTheme=ThemeModel::F('theme_id=?',$arrStyle['theme_id'])->getOne();
				$arrStyle['doyouhaobaby_template_base']=$oTheme['theme_dirname'];
				$arrStyle=array_merge($arrStyle,$arrStylevars[$arrStyle['style_id']]);
				
				$arrDataNew=array();
				$arrStyle['img_dir']=$arrStyle['img_dir']?$arrStyle['img_dir']:'theme/Default/Public/Images';
				$arrStyle['style_img_dir']=$arrStyle['style_img_dir']?$arrStyle['style_img_dir']:$arrStyle['img_dir'];
				$arrStyle['img_dir']=__ROOT__.'/ucontent/'.$arrStyle['img_dir'];
				$arrStyle['style_img_dir']=__ROOT__.'/ucontent/'.$arrStyle['style_img_dir'];

				foreach($arrStyle as $sKey=>$sStyle){
					if($sKey!='menu_hover_bg_color' && substr($sKey,-8,8)=='bg_color'){
						$sNewKey=substr($sKey,0,-8).'bg_code';
						$arrDataNew[$sNewKey]=self::setCssBackground($arrStyle,substr($sKey,0,-6));
					}
				}

				$arrStyle=array_merge($arrStyle,$arrDataNew);

				$arrStyleIcons[$arrStyle['style_id']]=$arrStyle['menu_hover_bg_color'];
				
				if(strstr($arrStyle['logo'],',')){
					$arrFlash=explode(",",$arrStyle['logo']);
					$arrFlash[0]=trim($arrFlash[0]);
					$arrFlash[0]=preg_match('/^http:\/\//i',$arrFlash[0])?$arrFlash[0]:$arrStyle['style_img_dir'].'/'.$arrFlash[0];
					$arrStyle['logo_str']="<embed src=\"".$arrFlash[0]."\" width=\"".trim($arrFlash[1])."\" height=\"".trim($arrFlash[2])."\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed>";
				}else{
					$arrStyle['logo']=preg_match('/^http:\/\//i',$arrStyle['logo'])?$arrStyle['logo']:$arrStyle['style_img_dir'].'/'.$arrStyle['logo'];
					$arrStyle['logo_str']="<img src=\"".$arrStyle['logo']."\" alt=\"".$GLOBALS['_option_']['site_name']."\" border=\"0\" />";
				}

				$sStyleExtendDir=NEEDFORBUG_PATH.'/ucontent/theme/'.$arrStyle['doyouhaobaby_template_base'].'/Public/Style';
				!is_dir($sStyleExtendDir) && $sStyleExtendDir=NEEDFORBUG_PATH.'/ucontent/theme/Default/Public/Style';
				if(is_dir($sStyleExtendDir)){
					$arrStyleDirs=G::listDir($sStyleExtendDir);

					$arrExtendstyleData[]=array('',Dyhb::L('默认','__COMMON_LANG__@Function/Cache_Extend'),$arrStyle['menu_hover_bg_color']);
					
					foreach($arrStyleDirs as $sStyleDir){
						$sExtendStylefile=$sStyleExtendDir.'/'.$sStyleDir.'/style.css';

						if(file_exists($sExtendStylefile)){
							$sContent=file_get_contents($sExtendStylefile);

							if(preg_match('/\[name\](.+?)\[\/name\]/i',$sContent,$arrResult1) &&
								preg_match('/\[iconbgcolor](.+?)\[\/iconbgcolor]/i',$sContent,$arrResult2))
							{
								$arrExtendstyleData[$sStyleDir]=array($sStyleDir,$arrResult1[1],$arrResult2[1]);
							}
						}
					}
				}

				$arrStyleExtendValue=explode('|',$arrStyle['style_extend']);
				$arrStyle['_current_style_']=$arrStyleExtendValue[1];

				$arrStyle['_style_extend_icons_']=array();
				$arrStyleExtendValue=explode("\t",$arrStyleExtendValue[0]);
				$arrStyleExtendValue[]=0;
				foreach($arrStyleExtendValue as $sStyleExtendValue){
					if(array_key_exists($sStyleExtendValue,$arrExtendstyleData)){
						$arrStyle['_style_extend_icons_'][$sStyleExtendValue]=$arrExtendstyleData[$sStyleExtendValue];
					}
				}

				$nContentWidthInt=intval($arrStyle['content_width']);
				$nContentWidthInt=$nContentWidthInt?$nContentWidthInt:600;
				$nImageMaxWidth=$GLOBALS['_option_']['image_max_width'];
				if(substr(trim($nContentWidthInt),-1,1)!='%'){
					if(substr(trim($nImageMaxWidth),-1,1)!='%'){
						$arrStyle['image_max_width']=$nImageMaxWidth>$nContentWidthInt?$nContentWidthInt:$nImageMaxWidth;
					}else{
						$arrStyle['image_max_width']=intval($nContentWidthInt*$nImageMaxWidth/100);
					}
				}else{
					if(substr(trim($nImageMaxWidth),-1,1)!='%'){
						$arrStyle['image_max_width']='%'.$nImageMaxWidth;
					}else{
						$arrStyle['image_max_width']=($nImageMaxWidth>$nContentWidthInt?$nContentWidthInt:$nImageMaxWidth).'%';
					}
				}

				$arrStyle['verhash']=G::randString(6,null,true);
				$arrStyles[intval($arrStyle['style_id'])]=$arrStyle;
			}
		}

		if(is_array($arrCacheStyledir)){
			foreach($arrCacheStyledir as $nKey=>$sValue){
				if(!in_array($sValue,$arrTheStyles)){
					$sCurDeletedstyleDir=NEEDFORBUG_PATH.'/data/~runtime/style_/'.$sValue;
					$arrCurDeletedstyleFiles=G::listDir($sCurDeletedstyleDir,true,true);
					foreach($arrCurDeletedstyleFiles as $sCurDeletedstyleFile){
						@unlink($sCurDeletedstyleFile);
					}
					@rmdir($sCurDeletedstyleDir);
				}
			}
		}

		if(is_array($arrStyles)){
			foreach($arrStyles as $arrStyle){
				$arrStyle['_style_icons_']=$arrStyleIcons;

				$sStyleIdPath=NEEDFORBUG_PATH.'/data/~runtime/style_/'.intval($arrStyle['style_id']);
				if(!is_dir($sStyleIdPath)&& !G::makeDir($sStyleIdPath)){
					Dyhb::E(Dyhb::L('无法写入缓存文件,请检查缓存目录 %s 的权限是否为0777','__COMMON_LANG__@Function/Cache_Extend',null,$sStyleIdPath));
				}
				
				self::writeToCache($sStyleIdPath.'/style.php',$arrStyle);
				self::writetoCssCache($arrStyle,$sStyleIdPath);
			}
		}
	}

	public static function writeToCache($sStylePath,$arrStyle){
		if(!file_put_contents($sStylePath,
			"<?php\n /* NeedForBug Style File,Do not to modify this file! */ \n return ".
				var_export($arrStyle,true).
			"\n?>")
		){
			Dyhb::E(Dyhb::L('无法写入缓存文件,请检查缓存目录 %s 的权限是否为0777','__COMMON_LANG__@Function/Cache_Extend',null,$sStylePath));
		}
	}

	public static function writetoCssCache($arrData=array(),$sStyleIdPath){
		$arrTypes=array();
		$arrTypes[]='@';

		$arrApps=AppModel::F('app_status=?',1)->getAll();
		if(is_array($arrApps)){
			foreach($arrApps as $oApp){
				$arrTypes[]=$oApp['app_identifier'];
			}
		}

		$arrCssfiles=array(
			'style'=>array('style','style_append'),
			'common'=>array('common','common_append'),
		);

		$arrStyleExtendValue=explode('|',$arrData['style_extend']);
		$arrStyleExtendValue=explode("\t",$arrStyleExtendValue[0]);
		foreach($arrStyleExtendValue as $nStyleExtendValue=>$sStyleExtendValue){
			$arrCssfiles['t_'.$sStyleExtendValue]=array($sStyleExtendValue);
		}

		foreach($arrTypes as $sType){
			foreach($arrCssfiles as $sExtra=>$arrCssData){
				$sCssData='';

				foreach($arrCssData as $sCss){
					if($sType=='@'){
						$sCssfile=NEEDFORBUG_PATH.'/ucontent/theme/'.ucfirst($arrData['doyouhaobaby_template_base']).'/Public/Css/'.$sCss.'.css';
						!file_exists($sCssfile) && $sCssfile=NEEDFORBUG_PATH.'/ucontent/theme/Default/Public/Css/'.$sCss.'.css';
					}elseif(strpos($sExtra,'t_')===0){
						$sCssfile=NEEDFORBUG_PATH.'/ucontent/theme/'.ucfirst($arrData['doyouhaobaby_template_base']).'/Public/Style/'.$sCss.'/style.css';
						!file_exists($sCssfile) && NEEDFORBUG_PATH.'/ucontent/theme/Default/Public/Style/'.$sCss.'/style.css';
					}else{
						$sCssfile=NEEDFORBUG_PATH.'/app/'.$sType.'/Theme/'.ucfirst($arrData['doyouhaobaby_template_base']).'/Public/Css/'.$sCss.'.css';
						!file_exists($sCssfile) && NEEDFORBUG_PATH.'/app/'.$sType.'/Theme/Default/Public/Css/'.$sCss.'.css';
					}

					if(file_exists($sCssfile)){
						$sCssData.=file_get_contents($sCssfile);
					}
				}

				if(empty($sCssData)){
					continue;
				}

				$sCssData=@preg_replace("/\{([A-Z0-9_]+)\}/e",'\$arrData[strtolower(\'\1\')]',stripslashes($sCssData));
				$sCssData=preg_replace("/<\?.+?\?>\s*/",'',$sCssData);
				$sCssData=preg_replace(array('/\s*([,;:\{\}])\s*/','/[\t\n\r]/','/\/\*.+?\*\//'),array('\\1','',''),$sCssData);

				if(!file_put_contents($sStyleIdPath.'/'.($sType!='@' && strpos($sExtra,'t_')!==0?$sType.'_':'').$sExtra.'.css',stripslashes($sCssData)) && !G::makeDir($sStyleIdPath)){
					Dyhb::E(Dyhb::L('无法写入缓存文件,请检查缓存目录 %s 的权限是否为0777','__COMMON_LANG__@Function/Cache_Extend',null,$sStyleIdPath));
				}else{
					$arrCurscriptCss=Glob($sStyleIdPath.'/scriptstyle_*.css');
					foreach($arrCurscriptCss as $sCurscriptCss){
						@unlink($sCurscriptCss);
					}
				}
			}
		}
	}

	public static function setCssBackground(&$arrStyle,$sKey){
		$sCss=$sCodeValue='';

		if(!empty($arrStyle[$sKey.'_color'])){
			$sCss.=strtolower($arrStyle[$sKey.'_color']);
			$sCodeValue=strtoupper($arrStyle[$sKey.'_color']);
		}

		if(!empty($arrStyle[$sKey.'_img'])){
			if(preg_match('/^http:\/\//i',$arrStyle[$sKey.'_img'])){
				$sCss.=' url("'.$arrStyle[$sKey.'_img'].'") ';
			}else{
				$sCss.=' url("'.$arrStyle['style_img_dir'].'/'.$arrStyle[$sKey.'_img'].'") ';
			}
		}

		if(!empty($arrStyle[$sKey.'_extra'])){
			$sCss.=' '.$arrStyle[$sKey.'_extra'];
		}

		$arrStyle[$sKey.'_color']=$sCodeValue;

		$sCss=trim($sCss);

		return $sCss?'background: '.$sCss:'';
	}

	public static function updateCacheSlide(){
		$arrData=array();

		$arrSlides=SlideModel::F('slide_status=?',1)->order('slide_sort ASC,create_dateline DESC')->getAll();
		if(is_array($arrSlides)){
			foreach($arrSlides as $oSlide){
				$arrData[]=array(
					'slide_title'=>$oSlide['slide_title'],
					'slide_img'=>Core_Extend::getEvalValue($oSlide['slide_img']),
					'slide_url'=>Core_Extend::getEvalValue($oSlide['slide_url']),
				);
			}
		}

		Core_Extend::saveSyscache('slide',$arrData);
	}

	public static function updateCacheAdminctrlmenu(){
		$arrData=array();

		$arrAdminctrlmenus=AdminctrlmenuModel::F('adminctrlmenu_status=?',1)->order('adminctrlmenu_sort ASC,create_dateline ASC')->getAll();
		if(is_array($arrAdminctrlmenus)){
			foreach($arrAdminctrlmenus as $oAdminctrlmenu){
				$arrData[]=array(
					'adminctrlmenu_id'=>$oAdminctrlmenu['adminctrlmenu_id'],
					'adminctrlmenu_title'=>$oAdminctrlmenu['adminctrlmenu_title'],
					'adminctrlmenu_url'=>$oAdminctrlmenu['adminctrlmenu_url'],
				);
			}
		}

		Core_Extend::saveSyscache('adminctrlmenu',$arrData);
	}
	
	public static function updateCacheLang(){
		$arrData=array();
		
		$arrLangs=G::listDir(NEEDFORBUG_PATH.'/ucontent/language');
		if(is_array($arrLangs)){
			foreach($arrLangs as $sLang){
				$arrData[]=strtolower($sLang);
			}
		}
		
		Core_Extend::saveSyscache('lang', $arrData);
	}

	public static function updateCacheSociatype(){
		$arrData=array();

		$arrSociatypes=SociatypeModel::F('sociatype_status=?',1)->order('create_dateline ASC')->getAll();
		if(is_array($arrSociatypes)){
			foreach($arrSociatypes as $oSociatype){
				$arrData[$oSociatype['sociatype_identifier']]=array(
					'sociatype_id'=>$oSociatype['sociatype_id'],
					'sociatype_identifier'=>$oSociatype['sociatype_identifier'],
					'sociatype_title'=>$oSociatype['sociatype_title'],
					'sociatype_appid'=>$oSociatype['sociatype_appid'],
					'sociatype_appkey'=>$oSociatype['sociatype_appkey'],
					'sociatype_callback'=>$oSociatype['sociatype_callback'],
					'sociatype_scope'=>$oSociatype['sociatype_scope'],
					'sociatype_logo'=>__ROOT__.'/source/extension/socialization/static/images/'.$oSociatype['sociatype_logo'],
				);
			}
		}

		Core_Extend::saveSyscache('sociatype',$arrData);
	}
	
}
