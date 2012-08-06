<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   系统核心函数文件($)*/

!defined('DYHB_PATH') && exit;

class Core_Extend{

	static public function loginInformation(){
		$arrUserData=UserModel::M()->authData();
		if(UserModel::M()->isBehaviorError()){
			G::E(UserModel::M()->getBehaviorErrorMessage());
		}

		if(empty($arrUserData['user_id'])){
			$GLOBALS['___login___']=false;
		}else{
			$GLOBALS['___login___']=$arrUserData;
		}

		return $arrUserData;
	}

	static public function seccode(){
		$arrOption=array(
			'seccode_image_width_size'=>$GLOBALS['_option_']['seccode_image_width_size'],
			'seccode_image_height_size'=>$GLOBALS['_option_']['seccode_image_height_size'],
			'seccode_adulterate'=>$GLOBALS['_option_']['seccode_adulterate'],
			'seccode_ttf'=>$GLOBALS['_option_']['seccode_ttf'],
			'seccode_tilt'=>$GLOBALS['_option_']['seccode_tilt'],
			'seccode_background'=>$GLOBALS['_option_']['seccode_background'],
			'seccode_image_background'=>$GLOBALS['_option_']['seccode_image_background'],
			'seccode_color'=>$GLOBALS['_option_']['seccode_color'],
			'seccode_size'=>$GLOBALS['_option_']['seccode_size'],
			'seccode_shadow'=>$GLOBALS['_option_']['seccode_shadow'],
			'seccode_animator'=>$GLOBALS['_option_']['seccode_animator'],
			'seccode_norise'=>$GLOBALS['_option_']['seccode_norise'],
			'seccode_curve'=>$GLOBALS['_option_']['seccode_curve'],
		);

		if($GLOBALS['_option_']['seccode_type']==3){
			$arrOption['seccode_bitmap']=1;
		}elseif($GLOBALS['_option_']['seccode_type']==2){
			$arrOption['seccode_chinesecode']=1;
		}
		
		G::seccode($arrOption,($GLOBALS['_option_']['seccode_type']==2?1:0),($GLOBALS['_option_']['seccode_ttf']?1:2));
	}

	static public function checkSeccode($sSeccode){
		return G::checkSeccode($sSeccode);
	}
	
	static public function avatar($nUid='',$sType='middle'){
		$sPath=G::getAvatar($nUid,$sType);

		return file_exists(NEEDFORBUG_PATH.'/data/avatar/'.$sPath)?
			__ROOT__.'/data/avatar/'.$sPath:
			__PUBLIC__.'/images/avatar/noavatar_'.($sType=='origin'?'big':$sType).'.gif';
	}

	static public function avatars($nUserId=null){
		if($nUserId===null){
			$nUserId=$GLOBALS['___login___']['user_id'];
		}

		$arrAvatarInfo=array();

		$arrAvatarInfo['exist']=file_exists(NEEDFORBUG_PATH.'/data/avatar/'.G::getAvatar($nUserId,'big'))?true:false;
		$arrAvatarInfo['origin']=Core_Extend::avatar($nUserId,'origin');
		$arrAvatarInfo['big']=Core_Extend::avatar($nUserId,'big');
		$arrAvatarInfo['middle']=Core_Extend::avatar($nUserId,'middle');
		$arrAvatarInfo['small']=Core_Extend::avatar($nUserId,'small');

		return $arrAvatarInfo;
	}

	static public function loadCache($CacheNames,$bForce=false){
		static $arrLoadedCache=array();

		$CacheNames=is_array($CacheNames)?$CacheNames:array($CacheNames);
		$arrCaches=array();
		foreach($CacheNames as $sCacheName){
			if(!isset($arrLoadedCache[$sCacheName]) || $bForce){
				$arrCaches[]=$sCacheName;
				$arrLoadedCache[$sCacheName]=true;
			}
		}

		if(!empty($arrCaches)){
			$arrCacheDatas=self::cacheData($arrCaches);
			foreach($arrCacheDatas as $sCacheName=>$data){
				if($sCacheName=='option'){
					$GLOBALS['_option_']=$data;
				}else{
					$GLOBALS['_cache_'][$sCacheName]=$data;
				}
			}
		}

		return true;
	}

