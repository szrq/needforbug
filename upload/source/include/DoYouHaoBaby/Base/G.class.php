<?php
/* [DoYouHaoBaby!] (C)Dianniu From 2010.
   全局函数集($)*/

!defined('DYHB_PATH') && exit;

class G{

	static function getGpc($sKey,$sVar='R'){
		$sVar=strtoupper($sVar);
		switch($sVar){
			case 'G':$sVar=&$_GET;break;
			case 'P':$sVar=&$_POST;break;
			case 'C':$sVar=&$_COOKIE;break;
			case 'S':$sVar=&$_SESSION;break;
			case 'R':$sVar=&$_REQUEST;break;
			case 'F':$sVar=&$_FILES;break;
		}

		return isset($sVar[$sKey])?$sVar[$sKey]:NULL;
	}

	public static function seccode($arrOption=null,$bChinesecode=false,$nSeccodeTupe=1){
		@header("Expires: -1");// 定义头部
		@header("Cache-Control: no-store,private,post-check=0,pre-check=0,max-age=0",FALSE);
		@header("Pragma: no-cache");

		$nSeccode=G::authcode(Dyhb::cookie('_seccode_'));
		if(!$nSeccode || self::getGpc('update')){
			$nSeccode=G::randString(6,null,true);

			if($bChinesecode and $nSeccodeTupe==1){ // 中文
				$sChineseLang=(string)include(DYHB_PATH.'/Resource_/Images/Seccode/Chinese.inc.php');

				$arrCode=array(substr($nSeccode,0,3),substr($nSeccode,3,3));
				$nSeccode='';
				for($nI=0;$nI<2;$nI++){
					$nSeccode.=substr($sChineseLang,$arrCode[$nI]*3,3);
				}
			}else{
				$sS=sprintf('%04s',base_convert($nSeccode,10,24));
				$sSeccodeUnits='BCEFGHJKMPQRTVWXY2346789';
				$nSeccode='';
				for($nI=0;$nI<4;$nI++){
					$sUnit=ord($sS{$nI});
					$nSeccode.=($sUnit>=0x30 and $sUnit<=0x39)?$sSeccodeUnits[$sUnit-0x30]:$sSeccodeUnits[$sUnit-0x57];
				}
			}

			Dyhb::cookie('_seccode_',G::authcode(strtoupper($nSeccode),FALSE));
		}

		$oCode=new Seccode($arrOption);// 实例化对象
		$oCode->setCode($nSeccode)->display();
	}

	public static function checkSeccode($sSeccode){
		$nOldSeccode=G::authcode(Dyhb::cookie('_seccode_'));

		if(empty($nOldSeccode)){
			return false;
		}

		return $nOldSeccode==strtoupper($sSeccode);// 开始比较数据
	}

	static public function stripslashes($String,$bRecursive=true){
		if($bRecursive===true and is_array($String)){// 递归
			foreach($String as $sKey=>$value){
				$String[self::stripslashes($sKey)]=self::stripslashes($value);// 如果你只注意到值，却没有注意到key
			}
		}else{
			if(is_string($String)){
				$String=stripslashes($String);
			}
		}
		return $String;
	}

	static public function addslashes($String,$bRecursive=true){
		if($bRecursive===true and is_array($String)){
			foreach($String as $sKey=>$value){
				$String[self::addslashes($sKey)]=self::addslashes($value);// 如果你只注意到值，却没有注意到key
			}
		}else{
			if(self::getMagicQuotesGpc() and is_string($String)){
				$String=addslashes($String);
			}
		}

		return $String;
	}

	static public function getMagicQuotesGpc(){
		return(defined('MAGIC_QUOTES_GPC') && MAGIC_QUOTES_GPC===TRUE);
	}

