<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Needforbug 安装程序默认控制器($)*/

!defined('DYHB_PATH') && exit;

/** 配置NeedForBug默认数据库名字 */
define('NEEDFORBUG_DATABASE','needforbugv'.NEEDFORBUG_SERVER_RELEASE);

class IndexController extends Controller{

	public $_sLockfile='';

	public function init__(){
		parent::init__();
	}

	public function check_install(){
		$this->_sLockfile=NEEDFORBUG_PATH.'/data/Install.lock.php';

		if(file_exists($this->_sLockfile)){
			$this->E(Dyhb::L(" 程序已运行安装，如果你确定要重新安装，请先从FTP中删除 %s",'App',null,$this->_sLockfile));
		}
	}

	public function index(){
		$this->assign('arrInstallLangs',G::listDir(APP_PATH.'/App/Lang'));
		$this->display('step+language');
	}

	public function select(){
		$this->display('step+select');
	}

	public function step1(){
		$this->check_install();

		// 版权信息
		if(file_exists(APP_PATH."/App/Lang/".LANG_NAME."/LICENSE.txt")){
			$sCopyTxt=nl2br(file_get_contents(APP_PATH."/App/Lang/".LANG_NAME."/LICENSE.txt"));
		}else{
			$sCopyTxt=nl2br(file_get_contents(APP_PATH."/App/Lang/LICENSE.txt"));
		}
		$this->assign('sCopyTxt',$sCopyTxt);

		$this->display('install+step1');
	}