	static public function cacheData($CacheNames){
		static $bIsFilecache=null,$bAllowMem=null;

		if(!isset($bIsFilecache)){
			$bIsFilecache=$GLOBALS['_commonConfig_']['RUNTIME_CACHE_BACKEND']=='FileCache';
			$bAllowMem=self::memory('check');
		}

		$arrData=array();
		$CacheNames=is_array($CacheNames)?$CacheNames:array($CacheNames);
		if($bAllowMem){
			$arrNew=array();
			foreach($CacheNames as $sCacheName){
				$arrData[$sCacheName]=self::memory('get',$sCacheName);
				if($arrData[$sCacheName]===null){
					$arrData[$sCacheName]=null;
					$arrNew[]=$sCacheName;
				}
			}

			if(empty($arrNew)){
				return $arrData;
			}else{
				$CacheNames=$arrNew;
			}
		}

		if($bIsFilecache){
			$arrLostCaches=array();
			foreach($CacheNames as $sCacheName){
				$arrData[$sCacheName]=Dyhb::cache($sCacheName,'',array('cache_path'=>NEEDFORBUG_PATH.'/data/~runtime/cache_'));
				if($arrData[$sCacheName]===false){
					$arrLostCaches[]=$sCacheName;
					if(!Dyhb::classExists('Cache_Extend')){
						require_once(Core_Extend::includeFile('function/Cache_Extend'));
					}
					Cache_Extend::updateCache($sCacheName);
				}
			}

			if(!$arrLostCaches){
				return $arrData;
			}
			$CacheNames=$arrLostCaches;
			unset($arrLostCaches);
		}

		$arrSyscaches=SyscacheModel::F(array('syscache_name'=>array('in',$CacheNames)))->getAll();
		foreach($arrSyscaches as $arrSyscache){
			$arrData[$arrSyscache['syscache_name']]=$arrSyscache['syscache_type']?unserialize($arrSyscache['syscache_data']):$arrSyscache['syscache_data'];
			$bAllowMem && (self::memory('set',$arrSyscache['syscache_name'],$arrData[$arrSyscache['syscache_name']]));
			if($bIsFilecache){
				Dyhb::cache($arrSyscache['syscache_name'],$arrData[$arrSyscache['syscache_name']],array('cache_path'=>NEEDFORBUG_PATH.'/data/~runtime/cache_'));
			}
		}

		foreach($CacheNames as $sCacheName){
			if($arrData[$sCacheName]===null){
				$arrData[$sCacheName]=null;
				$bAllowMem && (self::memory('set',$sCacheName,array()));
			}
		}

		return $arrData;
	}

	public static function saveSyscache($sCacheName,$Data){
		static $bIsFilecache=null,$bAllowMem=null;

		if(!isset($bIsFilecache)){
			$bIsFilecache=$GLOBALS['_commonConfig_']['RUNTIME_CACHE_BACKEND']=='FileCache';
			$bAllowMem=self::memory('check');
		}

		if(is_array($Data)){
			$nType=1;
			$Data=serialize($Data);
		}else{
			$nType=0;
		}
		
		$Data=G::addslashes($Data);

		$oSyscacheModel=new SyscacheModel();
		$oSyscacheModel->syscache_name=$sCacheName;
		$oSyscacheModel->syscache_type=$nType;
		$oSyscacheModel->syscache_data=$Data;
		$oSyscacheModel->save(0,'replace');

		$bAllowMem && self::memory('delete',$sCacheName);
		$bIsFilecache && @unlink(NEEDFORBUG_PATH.'/data/~runtime/cache_/~@'.$sCacheName.'.php');
	}

	public static function memory($sAction,$sKey='',$Value=''){
		$bMemEnable=$GLOBALS['_commonConfig_']['RUNTIME_CACHE_BACKEND']!='FileCache';

		if($sAction=='check'){
			return $bMemEnable?$GLOBALS['_commonConfig_']['RUNTIME_CACHE_BACKEND']:'';
		}elseif($bMemEnable && in_array($sAction,array('set','get','delete'))){
			switch($sAction){
				case 'set': return Dyhb::cache($sKey,$Value); break;
				case 'get': return Dyhb::cache($sKey); break;
				case 'delete': return Dyhb::cache($sKey,null); break;
			}
		}

		return null;
	}
	