	static public function varType($Var,$sType){
		$sType=trim($sType);// 整理参数，以支持array:ini格式

		$arrTypes=explode(':',$sType);
		$sRealType=$arrTypes[0];
		$sAllow=isset($arrTypes[1])?$arrTypes[1]:null;
		$sRealType=strtolower($sRealType);

		switch($sRealType){
			case 'string':// 字符串
				return is_string($Var);
			case 'integer':// 整数
			case 'int' :
				return is_int($Var);
			case 'float':// 浮点
				return is_float($Var);
			case 'boolean':// 布尔
			case 'bool':
				return is_bool($Var);
			case 'num':// 数字
			case 'numeric':
				return is_numeric($Var);
			case 'base':// 标量（所有基础类型）
			case 'scalar':
				return is_scalar($Var);
			case 'handle':// 外部资源
			case 'resource':
				return is_resource($Var);
			case 'array':{// 数组
				if($sAllow){
					$arrAllow=explode(',',$sAllow);
					return self::checkArray($Var,$arrAllow);
				}else{
					return is_array($Var);
				}
			}
			case 'object':// 对象
				return is_object($Var);
			case 'null':// 空
			case 'NULL':
				return($Var===null);
			case 'callback':// 回调函数
				return is_callable($Var,false);
			default :// 类
				return self::isKindOf($Var,$sType);
		}
	}

	static public function smartDate($nDateTemp,$sDateFormat='Y-m-d H:i'){
		$sReturn='';

		$nSec=CURRENT_TIMESTAMP-$nDateTemp;
		$nHover=floor($nSec/3600);
		if($nHover==0){
			$nMin=floor($nSec/60);
			if($nMin==0){
				$sReturn=$nSec.' '.Dyhb::L("秒前",'__DYHB__@Dyhb');
			}else{
				$sReturn=$nMin.' '.Dyhb::L("分钟前",'__DYHB__@Dyhb');
			}
		}elseif($nHover<24){
			$sReturn=Dyhb::L("大约 %d 小时前",'__DYHB__@Dyhb',null,$nHover);
		}else{
			$sReturn=date($sDateFormat,$nDateTemp);
		}

		return $sReturn;
	}

	static public function urlGoTo($sUrl,$nTime=0,$sMsg=''){
		$sUrl=str_replace(array("\n","\r"),'',$sUrl);// 多行URL地址支持

		if(empty($sMsg)){
			$sMsg=Dyhb::L("系统将在%d秒之后自动跳转到%s。",'__DYHB__@Dyhb',null,$nTime,$sUrl);
		}

		if(!headers_sent()){
			if(0==$nTime){
				header("Location:".$sUrl);
			}else{
				header("refresh:{$nTime};url={$sUrl}");
				echo($sMsg);
			}
			exit();
		}else{
			$sStr="<meta http-equiv='Refresh' content='{$nTime};URL={$sUrl}'>";
			if($nTime!=0){
				$sStr.=$sMsg;
			}
			exit($sStr);
		}
	}

	static public function randString($nLength,$sCharBox=null,$bNumeric=false){
		if($bNumeric===true){
			return sprintf('%0'.$nLength.'d',mt_rand(1,pow(10,$nLength)-1));
		}

		if($sCharBox===null){
			$sBox=strtoupper(md5(self::now(true).rand(1000000000,9999999999)));
			$sBox.=md5(self::now(true).rand(1000000000,9999999999));
		}else{
			$sBox=&$sCharBox;
		}

		$nN=$nLength;
		$nBoxEnd=strlen($sBox)-1;
		$sRet='';
		while($nN--){
			$sRet.=substr($sBox,rand(0,$nBoxEnd),1);
		}

		return $sRet;
	}

	static public function now($bExact=true){
		if($bExact){
			list($nMS,$nS)=explode(' ',microtime());
			return $nS+$nMS;
		}else{
			return CURRENT_TIMESTAMP;
		}
	}

