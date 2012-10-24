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

			// 读取用户统计信息
			$GLOBALS['___login___']['usercount']=UsercountModel::F('user_id=?',$arrUserData['user_id'])->asArray()->getOne();

			$GLOBALS['___login___']['socia_login']=false;

			// 如果用户使用社会化帐号直接登录
			if(Dyhb::cookie('SOCIA_LOGIN')==1 && Dyhb::cookie('SOCIA_LOGIN_TYPE')){
				if(!Dyhb::classExists('SociauserModel')){
					require_once(NEEDFORBUG_PATH.'/source/extension/socialization/lib/mvc/SociauserModel.class.php');
				}

				$arrSociauser=SociauserModel::F('user_id=? AND sociauser_vendor=?',$arrUserData['user_id'],Dyhb::cookie('SOCIA_LOGIN_TYPE'))->asArray()->getOne();
				if($arrSociauser){
					$arrSociauser['logo']=__ROOT__.'/source/extension/socialization/static/images/'.$arrSociauser['sociauser_vendor'].'/'.$arrSociauser['sociauser_vendor'].'.gif';
					
					$GLOBALS['___login___']['socia']=$arrSociauser;
					$GLOBALS['___login___']['socia_login']=true;
				}
			}
		}

		return $arrUserData;
	}

	static public function isAdmin(){
		$arrAdmins=explode(',',$GLOBALS['_commonConfig_']['ADMIN_USERID']);

		if($GLOBALS['___login___']===false){
			return false;
		}

		if(in_array($GLOBALS['___login___']['user_id'],$arrAdmins)){
			return true;
		}else{
			return false;
		}
	}

	static public function page404($oThis){
		$arrAllMethod=get_class_methods($oThis);
		if(!in_array(ACTION_NAME,$arrAllMethod)){
			$oThis->page404();
		}
	}

	static public function title($oController){
		$page=intval(G::getGpc('page','G'));
		$page=$page>1?" | 第 {$page} 页":'';
		
		$sTitleAction=ACTION_NAME.'_title_';
		if(method_exists($oController,$sTitleAction)){
			return $oController->{$sTitleAction}().' | '.$GLOBALS['_option_']['site_name'].$page;
		}else{
			return $GLOBALS['_option_']['site_name'].$page;
		}
	}

	static public function keywords($oController){
		$page=intval(G::getGpc('page','G'));
		$page=$page>1?",第 {$page} 页":'';

		$sKeywordsAction=ACTION_NAME.'_keywords_';
		if(method_exists($oController,$sKeywordsAction)){
			return $oController->{$sKeywordsAction}().','.$GLOBALS['_option_']['site_name'].$page;
		}else{
			return '';
		}
	}

	static public function description($oController){
		$page=intval(G::getGpc('page','G'));
		$page=$page>1?" | 第 {$page} 页":'';

		$sDescriptionAction=ACTION_NAME.'_description_';
		if(method_exists($oController,$sDescriptionAction)){
			$sDescription=trim(strip_tags($oController->{$sDescriptionAction}()));
			$sDescription=preg_replace('/\s(?=\s)/','',$sDescription);// 接着去掉两个空格以上的
			$sDescription=preg_replace('/[\n\r\t]/','',$sDescription);// 最后将非空格替换为一个空格
			return G::subString($sDescription,0,300).$page;
		}else{
			return $GLOBALS['_option_']['site_name'].$page;
		}
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
	
	static public function avatar($nUid,$sType='middle'){
		if($GLOBALS['___login___']['socia_login']===true && $GLOBALS['___login___']['user_id']==$nUid){
			if($sType=='big' || $sType=='origin'){
				return $GLOBALS['___login___']['socia']['sociauser_img2'];
			}elseif($sType=='small'){
				return $GLOBALS['___login___']['socia']['sociauser_img'];
			}else{
				return $GLOBALS['___login___']['socia']['sociauser_img1'];
			}
		}
		
		$sPath=G::getAvatar($nUid,$sType);

		return is_file(NEEDFORBUG_PATH.'/data/avatar/'.$sPath)?
			__ROOT__.'/data/avatar/'.$sPath:
			__PUBLIC__.'/images/avatar/noavatar_'.($sType=='origin'?'big':$sType).'.gif';
	}

	static public function avatars($nUserId=null){
		if($nUserId===null){
			$nUserId=$GLOBALS['___login___']['user_id'];
		}

		$arrAvatarInfo=array();

		$arrAvatarInfo['exist']=is_file(NEEDFORBUG_PATH.'/data/avatar/'.G::getAvatar($nUserId,'big'))?true:false;
		$arrAvatarInfo['origin']=Core_Extend::avatar($nUserId,'origin');
		$arrAvatarInfo['big']=Core_Extend::avatar($nUserId,'big');
		$arrAvatarInfo['middle']=Core_Extend::avatar($nUserId,'middle');
		$arrAvatarInfo['small']=Core_Extend::avatar($nUserId,'small');

		return $arrAvatarInfo;
	}

	static public function doControllerAction($sPath,$sAction){
		require_once(Core_Extend::includeController($sPath,$sClassController));

		$oClass=new $sClassController();
		$oClass->{$sAction}();
	}
	
	static public function includeController($sPath,&$sClassController){
		$sFilepath=APP_PATH.'/App/Class/Controller/';

		$arrValue=explode('@',$sPath);
		if(!isset($arrValue[1])){
			Dyhb::E('IncludeController parameter is error');
		}
		$sFilepath.=$arrValue[0].'_/';

		$arrValue=explode('/',$arrValue[1]);
		$sClassController=array_pop($arrValue).'Controller';
		$sClass=$sClassController.'_.php';
		$sFilepath.=($arrValue?implode('/',$arrValue).'/':'').$sClass;

		if(!is_file($sFilepath)){
			Dyhb::E(sprintf('Include Controller %s failed',$sFilepath));
		}

		return $sFilepath;
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

		$oSyscacheModel=new SyscacheModel();
		$oSyscacheModel->syscache_name=$sCacheName;
		$oSyscacheModel->syscache_type=$nType;
		$oSyscacheModel->syscache_data=$Data;
		$oSyscacheModel->save(0,'replace');

		$bAllowMem && self::memory('delete',$sCacheName);

		$sCachefile=NEEDFORBUG_PATH.'/data/~runtime/cache_/~@'.$sCacheName.'.php';
		$bIsFilecache && (is_file($sCachefile) && @unlink($sCachefile));
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
		
		if(is_file(NEEDFORBUG_PATH.'/app/'.$sApp.'/logo.png')){
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

	static public function includeFile($sFileName,$sApp=null,$sType='_.php'){
		if(!empty($sApp)){
			$sIncludeFile='/app/'.$sApp.'/App/Class/'.($sType=='_.php'?'Extendsion/':'').$sFileName;
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

	static public function getEvalValue($sValue){
		$arrMatches=array();

		if(preg_match("/{\s*(\S+?)\s*\}/ise",$sValue,$arrMatches)){
			@eval('$sValue='.$arrMatches[1].';');
			return $sValue;
		}else{
			return $sValue;
		}
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
		$nUploadmaxfilesize=intval(ini_get('upload_max_filesize'));
		$nPostmaxsize=intval(ini_get('post_max_size'));
		
		$nPhpIni=($nUploadmaxfilesize<=$nPostmaxsize?$nUploadmaxfilesize:$nPostmaxsize)*1048576;

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
		$arrLangmap=array(
			'Zh-cn'=>'zh_CN',
			'Zh-tw'=>'zh_TW',
			'En-us'=>'en',
			'Ar'=>'ar',
		);

		$sLangname=LANG_NAME?LANG_NAME:'Zh-cn';

		$sPublic=__PUBLIC__;
		$sKindeditorLang=is_file(NEEDFORBUG_PATH.'/Public/js/editor/kindeditor/lang/'.$arrLangmap[$sLangname].'.js')?$arrLangmap[$sLangname]:'zh_CN';

		return <<<NEEDFORBUG
		<script type="text/javascript">var sEditorLang='{$sKindeditorLang}';</script>
		<script src="{$sPublic}/js/editor/kindeditor/kindeditor-min.js" type="text/javascript"></script>
NEEDFORBUG;
	}

	static public function deleteAppconfig($sApp=null,$bCleanCookie=true){
		if(is_null($sApp)){
			$arrSaveDatas=array();

			$arrWhere=array();
			$arrWhere['app_status']=1;
			$arrApps=AppModel::F()->where($arrWhere)->all()->query();
			if(is_array($arrApps)){
				foreach($arrApps as $oApp){
					$arrSaveDatas[]=$oApp['app_identifier'];
				}
			}
			$arrSaveDatas[]='admin';

			foreach($arrSaveDatas as $sTheApp){
				self::deleteAppconfig($sTheApp);
			}
		}else{
			$sApp=strtolower($sApp);

			$sAppConfigcachefile=NEEDFORBUG_PATH.'/data/~runtime/'.$sApp.'/Config.php';
			if(is_file($sAppConfigcachefile)){
				@unlink($sAppConfigcachefile);
			}

			if($bCleanCookie===true){
				Dyhb::cookie('template',null,-1);
				Dyhb::cookie('language',null,-1);
			}
		}

		return true;
	}

	static public function changeAppconfig($Data,$sValue=''){
		if(is_array($Data)){
			foreach($Data as $sKey=>$sValue){
				self::changeAppconfig($sKey,$sValue);
			}
		}else{
			$sAppGlobalconfigFile=NEEDFORBUG_PATH.'/Config/Config.inc.php';
			$arrAppconfig=(array)(include $sAppGlobalconfigFile);

			$arrData=array();
			$arrData[$Data]=$sValue;

			$arrAppconfig=array_merge($arrAppconfig,$arrData);

			if(!file_put_contents($sAppGlobalconfigFile,
				"<?php\n /* DoYouHaoBaby Framework Config File,Do not to modify this file! */ \n return ".
				var_export($arrAppconfig,true).
				"\n?>")
			){
				Dyhb::E(Dyhb::L('全局配置文件 %s 不可写','__COMMON_LANG__@Function/Core_Extend',null,$sAppGlobalconfigFile));
			}

			self::deleteAppconfig();
		}
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

	static public function getStylePreview($Style,$sType='',$bAdmin=false,$sTemplate=''){
		if(empty($sTemplate)){
			if(!is_object($Style)){
				$Style=StyleModel::F('style_id=?',$Style)->getOne();
			}
			
			if(empty($Style['style_id'])){
				return self::getNoneimg();
			}
	
			$oTheme=ThemeModel::F('theme_id=?',$Style['theme_id'])->getOne();
			if(empty($oTheme['theme_id'])){
				return self::getNoneimg();
			}
			
			$sTemplate=ucfirst($oTheme['theme_dirname']);
		}else{
			$sTemplate=ucfirst(strtolower($sTemplate));
		}

		if($bAdmin===false){
			$sPreviewPath='ucontent/theme';
		}else{
			$sPreviewPath='admin/Theme';
		}

		if($sType=='large'){
			$sPreview='needforbug_preview_large';
		}elseif($sType=='mini'){
			$sPreview='needforbug_preview_mini';
		}else{
			$sPreview='needforbug_preview';
		}

		foreach(array('png','gif','jpg','jpeg') as $sExt){
			if(is_file(NEEDFORBUG_PATH.'/'.$sPreviewPath.'/'.$sTemplate."/{$sPreview}.{$sExt}")){
				return __ROOT__.'/'.$sPreviewPath.'/'.$sTemplate."/{$sPreview}.{$sExt}";
				continue;
			}
		}

		return self::getNoneimg();
	}

	static public function getNoneimg(){
		return __PUBLIC__.'/images/common/none.gif';
	}

	static public function initFront(){
		// 配置&菜单&登陆信息
		Core_Extend::loadCache('option');
		Core_Extend::loadCache('nav');
		Core_Extend::loginInformation();
		
		// CSS资源定义
		if(isset($GLOBALS['_commonConfig_']['_CURSCRIPT_'])){
			Core_Extend::defineCurscript($GLOBALS['_commonConfig_']['_CURSCRIPT_']);
		}
		
		// 读取当前的主题样式
		$sStyleCachepath=self::getCurstyleCachepath();
		$arrMustFile=array('style.css','common.css','style.php');

		foreach($arrMustFile as $sMustFile){
			if(!is_file($sStyleCachepath.'/'.$sMustFile)){
				if(!Dyhb::classExists('Cache_Extend')){
					require_once(Core_Extend::includeFile('function/Cache_Extend'));
				}
				Cache_Extend::updateCache('style');
			}
		}

		$GLOBALS['_style_']=(array)(include $sStyleCachepath.'/style.php');
		define('DOYOUHAOBABY_TEMPLATE_BASE',$GLOBALS['_style_']['doyouhaobaby_template_base']);

		if(defined('CURSCRIPT')){
			$sCurscript=$sStyleCachepath.'/scriptstyle_'.APP_NAME.'_'.str_replace('::','_',CURSCRIPT).'.css';
		}else{
			$sCurscript='';
		}

		if(defined('CURSCRIPT') && !is_file($sCurscript)){
			$sContent=$GLOBALS['_curscript_']='';
			$sContent=file_get_contents($sStyleCachepath.'/style.css');
			if(is_file($sStyleCachepath.'/'.APP_NAME.'_'.'style.css')){
				$sContent.=file_get_contents($sStyleCachepath.'/'.APP_NAME.'_'.'style.css');
			}
			$sContent=preg_replace("/([\n\r\t]*)\[CURSCRIPT\s*=\s*(.+?)\]([\n\r]*)(.*?)([\n\r]*)\[\/CURSCRIPT\]([\n\r\t]*)/ies","Core_Extend::cssVarTags('\\2','\\4')",$sContent);

			$sCssCurScripts=$GLOBALS['_curscript_'];
			$sCssCurScripts=preg_replace(array('/\s*([,;:\{\}])\s*/','/[\t\n\r]/','/\/\*.+?\*\//'),array('\\1','',''),$sCssCurScripts);
			$sCssCurScripts=trim(stripslashes($sCssCurScripts));
			if($sCssCurScripts==''){
				$sCssCurScripts=' ';
			}

			if(!is_dir(dirname($sCurscript))){
				$nStyleid=intval(Dyhb::cookie('style_id'));
				if($GLOBALS['___login___']!==false && $GLOBALS['___login___']['user_extendstyle']==$nStyleid){
					$oUser=UserModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();
					$oUser->user_extendstyle=0;
					$oUser->save(0,'update');

					if($oUser->isError()){
						Dyhb::E($oUser->getErrorMessage());
					}
				}
				
				Dyhb::cookie('style_id',null,-1);
			}

			if(!file_put_contents($sCurscript,$sCssCurScripts)){
				Dyhb::E(Dyhb::L('无法写入缓存文件,请检查缓存目录 %s 的权限是否为0777','__COMMON_LANG__@Function/Cache_Extend',null,$sStyleCachepath));
			}
		}

		// 清除直接使用$_GET['t']带来的影响
		if(isset($_GET['t'])){
			Dyhb::cookie('template',NULL,-1);
		}
		
		// 读取语言缓存
		Core_Extend::loadCache('lang');
	}

	static public function loadCss(){
		$sStyleCachepath=self::getCurstyleCachepath();
		$sStyleCacheurl=self::getCurstyleCacheurl();
		
		$sScriptCss='';
		$sScriptCss='<link rel="stylesheet" type="text/css" href="'.$sStyleCacheurl.'/common.css?'.$GLOBALS['_style_']['verhash']."\" />";
		
		if(is_file($sStyleCachepath.'/'.APP_NAME.'_common.css')){
			$sScriptCss.='<link rel="stylesheet" type="text/css" href="'.$sStyleCacheurl.'/'.APP_NAME.'_common.css?'.$GLOBALS['_style_']['verhash']."\" />";
		}

		$sCurrentT=Dyhb::cookie('extend_style_id');
		if($sCurrentT==''){
			if($GLOBALS['___login___']!==false){
				$sCurrentT=$GLOBALS['___login___']['user_extendstyle'];
			}else{
				$sCurrentT=$GLOBALS['_style_']['_current_style_'];
			}
		}

		if(!empty($sCurrentT) && is_file($sStyleCachepath.'/t_'.$sCurrentT.'.css')){
			$sScriptCss.='<link rel="stylesheet" id="extend_style" type="text/css" href="'.$sStyleCacheurl.'/t_'.$sCurrentT.'.css?'.$GLOBALS['_style_']['verhash']."\" />";
			$GLOBALS['_extend_style_']=$sCurrentT;

			// 取得扩展背景图片
			if(is_dir(NEEDFORBUG_PATH.'/ucontent/theme/Default/Public/Style/'.$sCurrentT.'/bgextend')){
				$arrBgimgPath=array();
				$arrFiles=G::listDir(NEEDFORBUG_PATH.'/ucontent/theme/Default/Public/Style/'.$sCurrentT.'/bgextend',false,true);
				foreach($arrFiles as &$sFile){
					$arrBgimgPath[]='"'.__ROOT__.'/ucontent/theme/Default/Public/Style/'.$sCurrentT.'/bgextend/'.$sFile.'"';
				}
				$arrBgimgPath[]='"'.__ROOT__.'/ucontent/theme/Default/Public/Style/'.$sCurrentT.'/bgimg.jpg'.'"';

				$sScriptCss.="<script type=\"text/javascript\">";
				$sScriptCss.=
				"var globalImgbgs=[".implode(',',$arrBgimgPath)."];";
				$sScriptCss.="</script>";
			}
		}else{
			$GLOBALS['_extend_style_']='0';
			$sScriptCss.='<link rel="stylesheet" id="extend_style" type="text/css" href="'.__PUBLIC__.'/images/common/none.css?'.$GLOBALS['_style_']['verhash']."\" />";

			// 取得背景图片
			if(is_dir(NEEDFORBUG_PATH.'/ucontent/theme/Default/Public/Images/bgextend')){
				$arrBgimgPath='';
				$arrFiles=G::listDir(NEEDFORBUG_PATH.'/ucontent/theme/Default/Public/Images/bgextend',false,true);
				foreach($arrFiles as &$sFile){
					$arrBgimgPath[]='"'.__ROOT__.'/ucontent/theme/Default/Public/Images/bgextend/'.$sFile.'"';
				}

				$sScriptCss.="<script type=\"text/javascript\">";
				$sScriptCss.=
				"var globalImgbgs=[".implode(',',$arrBgimgPath)."];";
				$sScriptCss.="</script>";
			}
		}
		
		if(!defined('CURSCRIPT')){
			return $sScriptCss;
		}
		
		$sScriptCss.='<link rel="stylesheet" type="text/css" href="'.$sStyleCacheurl.'/scriptstyle_'.APP_NAME.'_'.str_replace('::','_',CURSCRIPT).'.css?'.$GLOBALS['_style_']['verhash']."\" />";
		
		return $sScriptCss;
	}
	
	static public function cssVarTags($sCurScript,$sContent){
		$arrCurScript=Dyhb::normalize(explode(',',trim($sCurScript)));
		
		// 应用::模块::方法
		$bGetcontent=in_array(APP_NAME.'::'.CURSCRIPT,$arrCurScript);

		// 应用::模块
		if($bGetcontent===false){
			if(strpos(CURSCRIPT,'::')){
				$arrTemp=explode('::',CURSCRIPT);
				$bGetcontent=in_array(APP_NAME.'::'.$arrTemp[0],$arrCurScript);
			}
		}

		// 公用
		if($bGetcontent===false && defined('CURSCRIPT_COMMON')){
			$arrCommonscript=explode(',',CURSCRIPT_COMMON);
			if(is_array($arrCommonscript)){
				foreach($arrCommonscript as $sValue){
					if(in_array('@'.$sValue,$arrCurScript)){
						$bGetcontent=true;
						break;
					}
				}
			}
		}

		$GLOBALS['_curscript_'].=$bGetcontent?$sContent:'';
	}

	static public function getStyleId($nId=0){
		if($nId==0){
			if(Dyhb::cookie('style_id')){
				$nId=Dyhb::cookie('style_id');
			}else{
				$nId=intval($GLOBALS['_option_']['front_style_id']);
			}
		}

		return $nId;
	}

	static public function getCurstyleCachepath($nId=0){
		$nId=self::getStyleId($nId);
		return NEEDFORBUG_PATH.'/data/~runtime/style_/'.$nId;
	}

	static public function getCurstyleCacheurl($nId=0){
		$nId=self::getStyleId($nId);
		return __ROOT__."/data/~runtime/style_/".$nId;
	}

	static public function defineCurscript($arrModulecachelist){
		$arrResult=array();

		foreach($arrModulecachelist as $nKey=>$sCache){
			if(!is_int($nKey)){
				$temp=$sCache;
				$sCache=$nKey;
				$nKey=$temp.'*'.G::randString(6);
			}
			
			// 定义
			if(strpos($sCache,',')){
				foreach(explode(',',$sCache) as $nCacheKey=>$sValue){
					$arrResult[$nKey.G::randString(6)]=$sValue;
				}
			}else{
				$arrResult[$nKey]=$sCache;
			}
		}
		
		$arrResult=array_unique($arrResult);
	
		// 优先 @ucenter::index
		foreach(array(MODULE_NAME.'::'.ACTION_NAME,MODULE_NAME) as $sValue){
			$nKey=array_search($sValue,$arrResult);
			if($nKey!==false){
				if(strpos($nKey,'*')){
					$arrTemp=explode('*',$nKey);
					define('CURSCRIPT_COMMON',$arrTemp[0]);
				}

				define('CURSCRIPT',$sValue);
				break;
			}
		};
	}

	static public function thumb($sFilepath,$nWidth,$nHeight){
		if(!is_file($sFilepath)){
			$sFilepath=NEEDFORBUG_PATH.'/Public/images/common/none.gif';
		}
		
		Image::thumbGd($sFilepath,$nWidth,$nHeight);
	}

	static public function ubb($sContent){
		if(!Dyhb::classExists('Ubb2html')){
			require_once(Core_Extend::includeFile('class/Ubb2html'));
		}

		$oUbb2html=Dyhb::instance('Ubb2html',$sContent);
		$sContent=$oUbb2html->convert();

		return $sContent;
	}

	static public function emotion(){
		$sLangname=LANG_NAME?LANG_NAME:'Zh-cn';
		$sLangname=strtolower($sLangname);
		$sLangname=str_replace('-','_',$sLangname);

		$sPublic=__PUBLIC__;
		$sEmotionLang=is_file(NEEDFORBUG_PATH.'/Public/js/ffemotion/js/'.$sLangname.'.js')?$sLangname:'zh-cn';

		return <<<NEEDFORBUG
		<link href="{$sPublic}/js/ffemotion/css/emotion.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="{$sPublic}/js/ffemotion/js/{$sEmotionLang}.js"></script>
		<script type="text/javascript" src="{$sPublic}/js/ffemotion/js/swfobject.js"></script>
		<script type="text/javascript" src="{$sPublic}/js/ffemotion/js/emotion_data.js"></script>
		<script type="text/javascript" src="{$sPublic}/js/ffemotion/js/emotion.js"></script>
NEEDFORBUG;
	}

}