	static public function appLogo($sApp,$bHtml=false){
		$sLogo='';
		
		if(file_exists(NEEDFORBUG_PATH.'/app/'.$sApp.'/logo.png')){
			$sLogo=__ROOT__.'/app/'.$sApp.'/logo.png';
		}else{
			$sLogo=__ROOT__.'/app/logo.png';
		}
		
		if($bHtml===true){
			return "<img src=\"{$sLogo}\"";
		}else{
			return $sLogo;
		}
	}

	static public function includeFile($sFileName,$sApp=null){
		if(!empty($sApp)){
			$sIncludeFile='/app/'.$sApp.'/App/Class/Extension/'.$sFileName;
			$sType='_.php';
		}else{
			$sIncludeFile='/source/'.$sFileName;
			$sType='.class.php';
		}
		
		return preg_match('/^[\w\d\/_]+$/i',$sIncludeFile)?realpath(NEEDFORBUG_PATH.$sIncludeFile.$sType):false;
	}
	
	static function replaceSiteVar($sString,$arrReplaces=array()){
		$arrSiteVars=array(
			'{site_name}'=>$GLOBALS['_option_']['site_name'],
			'{site_description}'=>$GLOBALS['_option_']['site_description'],
			'{site_url}'=>$GLOBALS['_option_']['site_url'],
			'{time}'=>gmdate('Y-n-j H:i',CURRENT_TIMESTAMP),
			'{user_name}'=>$GLOBALS['___login___']?$GLOBALS['___login___']['user_name']:Dyhb::L('游客','__COMMON_LANG__@Function/Core_Extend'),
			'{user_nikename}'=>$GLOBALS['___login___']?
				($GLOBALS['___login___']['user_nikename']?$GLOBALS['___login___']['user_nikename']:$GLOBALS['___login___']['user_name']):
				Dyhb::L('游客','__COMMON_LANG__@Function/Core_Extend'),
			'{admin_email}'=>$GLOBALS['_option_']['admin_email']
		);
		
		$arrReplaces=array_merge($arrSiteVars,$arrReplaces);
		
		return str_replace(array_keys($arrReplaces),array_values($arrReplaces),$sString);
	}

	static public function badword($sContent){
		if(empty($sContent)){
			return '';
		}

		if(!$GLOBALS['_option_']['badword_on']){
			return $sContent;
		}

		if(!isset($GLOBALS['_cache_']['badword'])){
			if(!Dyhb::classExists('Cache_Extend')){
				require(NEEDFORBUG_PATH.'/source/function/Cache_Extend.class.php');
			}
			self::loadCache('badword');
		}

		foreach($GLOBALS['_cache_']['badword'] as $arrBadword){
			$sContent=preg_replace($arrBadword['regex'],$arrBadword['value'],$sContent);
		}

		return $sContent;
	}

	static public function isPostInt($value){
		return !preg_match("/[^\d-.,]/",trim($value,'\''));
	}
	