	static public function gbkToUtf8($FContents,$sFromChar,$sToChar='utf-8'){
		if(empty($FContents)){
			return $FContents;
		}

		$sFromChar=strtolower($sFromChar)=='utf8'?'utf-8':strtolower($sFromChar);
		$sToChar=strtolower($sToChar)=='utf8'?'utf-8':strtolower($sToChar);
		if($sFromChar==$sToChar || (is_scalar($FContents) && !is_string($FContents))){
			return $FContents;
		}

		if(is_string($FContents)){
			if(function_exists('mb_convert_encoding')){
				return mb_convert_encoding($FContents,$sFromChar,$sToChar);
			}elseif(function_exists('iconv')){
				return iconv($FContents,$sFromChar,$sToChar);
			}else{
				return $FContents;
			}
		}elseif(is_array($FContents)){
			foreach($FContents as $sKey=>$sVal){
				$sKeyTwo=self::gbkToUtf8($sKey,$sFromChar,$sToChar);
				$FContents[$sKeyTwo]=self::gbkToUtf8($sVal,$sFromChar,$sToChar);
				if($sKey!=$sKeyTwo){
					unset($FContents[$sKeyTwo]);
				}
			}
			return $FContents;
		}else{
			return $FContents;
		}
	}

	public static function isUtf8($sString){
		$nLength=strlen($sString);

		for($nI=0;$nI<$nLength;$nI++){
			if(ord($sString[$nI])<0x80){
				$nN=0;
			}elseif((ord($sString[$nI])&0xE0)==0xC0){
				$nN=1;
			}elseif((ord($sString[$nI])&0xF0)==0xE0){
				$nN=2;
			}elseif((ord($sString[$nI])&0xF0)==0xF0){
				$nN=3;
			}else{
				return FALSE;
			}

			for($nJ=0;$nJ<$nN;$nJ++){
				if((++$nI==$nLength) ||((ord($sString[$nI])&0xC0)!=0x80)){
					return FALSE;
				}
			}
		}

		return TRUE;
	}

	static public function subString($sStr,$nStart=0,$nLength=255,$sCharset="utf-8",$bSuffix=true){
		// 对系统的字符串函数进行判断
		if(function_exists("mb_substr")){
			return mb_substr($sStr,$nStart,$nLength,$sCharset);
		}elseif(function_exists('iconv_substr')){
			return iconv_substr($sStr,$nStart,$nLength,$sCharset);
		}

		// 常用几种字符串正则表达式
		$arrRe['utf-8']="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$arrRe['gb2312']="/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$arrRe['gbk']="/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$arrRe['big5']="/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		
		// 匹配
		preg_match_all($arrRe[$sCharset],$sStr,$arrMatch);
		$sSlice=join("",array_slice($arrMatch[0],$nStart,$nLength));

		if($bSuffix){
			return $sSlice."…";
		}

		return $sSlice;
	}

	static public function isSameCallback($CallbackA,$CallbackB){
		if(!is_callable($CallbackA) || is_callable($CallbackB)){
			return false;
		}

		if(is_array($CallbackA)){
			if(is_array($CallbackB)){
				return($CallbackA[0]===$CallbackB[0]) AND (strtolower($CallbackA[1])===strtolower($CallbackB[1]));
			}else{
				return false;
			}
		}else{
			return strtolower($CallbackA)===strtolower($CallbackB);
		}
	}

	static public function isThese($Var,$Types){
		if(!self::varType($Types,'string') && !self::checkArray($Types,array('string'))){
			Dyhb::E(Dyhb::L('正确格式:参数 $Types 必须为 string 或 各项元素为string的数组','__DYHB__@Dyhb'));
		}

		if(is_string($Types)){
			$arrTypes=array($Types);
		}else{
			$arrTypes=$Types;
		}

		foreach($arrTypes as $sType){// 类型检查
			if(self::varType($Var,$sType)){
				return true;
			}
		}

		return false;
	}

	static public function isKindOf($SubClass,$sBaseClass){
		if(Dyhb::classExists($sBaseClass,true)){// 接口
			return self::isImplementedTo($SubClass,$sBaseClass);
		}else{// 类
			if(is_object($SubClass)){// 统一类名,如果不是，返回false
				$sSubClassName=get_class($SubClass);
			}elseif(is_string($SubClass)){
				$sSubClassName=&$SubClass;
			}else{
				return false;
			}

			if($sSubClassName==$sBaseClass){// 子类名 即为父类名
				return true;
			}

			$sParClass=get_parent_class($sSubClassName);// 递归检查
			if(!$sParClass){
				return false;
			}

			return self::isKindOf($sParClass,$sBaseClass);
		}
	}

