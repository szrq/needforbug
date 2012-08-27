<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Needforbug 安装函数库($)*/

!defined('DYHB_PATH') && exit;

class Install_Extend extends Controller{

	public static function gdVersion(){
		if(!function_exists('phpinfo')){
			if(function_exists('imagecreate')){
				return '2.0';
			}else{
				return 0;
			}
		}else{
			ob_start();
			phpinfo(8);

			$arrModuleInfo=ob_get_contents();
			ob_end_clean();
			if(preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i",$arrModuleInfo,$arrMatches)){
				$nGdversion=$arrMatches[1];
			}else{
				$nGdversion=0;
			}

			return $nGdversion;
		}
	}

	public static function testWrite($sPath){
		$sFile='Dyhb.test.txt';

		$sPath=preg_replace("#\/$#",'',$sPath);
		$hFp=@fopen($sPath.'/'.$sFile,'w');
		if(!$hFp){
			return false;
		}else{
			fclose($hFp);
			$bRs=@unlink($sPath.'/'.$sFile);

			if($bRs){
				return true;
			}else{
				return false;
			}
		}
	}
	
	public static function showJavascriptMessage($sMessage){
		echo '<script type="text/javascript">showMessage(\''.addslashes($sMessage).' \');</script>'."\r\n";
		flush();
		ob_flush();
	}

	public static function importTable($sFilepath){
		global $hConn,$sSql4Tmp,$sDbprefix,$nMysqlVersion;

		$sQuery='';

		$hFp=fopen($sFilepath,'r');
		while(!feof($hFp)){
			$sLine=rtrim(fgets($hFp,1024));
			if(preg_match("#;$#",$sLine)){
				$sQuery.=$sLine."\n";
				$sQuery=str_replace('#@__',$sDbprefix,$sQuery);
				if(substr($sQuery,0,12)=='CREATE TABLE'){
					$sTableName=preg_replace("/CREATE TABLE `([a-z0-9_]+)` .*/is","\\1",$sQuery);
				}

				if($nMysqlVersion<4.1){
					$hRs=mysql_query($sQuery,$hConn);
				}else{
					if(preg_match('#CREATE#i',$sQuery)){
						$hRs=mysql_query(preg_replace("#TYPE=MyISAM#i",$sSql4Tmp,$sQuery),$hConn);
					}else{
						$hRs=mysql_query($sQuery,$hConn);
					}
				}

				if($hRs===true){
					self::showJavascriptMessage(Dyhb::L('创建数据库表').' '.$sTableName.' ... '.Dyhb::L('成功'));
				}else{
					self::sqlError($sQuery);
				}

				$sQuery='';
			}else if(!preg_match("#^(\/\/|--)#",$sLine)){
				$sQuery.=$sLine;
			}
		}
		fclose($hFp);
	}

	public static function runQuery($sFilepath,$bEchomessage=true){
		global $hConn,$sSql4Tmp,$sDbprefix,$nMysqlVersion;
		
		$sQuery='';

		$hFp=fopen($sFilepath,'r');
		while(!feof($hFp)){
			$sLine=rtrim(fgets($hFp,1024));
			if(preg_match("#;$#",$sLine)){
				$sQuery.=$sLine;
				$sQuery=str_replace('#@__',$sDbprefix,$sQuery);
				$hRs=mysql_query($sQuery,$hConn);

				if($hRs===true){
					if($bEchomessage===true){
						self::showJavascriptMessage(
							Dyhb::L('执行SQL').' '.G::subString($sQuery,0,50).' ... '.Dyhb::L('成功'));
					}
				}else{
					self::sqlError($sQuery);
				}

				$sQuery='';
			}else if(!preg_match("#^(\/\/|--)#",$sLine)){
				$sQuery.=$sLine;
			}
		}

		fclose($hFp);
	}

	static public function sqlError($sSql){
		self::showJavascriptMessage('');
		self::showJavascriptMessage('<h3 style="color:red;">'.'对不起数据库执行遇到错误'.'</h3>');

		self::showJavascriptMessage('<b>'.'错误代码'.'</b>');
		self::showJavascriptMessage(mysql_errno());
		self::showJavascriptMessage('');
		self::showJavascriptMessage('<b>'.'错误消息').'</b>';
		self::showJavascriptMessage(mysql_error());
		self::showJavascriptMessage('');
		self::showJavascriptMessage('<b>'.'错误SQL').'</b>';
		self::showJavascriptMessage($sSql);
		self::showJavascriptMessage('');
		self::showJavascriptMessage('<b>'.'请修正后再次执行升级程序'.'</b>');

		exit();
	}

	static public function removeDir($sDirName){
		if(!is_dir($sDirName)){
			@unlink($sDirName);
			self::showJavascriptMessage('清理文件'.' '.str_replace(G::tidyPath(NEEDFORBUG_PATH),'{NEEDFORBUG_PATH}',G::tidyPath($sDirName)));

			return false;
		}

		$hHandle=@opendir($sDirName);
		while(($file=@readdir($hHandle))!==false){
			if($file!='.' && $file!='..'){
				$sDir=$sDirName.'/'.$file;
				if(is_dir($sDir)){
					self::removeDir($sDir);
				}else{
					@unlink($sDir);
					self::showJavascriptMessage('清理文件'.' '.str_replace(G::tidyPath(NEEDFORBUG_PATH),'{NEEDFORBUG_PATH}',G::tidyPath($sDir)));
				}
			}
		}

		closedir($hHandle);

		$bResult=rmdir($sDirName);
		self::showJavascriptMessage('清理目录'.' '.str_replace(G::tidyPath(NEEDFORBUG_PATH),'{NEEDFORBUG_PATH}',G::tidyPath($sDirName)));

		return $bResult;
	}

	public static function isEmptydir($sDir){
		$hDir=@opendir($sDir);
		
		$nI=0;
		while($file=readdir($hDir)){
			$nI++;
		}
		closedir($hDir);

		if($nI>2){
			return false;
		}else{
			return true;
		}
	}

}