	static public function htmlSubstring($sStr,$nLength=0,$nStart=0,$sTags="div|span|p",$sSuffixStr="...",$nZhfw=0.9,$sCharset="utf-8"){
		$arrRe['utf-8']="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$arrRe['gb2312']="/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$arrRe['gbk']="/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$arrRe['big5']="/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";

		$arrZhre['utf-8']="/[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$arrZhre['gb2312']="/[\xb0-\xf7][\xa0-\xfe]/";
		$arrZhre['gbk']="/[\x81-\xfe][\x40-\xfe]/";
		$arrZhre['big5']="/[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";

		$arrTagpos=array();
		preg_match_all("/<(".$sTags.")([\s\S]*?)>|<\/(".$sTags.")>/ism",$sStr,$arrMatch);
		$nMpos=0;
		for($nJ=0;$nJ<count($arrMatch[0]);$nJ++){
			$nMpos=strpos($sStr,$arrMatch[0][$nJ],$nMpos);
			$arrTagpos[$nMpos]=$arrMatch[0][$nJ];
			$nMpos+=strlen($arrMatch[0][$nJ]);
		}
		ksort($arrTagpos);
	
		$arrString=array();
		$nBpos=0;
		$nEpos=0;
		foreach($arrTagpos as $nKey=>$sValue){
			$sTemp=substr($sStr,$nBpos,$nKey-$nEpos);
			if(!empty($sTemp)){
				array_push($arrString,$sTemp);
			}
			array_push($arrString,$sValue);
			$nBpos=($nKey+strlen($sValue));
			$nEpos=$nKey+strlen($sValue);
		}
		$sTemp=substr($sStr,$nBpos);
		if(!empty($sTemp)){
			array_push($arrString,$sTemp);
		}
	
		$nBpos=$nStart;
		$nEpos=$nLength;
		for($nI=0;$nI<count($arrString);$nI++){
			if(preg_match("/^<([\s\S]*?)>$/i",$arrString[$nI])){
				continue;
			}
	
			preg_match_all($arrRe[$sCharset],$arrString[$nI],$arrMatch);
	
			for($nJ=$nBpos;$nJ<min($nEpos,count($arrMatch[0]));$nJ++){
				if(preg_match($arrZhre[$sCharset],$arrMatch[0][$nJ])){
					$nEpos-=$nZhfw;
				}
			}
	
			$arrString[$nI]="";
			for($nJ=$nBpos;$nJ<min($nEpos,count($arrMatch[0]));$nJ++){
				$arrString[$nI].=$arrMatch[0][$nJ];
			}
			$nBpos-=count($arrMatch[0]);
			$nBpos=max(0,$nBpos);
			$nEpos-=count($arrMatch[0]);
			$nEpos=round($nEpos);
		}

		$sSlice=join("",$arrString);
		if($sSlice!=$sStr){
			return $sSlice.$sSuffixStr;
		}else{
			return $sSlice;
		}
	}
	
	static public function sortBy($sField){
		$sSort=strtolower(trim(G::getGpc('sort_','G')));
		
		if(empty($sSort) || $sSort=='asc'){
			$sSort='desc';
		}else{
			$sSort='asc';
		}

		return '?order_='.$sField.'&sort_='.$sSort;
	}
	
	static public function sortField($sName){
		if(G::getGpc('order_','G')==$sName && G::getGpc('sort_','G')=='asc'){
			echo "class=\"order_desc\"";
		}

		if(G::getGpc('order_','G')==$sName && G::getGpc('sort_','G')=='desc'){
			echo "class=\"order_asc\"";
		}
	}
	
	static public function isAlreadyFriend($nUserId){
		return FriendModel::isAlreadyFriend($nUserId,$GLOBALS['___login___']['user_id']);
	}

	static public function getBeginEndDay(){
		$nYear=date("Y");
		$nMonth=date("m");
		$nDay=date("d");

		$nDayBegin=mktime(0,0,0,$nMonth,$nDay,$nYear);//当天开始时间戳
		$nDayEnd=mktime(23,59,59,$nMonth,$nDay,$nYear);//当天结束时间戳

		return array($nDayBegin,$nDayEnd);
	}

	static public function segmentUsername($sUserName){
		if(empty($sUserName)){
			return '';
		}

		$sUserName=str_replace(',',';',$sUserName);
		$arrUsers=explode(';',$sUserName);

		return $arrUsers;
	}

	static public function getUploadSize($nSize=null){
		$nReturnSize=-1;
		$nPhpIni=ini_get('upload_max_filesize')*1048576;
		
		if(is_null($nSize)){
			$nSize=$GLOBALS['_option_']['uploadfile_maxsize'];
		}

		if($nSize==-1){
			$nReturnSize=$nPhpIni;
		}else{
			if($nSize>=$nPhpIni){
				$nReturnSize=$nPhpIni;
			}else{
				$nReturnSize=$nSize;
			}
		}

		return $nReturnSize;
	}	
	