	static public function isImplementedTo($Class,$sInterface,$bStrictly=false){
		if(is_object($Class)){// 尝试获取类名，否则返回false
			$sClassName=get_class($Class);
		}elseif(is_string($Class)){
			$sClassName=&$Class;
		}else{
			return false;
		}

		if(!is_string($sClassName)){// 类型检查
			return false;
		}

		if(!class_exists($sClassName) || !interface_exists($sInterface)){// 检查类和接口是否都有效
			return false;
		}

		// 建立反射
		$oReflectionClass=new ReflectionClass($sClassName);
		$arrInterfaceRefs=$oReflectionClass->getInterfaces();
		foreach($arrInterfaceRefs as $oInterfaceRef){
			if($oInterfaceRef->getName()!=$sInterface){
				continue;
			}

			if(!$bStrictly){// 找到 匹配的 接口
				return true;
			}

			// 依次检查接口中的每个方法是否实现
			$arrInterfaceFuncs=get_class_methods($sInterface);
			foreach($arrInterfaceFuncs as $sFuncName){
				$sReflectionMethod=$oReflectionClass->getMethod($sFuncName);
				if($sReflectionMethod->isAbstract()){// 发现尚为抽象的方法
					return false;
				}
			}

			return true;
		}

		// 递归检查父类
		if(($sParName=get_parent_class($sClassName))!==false){
			return self::isImplementedTo($sParName,$sInterface,$bStrictly);
		}else{
			return false;
		}
	}

	static public function checkArray($arrArray,array $arrTypes){
		if(!is_array($arrArray)){// 不是数组直接返回
			return false;
		}

		// 判断数组内部每一个值是否为给定的类型
		foreach($arrArray as &$Element){
			$bRet=false;
			foreach($arrTypes as $Type){
				if(self::varType($Element,$Type)){
					$bRet=true;
					break;
				}
			}

			if(!$bRet){
				return false;
			}
		}

		return true;
	}

	static public function tidyPath($sPath,$bUnix=true){
		$sRetPath=str_replace('\\','/',$sPath);// 统一 斜线方向
		$sRetPath=preg_replace('|/+|','/',$sRetPath);// 归并连续斜线

		$arrDirs=explode('/',$sRetPath);// 削除 .. 和  .
		$arrDirs2=array();
		while(($sDirName=array_shift($arrDirs))!==null){
			if($sDirName=='.'){
				continue;
			}

			if($sDirName=='..'){
				if(count($arrDirs2)){
					array_pop($arrDirs2);
					continue;
				}
			}

			array_push($arrDirs2,$sDirName);
		}

		$sRetPath=implode('/',$arrDirs2);// 目录 以  '/' 结尾
		if(@is_dir($sRetPath)){// 存在的目录
			if(!preg_match('|/$|',$sRetPath)){
				$sRetPath.= '/';
			}
		}else if(preg_match("|\.$|",$sPath)){// 不存在，但是符合目录的格式
			if(!preg_match('|/$|',$sRetPath)){
				$sRetPath.= '/';
			}
		}

		$sRetPath=str_replace(':/',':\\',$sRetPath);// 还原 驱动器符号
		if(!$bUnix){// 转换到 Windows 斜线风格
			$sRetPath=str_replace('/','\\',$sRetPath);
		}

		$sRetPath=rtrim($sRetPath,'\\/');// 删除结尾的“/”或者“\”

		return $sRetPath;
	}