	public function step2(){
		$this->check_install();

		// 取得服务器相关信息
		$arrInfo=array();

		$arrInfo['phpv']=phpversion();
		$arrInfo['sp_os']=PHP_OS;
		
		$arrInfo['sp_gd']=Install_Extend::gdVersion();
		
		$arrInfo['sp_server']=$_SERVER['SERVER_SOFTWARE'];
		$arrInfo['sp_host']=(empty($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_HOST'] : $_SERVER['REMOTE_ADDR']);
		$arrInfo['sp_name']=$_SERVER['SERVER_NAME'];
		$arrInfo['sp_max_execution_time']=ini_get('max_execution_time');
		
		$arrInfo['sp_allow_reference']=(ini_get('allow_call_time_pass_reference')? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
		$arrInfo['sp_allow_url_fopen']=(ini_get('allow_url_fopen')? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
		
		$arrInfo['sp_safe_mode']=(ini_get('safe_mode')? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');
		$arrInfo['sp_gd']=($arrInfo['sp_gd']>0 ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
		
		$arrInfo['sp_mysql']=(function_exists('mysql_connect')? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
		if($arrInfo['sp_mysql']=='<font color=red>[×]Off</font>'){
			$bSpMysqlErr=TRUE;
		}else{
			$bSpMysqlErr=FALSE;
		}

		// 系统安装权限检查
		$arrSpTestDirs=array(
			'/config/Config.inc.php',
			'/data/*',
			'/data/upload/*',
			'/data/avatar/*',
			'/data/backup/*',
		);

		$this->assign('arrInfo',$arrInfo);
		$this->assign('bSpMysqlErr',$bSpMysqlErr);
		$this->assign('arrSpTestDirs',$arrSpTestDirs);

		$this->display('install+step2');
	}

	public function step3(){
		$this->check_install();

		if(!empty($_SERVER['HTTP_HOST'])){
			$sBaseurl='http://'.$_SERVER['HTTP_HOST'];
		}else{
			$sBaseurl="http://".$_SERVER['SERVER_NAME'];
		}

		$sBaseurl=$sBaseurl.__ROOT__;

		$arrApps=G::listDir(APP_PATH.'/Static/Sql/Zh-cn/App');

		$this->assign('sBasepath',$sBaseurl);
		$this->assign('sBaseurl',$sBaseurl);
		$this->assign('arrApps',$arrApps);

		$this->display('install+step3');
	}

	public function install(){
		global $hConn,$sSql4Tmp,$sDbprefix,$nMysqlVersion;

		$this->check_install();

		// 获取表单数据
		$sDbhost=trim(G::getGpc('dbhost'));
		$sDbuser=trim(G::getGpc('dbuser'));
		$sDbpwd=trim(G::getGpc('dbpwd'));
		$sDbname=trim(G::getGpc('dbname'));
		$sDbprefix=trim(G::getGpc('dbprefix'));
		$sAdminuser=trim(G::getGpc('adminuser'));
		$sAdminpwd=trim(G::getGpc('adminpwd'));
		$sCookieprefix=trim(G::getGpc('cookieprefix'));
		$sRbacprefix=trim(G::getGpc('rbacprefix'));

		// 验证表单
		if(empty($sAdminuser)){
			$this->E(Dyhb::L('管理员帐号不能为空'));
		}

		if(!preg_match('/^[a-z0-9\-\_]*[a-z\-_]+[a-z0-9\-\_]*$/i',$sAdminuser)){
			$this->E(Dyhb::L('管理员帐号只能是由英文,字母和下划线组成'));
		}

		if(empty($sAdminpwd)){
			$this->E(Dyhb::L('管理员密码不能为空'));
		}

		if(empty($sRbacprefix)){
			$this->E(Dyhb::L('Rbac前缀不能为空'));
		}

		if(empty($sCookieprefix)){
			$this->E(Dyhb::L('Cookie前缀不能为空'));
		}

		if((!$hConn=@mysql_connect($sDbhost,$sDbuser,$sDbpwd))){
			$this->E(Dyhb::L('数据库服务器或登录密码无效').",".Dyhb::L('无法连接数据库，请重新设定！'));
		}

		mysql_query("CREATE DATABASE IF NOT EXISTS `".$sDbname."`;",$hConn);

		if(!mysql_select_db($sDbname)){
			$this->E(Dyhb::L('选择数据库失败，可能是你没权限，请预先创建一个数据库！'));
		}

		// 取得数据库版本
		$sRs=mysql_query("SELECT VERSION();",$hConn);
		$arrRow=mysql_fetch_array($sRs);
		$arrMysqlVersions=explode('.',trim($arrRow[0]));
		$nMysqlVersion=$arrMysqlVersions[0].".".$arrMysqlVersions[1];

		mysql_query("SET NAMES 'UTF8',character_set_client=binary,sql_mode='';",$hConn);

		// 写入配置文件
		$arrConfig=(array)(include NEEDFORBUG_PATH.'/config/ConfigDefault.inc.php');
		$arrConfig['DB_HOST']=$sDbhost;
		$arrConfig['DB_USER']=$sDbuser;
		$arrConfig['DB_PASSWORD']=$sDbpwd;
		$arrConfig['DB_NAME']=$sDbname;
		$arrConfig['DB_PREFIX']=$sDbprefix;
		$arrConfig['RBAC_DATA_PREFIX']=$sRbacprefix;
		$arrConfig['COOKIE_PREFIX']=$sCookieprefix;
		
		if(!file_put_contents(NEEDFORBUG_PATH.'/config/Config.inc.php',
			"<?php\n /* DoYouHaoBaby Framework Config File,Do not to modify this file! */ \n return ".
			var_export($arrConfig,true).
			"\n?>")
		){
			$this->E((Dyhb::L('写入配置失败，请检查%s目录是否可写入！','app',null,NEEDFORBUG_PATH.'/Config')));
		}

		// 输出消息框
		$this->display('install+message');

		// 防止乱码
		$sSql4Tmp='';
		if($nMysqlVersion>=4.1){
			$sSql4Tmp="ENGINE=MyISAM DEFAULT CHARSET=UTF8";
		}
		
		// 创建系统表
		Install_Extend::showJavascriptMessage('<h3>'.'创建系统数据库表'.'</h3>');
		Install_Extend::importTable(APP_PATH.'/Static/Sql/needforbug.table.sql');
		Install_Extend::showJavascriptMessage(' ');

		$sLangCookieName=$GLOBALS['_commonConfig_']['COOKIE_LANG_TEMPLATE_INCLUDE_APPNAME']===true?APP_NAME.'_language':'language';
		$sNeedforbugDatadir=APP_PATH.'/Static/Sql/';

		// 执行系统初始化数据
		$sNeedforbugDatapath=$sNeedforbugDatadir.'/'.ucfirst(Dyhb::cookie($sLangCookieName)).'/needforbug.data.sql';
		if(!is_file($sNeedforbugDatapath)){
			$sNeedforbugDatapath=$sNeedforbugDatadir.'/Zh-cn/needforbug.data.sql';
		}
		Install_Extend::showJavascriptMessage('<h3>'.'初始化系统数据库数据'.'</h3>');
		Install_Extend::runQuery($sNeedforbugDatapath);
		Install_Extend::showJavascriptMessage(' ');

		// 导入地理数据
		Install_Extend::showJavascriptMessage('<h3>'.'导入地理数据库数据'.'</h3>');
		for($nI=1;$nI<=6;$nI++){
			Install_Extend::showJavascriptMessage('导入地理数据库数据'.$nI);
			Install_Extend::runQuery($sNeedforbugDatadir.'/district/'.$nI.'.sql',false);
		}
		Install_Extend::showJavascriptMessage(' ');

		// 安装系统预置应用
		Install_Extend::showJavascriptMessage('<h3>'.'安装系统预置应用'.'</h3>');
		
		$arrApps=G::getGpc('app','P');
		if(empty($arrApps)){
			Install_Extend::showJavascriptMessage('没有发现需要安装的应用');
			Install_Extend::showJavascriptMessage(' ');
		}else{
			foreach($arrApps as $sApp){
				Install_Extend::showJavascriptMessage(sprintf('创建应用 %s 的数据库表',$sApp));
				Install_Extend::importTable($sNeedforbugDatadir.'/app/'.$sApp.'/needforbug.table.sql');
				Install_Extend::showJavascriptMessage(' ');

				$sNeedforbugAppDatapath=$sNeedforbugDatadir.'/'.ucfirst(Dyhb::cookie($sLangCookieName)).'/app/'.$sApp.'/needforbug.data.sql';
				if(!is_file($sNeedforbugDatapath)){
					$sNeedforbugAppDatapath=$sNeedforbugDatadir.'/Zh-cn/app/'.$sApp.'/needforbug.data.sql';
				}
				Install_Extend::showJavascriptMessage(sprintf('导入应用 %s 的数据库数据',$sApp));
				Install_Extend::runQuery($sNeedforbugAppDatapath);
				Install_Extend::showJavascriptMessage(' ');
			}
		}

		// 初始化安装程序设置
		Install_Extend::showJavascriptMessage('<h3>'.'初始化安装程序设置'.'</h3>');
		
		mysql_query("Update `{$sDbprefix}option` set option_value='".trim(G::getGpc('baseurl'))."' where option_name='site_url';",$hConn);
		Install_Extend::showJavascriptMessage(Dyhb::L('写入社区地址').' '.trim(G::getGpc('baseurl')).' ... '.Dyhb::L('成功'));

		mysql_query("Update `{$sDbprefix}option` set option_value='".trim(G::getGpc('webname'))."' where option_name='site_name';",$hConn);
		Install_Extend::showJavascriptMessage(Dyhb::L('写入社区名称').' '.trim(G::getGpc('webname')).' ... '.Dyhb::L('成功'));

		mysql_query("Update `{$sDbprefix}option` set option_value='".trim(G::getGpc('adminmail'))."' where option_name='admin_email';",$hConn);
		Install_Extend::showJavascriptMessage(Dyhb::L('写入管理员邮件').' '.trim(G::getGpc('adminmail')).' ... '.Dyhb::L('成功'));
		Install_Extend::showJavascriptMessage(' ');

		// 初始化管理员信息
		Install_Extend::showJavascriptMessage('<h3>'.'初始化管理员信息'.'</h3>');
		
		$sRandom=G::randString(6);
		$sPassword=md5(md5($sAdminpwd).trim($sRandom));
		mysql_query("Update `{$sDbprefix}user` set user_name='".$sAdminuser."',user_password='".$sPassword."',user_random='".$sRandom."',user_password='".$sPassword."',user_registerip='".G::getIp()."',user_email='".trim(G::getGpc('adminmail'))."',user_lastloginip='".G::getIp()."' where user_id=1;",$hConn);
		Install_Extend::showJavascriptMessage(Dyhb::L('初始化超级管理员帐号').'... '.Dyhb::L('成功'));
		Install_Extend::showJavascriptMessage(' ');

		// 写入锁定文件
		if(!file_put_contents($this->_sLockfile,'ok')){
			$this->E(Dyhb::L('写入安装锁定文件失败，请检查%s目录是否可写入','App',null,NEEDFORBUG_PATH.'/data'));
		}
		Install_Extend::showJavascriptMessage(Dyhb::L('写入安装程序锁定文件').'... '.Dyhb::L('成功'));
		Install_Extend::showJavascriptMessage(' ');

		// 执行清理
		Install_Extend::showJavascriptMessage('<h3>'.'清理系统缓存目录'.'</h3>');

		// 初始化系统和跳转
		$sInitsystemUrl=trim(G::getGpc('baseurl')).'/index.php?app=home&c=misc&a=init_system';
		
		echo<<<NEEDFORBUG
		<script type="text/javascript">
			function setLaststep(){
				setTimeout(function(){
					document.getElementById("laststep").disabled=false;
					window.location=D.U('index/success');
				},1000);
			}
		</script>
		<script type="text/javascript">setTimeout(function(){window.location=window.location=D.U('index/success');},30000);
		</script>
		<iframe src="{$sInitsystemUrl}" style="display:none;" onload="setLaststep()"></iframe>
NEEDFORBUG;

		exit();
	}

	public function success(){
		$this->display('install+success');
	}

	public function check_database(){
		$this->check_install();

		header("Pragma:no-cache\r\n");
		header("Cache-Control:no-cache\r\n");
		header("Expires:0\r\n");

		$sDbhost=G::getGpc('dbhost');
		$sDbuser=G::getGpc('dbuser');
		$sDbpwd=G::getGpc('dbpwd');
		$sDbname=G::getGpc('dbname');
		$hConn=@mysql_connect($sDbhost,$sDbuser,$sDbpwd);

		if($hConn){
			if(empty($sDbname)){
				$this->S("<font color='green'>".Dyhb::L('数据库连接成功')."</font>");
			}else{
				if(mysql_select_db($sDbname,$hConn)){
					$this->E("<font color='red'>".Dyhb::L('数据库已经存在，系统将覆盖数据库')."</font>");
				}else{
					$this->S("<font color='green'>".Dyhb::L('数据库不存在,系统将自动创建')."</font>");
				}
			}
		}else{
			$this->E("<font color='red'>".Dyhb::L('数据库连接失败！')."</font>");
		}

		@mysql_close($hConn);

		exit();
	}

}