	static public function aidencode($nId){
		static $sSidAuth='';

		$sSidAuth=$sSidAuth!=''?$sSidAuth:G::authcode(Dyhb::cookie($GLOBALS['_commonConfig_']['RBAC_DATA_PREFIX'].'hash'),false);
		
		return rawurlencode(base64_encode($nId.'|'.substr(md5($nId.md5($GLOBALS['_commonConfig_']['DYHB_AUTH_KEY']).
			CURRENT_TIMESTAMP),0,8).'|'.CURRENT_TIMESTAMP.'|'.$sSidAuth));
	}


	static public function updateCreditByAction($sAction,$nUserId=0,$arrExtraSql=array(),$nCoef=1,$nUpdate=1){
		if($nUserId<1){
			return false;
		}
		
		if(!Dyhb::classExists('Credit')){
			require_once(Core_Extend::includeFile('class/Credit'));
		}

		$oCredit=Dyhb::instance('Credit');

		if($arrExtraSql){
			$oCredit->_arrExtraSql=$arrExtraSql;
		}

		return $oCredit->execRule($sAction,$nUserId,$nCoef,$nUpdate);
	}

	static public function timeFormat($nDate){
		if($GLOBALS['_option_']['date_convert']==1){
			return G::smartDate($nDate,$GLOBALS['_option_']['time_format']);
		}else{
			return date($GLOBALS['_option_']['time_format'],$nDate);
		}
	}

	static public function editorInclude(){
		$sPublic=__PUBLIC__;
		$sKindeditorLang=file_exists(NEEDFORBUG_PATH.'/Public/js/editor/kindeditor/lang/'.LANG_NAME.'.js')?LANG_NAME:'Zh-cn';

		return <<<NEEDFORBUG
		<script src="{$sPublic}/js/editor/kindeditor/kindeditor-min.js" type="text/javascript"></script>
<script charset="utf-8" src="{$sPublic}/js/editor/kindeditor/lang/{$sKindeditorLang}.js"></script>
NEEDFORBUG;
	}

	static public function deleteAppconfig($sApp=null){
		if(is_null($sApp)){
			$arrSaveDatas=array();

			$arrWhere=array();
			$arrWhere['app_active']=1;
			$arrApps=AppModel::F()->where($arrWhere)->all()->query();
			foreach($arrApps as $oApp){
				$arrSaveDatas[]=$oApp['app_identifier'];
			}
			$arrSaveDatas[]='admin';

			foreach($arrSaveDatas as $sTheApp){
				self::deleteAppconfig($sTheApp);
			}
		}else{
			$sAppConfigcachefile=NEEDFORBUG_PATH.'/data/~runtime/'.$sApp.'/Config.php';
			@unlink($sAppConfigcachefile);
		}

		return true;
	}

	static public function template($sTemplate,$sApp=null,$sTheme=null){
		if(empty($sTheme)){
			$sTemplate=TEMPLATE_NAME.'/'.$sTemplate;
		}else{
			$sTemplate=$sTheme.'/'.$sTemplate;
		}

		if(!empty($sApp)){
			$sTemplatePath=NEEDFORBUG_PATH.'/app/'.$sApp.'/Theme';
		}else{
			$sTemplatePath=NEEDFORBUG_PATH.'/ucontent/theme';
		}

		$sUrl=$sTemplatePath.'/'.$sTemplate.'.html';

		if(is_file($sUrl)){
			return $sUrl;
		}

		if(defined('DOYOUHAOBABY_TEMPLATE_BASE') && empty($sTheme) && ucfirst(DOYOUHAOBABY_TEMPLATE_BASE)!==TEMPLATE_NAME){// 依赖模板 兼容性分析
			$sUrlTry=str_replace('heme/'.TEMPLATE_NAME.'/','heme/'.ucfirst(DOYOUHAOBABY_TEMPLATE_BASE).'/',$sUrl);
			if(is_file($sUrlTry)){
				return $sUrlTry;
			}
		}

		if(empty($sTheme) && 'Default'!==TEMPLATE_NAME){// Default模板 兼容性分析
			$sUrlTry=str_replace('heme/'.TEMPLATE_NAME.'/','heme/Default/',$sUrl);
			if(is_file($sUrlTry)){
				return $sUrlTry;
			}
		}

		Dyhb::E(sprintf('Template File %s is not exist',$sUrl));
	}

}