	static public function dump($Var,$bEcho=true,$sLabel=null,$bStrict=true){
		$SLabel=($sLabel===null)?'':rtrim($sLabel).' ';
		if(!$bStrict){
			if(ini_get('html_errors')){
				$sOutput=print_r($Var,true);
				$sOutput="<pre>".$sLabel.htmlspecialchars($sOutput,ENT_QUOTES)."</pre>";
			}else{
				$sOutput=$sLabel." : ".print_r($Var,true);
			}
		}else{
			ob_start();
			var_dump($Var);
			$sOutput=ob_get_clean();
			if(!extension_loaded('xdebug')){
				$sOutput=preg_replace("/\]\=\>\n(\s+)/m","] => ",$sOutput);
				$sOutput='<pre>'.$sLabel.htmlspecialchars($sOutput,ENT_QUOTES).'</pre>';
			}
		}

		if($bEcho){
			echo $sOutput;
			return null;
		}else{
			return $sOutput;
		}
	}

	static public function makeDir($Dir,$nMode=0777){
		if(is_dir($Dir)){
			return true;
		}

		if(is_string($Dir)){
			$arrDirs=explode('/',str_replace('\\','/',trim($Dir,'/')));
		}else{
			$arrDirs=$Dir;
		}

		$sMakeDir=IS_WIN?'':'/';
		foreach($arrDirs as $sDir){
			$sMakeDir.=$sDir.'/';
			!is_dir($sMakeDir) && mkdir($sMakeDir,$nMode);
		}

		return TRUE;
	}

	static public function getRelativePath($sFromPath,$sToPath){
		if(@is_file($sFromPath)){// 如果 $sFromPath 是一个文件，取其目录部分
			$sFrom=dirname($sFromPath);
		}else{
			$sFrom=&$sFromPath;
		}

		if(IS_WIN){
			$sFrom=strtolower($sFrom);
			$sToPath=strtolower($sToPath);
		}

		$sFrom=self::tidyPath($sFrom);// 整理路径为统一格式
		$sTo=self::tidyPath($sToPath);
		$arrFromPath=explode('/',$sFrom);// 切为数组
		$arrToPath=explode('/',$sTo);
		array_diff($arrFromPath,array(''));// 排除 空元素
		array_diff($arrToPath,array(''));
		$nSameLevel=0;// 开始比较
		while(
			($sFromOneDir=array_shift($arrFromPath))!==null
			and ($sToOneDir=array_shift($arrToPath))!==null
			and ($sFromOneDir===$sToOneDir)
		)
		{
			$nSameLevel++;
		}

		if($sFromOneDir!==null){// 将 相同的 目录 压回 栈中
			array_unshift($arrFromPath,$sFromOneDir);
		}
		if($sToOneDir!==null){
			array_unshift($arrToPath,$sToOneDir);
		}

		if($nSameLevel<=0){// 不在 同一 磁盘驱动器 中(Windows 环境下)
			return null;
		}

		$nLevel=count($arrFromPath)-1;// 返回
		$sRelativePath=($nLevel>0)?str_repeat('../',$nLevel):'';
		$sRelativePath.=implode('/',$arrToPath);
		$sRelativePath=rtrim($sRelativePath,'/');

		return $sRelativePath;
	}

	static public function changeFileSize($nFileSize){
		if($nFileSize>=1073741824){
			$nFileSize=round($nFileSize/1073741824,2).'GB';
		}elseif($nFileSize>=1048576){
			$nFileSize=round($nFileSize/1048576,2).'MB';
		}elseif($nFileSize>=1024){
			$nFileSize=round($nFileSize/1024,2).'KB';
		}else{
			$nFileSize=$nFileSize.Dyhb::L('字节','__DYHB__@dyhb');
		}

		return $nFileSize;
	}

	static public function getMicrotime(){
		list($nM1,$nM2)=explode(' ',microtime());
		return((float)$nM1+(float)$nM2);
	}

	static public function oneImensionArray($arrArray){
		return count($arrArray)==count($arrArray,1);
	}

	static public function getIp(){
		static $sRealip=NULL;

		if($sRealip !== NULL){
			return $sRealip;
		}

		if(isset($_SERVER)){
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$arrValue=explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
					foreach($arrValue AS $sIp){// 取X-Forwarded-For中第一个非unknown的有效IP字符串
						$sIp=trim($sIp);
						if($sIp!='unknown'){
							$sRealip=$sIp;
							break;
						}
					}
				}elseif(isset($_SERVER['HTTP_CLIENT_IP'])){
					$sRealip=$_SERVER['HTTP_CLIENT_IP'];
				}else{
					if(isset($_SERVER['REMOTE_ADDR'])){
						$sRealip=$_SERVER['REMOTE_ADDR'];
					}else{
						$sRealip='0.0.0.0';
					}
				}
			}else{
				if(getenv('HTTP_X_FORWARDED_FOR')){
					$sRealip=getenv('HTTP_X_FORWARDED_FOR');
				}elseif(getenv('HTTP_CLIENT_IP')){
					$sRealip=getenv('HTTP_CLIENT_IP');
				}else{
					$sRealip=getenv('REMOTE_ADDR');
				}
			}

			preg_match("/[\d\.]{7,15}/",$sRealip,$arrOnlineip);
			$sRealip=!empty($arrOnlineip[0])?$arrOnlineip[0]:'0.0.0.0';

			return $sRealip;
	}

	static public function authcode($string,$operation=TRUE,$key=null,$expiry=3600){
		$ckey_length=4;

		$key=md5($key?$key:$GLOBALS['_commonConfig_']['DYHB_AUTH_KEY']);
		$keya=md5(substr($key,0,16));
		$keyb=md5(substr($key,16,16));
		$keyc=$ckey_length?($operation===TRUE?substr($string,0,$ckey_length):substr(md5(microtime()),-$ckey_length)):'';

		$cryptkey=$keya.md5($keya.$keyc);
		$key_length=strlen($cryptkey);
		$string=$operation===TRUE?base64_decode(substr($string, $ckey_length)):sprintf('%010d',$expiry?$expiry+time():0).substr(md5($string.$keyb),0,16).$string;
		$string_length=strlen($string);

		$result='';
		$box=range(0,255);
		$rndkey=array();
		for($i=0;$i<=255;$i++){
			$rndkey[$i]=ord($cryptkey[$i%$key_length]);
		}

		for($j=$i=0;$i<256;$i++){
			$j=($j+$box[$i]+$rndkey[$i])%256;
			$tmp=$box[$i];
			$box[$i]=$box[$j];
			$box[$j]=$tmp;
		}

		for($a=$j=$i=0;$i<$string_length;$i++){
			$a=($a+1)%256;
			$j=($j+$box[$a])%256;
			$tmp=$box[$a];
			$box[$a]=$box[$j];
			$box[$j]=$tmp;
			$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
		}

		if($operation===TRUE){
			if((substr($result,0,10)==0 || substr($result,0,10)-time()>0) && substr($result,10,16)==substr(md5(substr($result,26).$keyb),0,16)){
				return substr($result,26);
			}else{
				return '';
			}
		}else{
			return $keyc.str_replace('=','',base64_encode($result));
		}
	}

	static public function returnBytes($sVal){
		$sVal=trim($sVal);
		$sLast=strtolower($sVal{strlen($sVal)-1});
		switch($sLast){
			case 'g':
				$sVal*=1024*1024*1024;
			case 'm':
				$sVal*=1024*1024;
			case 'k':
				$sVal*=1024;
		}

		return $sVal;
	}

	static public function listDir($sDir,$bFullPath=FALSE,$bReturnFile=FALSE){
		if(is_dir($sDir)){
			$arrFiles=array();

			$hDir=opendir($sDir);
			while(($sFile=readdir($hDir))!==FALSE){
				if($bReturnFile===FALSE){
					if((is_dir($sDir."/".$sFile)) && $sFile!="." && $sFile!=".." && $sFile!='_svn'){
						if($bFullPath===TRUE){
							$arrFiles[]=$sDir."/".$sFile;
						}else{
							$arrFiles[]=$sFile;
						}
					}
				}else{
					if((is_file($sDir."/".$sFile)) && $sFile!="." && $sFile!=".."){
						if($bFullPath===TRUE){
							$arrFiles[]=$sDir."/".$sFile;
						}else{
							$arrFiles[]=$sFile;
						}
					}
				}
			}
			closedir($hDir);

			return $arrFiles;
		}else{
			return false;
		}
	}

	public static function hasStaticMethod($sClassName,$sMethodName){
		$oRef=new ReflectionClass($sClassName);
		if($oRef->hasMethod($sMethodName) and $oRef->getMethod($sMethodName)->isStatic()){
			return true;
		}

		return false;
	}

	static public function mbUnserialize($sSerial){
		$sSerial=preg_replace('!s:(\d+):"(.*?)";!se',"'s:'.strlen('$2').':\"$2\";'",$sSerial);
		$sSerial=str_replace("\r","",$sSerial);

		return unserialize($sSerial);
	}

	static public function getAvatar($nUid,$sSize='middle'){
		$sSize=in_array($sSize,array('big','middle','small','origin'))?$sSize:'middle';
		$nUid=abs(intval($nUid));
		$nUid=sprintf("%09d",$nUid);
		$nDir1=substr($nUid,0,3);
		$nDir2=substr($nUid,3,2);
		$nDir3=substr($nUid,5,2);

		return $nDir1.'/'.$nDir2.'/'.$nDir3.'/'.substr($nUid,-2)."_avatar_{$sSize}.jpg";
	}

	static public function getExtName($sFileName,$nCase=0){
		if(!preg_match('/\./',$sFileName)){
			return '';
		}

		$arr=explode('.',$sFileName);
		$sExtName=end($arr);

		if($nCase==1){
			return strtoupper($sExtName);
		}elseif($nCase==2){
			return strtolower($sExtName);
		}else{
			return $sExtName;
		}
	}

	static public function cleanJs($sText){
		$sText=trim($sText);
		$sText=stripslashes($sText);

		$sText=preg_replace('/<!--?.*-->/','',$sText);// 完全过滤注释
		$sText=preg_replace('/<\?|\?>/','',$sText);// 完全过滤动态代码
		$sText=preg_replace('/<script?.*\/script>/','',$sText);// 完全过滤js
		$sText=preg_replace('/<\/?(html|head|meta|link|base|body|title|style|script|form|iframe|frame|frameset)[^><]*>/i','',$sText);// 过滤多余html

		while(preg_match('/(<[^><]+)(lang|onfinish|onmouse|onexit|onerror|onclick|onkey|onload|onchange|onfocus|onblur)[^><]+/i',$sText,$arrMat)){//过滤on事件lang js
			$sText=str_replace($arrMat[0],$arrMat[1],$sText);
		}

		while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$sText,$arrMat)){
			$sText=str_replace($arrMat[0],$arrMat[1].$arrMat[3],$sText);
		}

		return $sText;
	}

	static function text($sText){
		$sText=self::cleanJs($sText);

		$sText=preg_replace('/\s(?=\s)/','',$sText);// 彻底过滤空格
		$sText=preg_replace('/[\n\r\t]/',' ',$sText);
		$sText=str_replace('  ',' ',$sText);
		$sText=str_replace(' ','',$sText);
		$sText=str_replace('&nbsp;','',$sText);
		$sText=str_replace('&','',$sText);
		$sText=str_replace('=','',$sText);
		$sText=str_replace('-','',$sText);
		$sText=str_replace('#','',$sText);
		$sText=str_replace('%','',$sText);
		$sText=str_replace('!','',$sText);
		$sText=str_replace('@','',$sText);
		$sText=str_replace('^','',$sText);
		$sText=str_replace('*','',$sText);
		$sText=str_replace('amp;','',$sText);

		$sText=strip_tags($sText);
		$sText=htmlspecialchars($sText);
		$sText=str_replace("'","",$sText);

		return $sText;
	}

	static public function html($sText){
		$sText=trim($sText);
		$sText=htmlspecialchars($sText);

		return $sText;
	}

	static public function htmlView($sText){
		$sText=stripslashes($sText);
		$sText=nl2br($sText);

		return $sText;
	}

	static public function xmlEncode($arrData=array()){
		return Xml::xmlSerialize($arrData);
	}

}
