<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Needforbug 升级程序($)*/

!defined('DYHB_PATH') && exit;

class UpdateController extends Controller{

	protected $_sUpdatefile='';

	public function init__(){
		parent::init__();
	}

	public function check_update(){
		$this->_sUpdatefile=NEEDFORBUG_PATH.'/data/Update.lock.php';

		if(file_exists($this->_sUpdatefile)){
			$this->E(Dyhb::L(" 程序已运行升级，如果你确定要重新升级（可能出现错误），请先从FTP中删除 %s",'App',null,str_replace(G::tidyPath(NEEDFORBUG_PATH),'{NEEDFORBUG_PATH}',G::tidyPath($this->_sUpdatefile))));
		}
	}

	public function index(){
		$this->check_update();

		$this->display('update+step1');
	}

	public function step2(){
		$oIndexController=new IndexController();
		$oIndexController->step2();
	}

	public function step3(){
		$this->check_update();

		$sConfigfile=NEEDFORBUG_PATH.'/config/Config.inc.php';
		if(is_file($sConfigfile)){
			$arrConfig=(array)(include $sConfigfile);
		}else{
			$this->E(Dyhb::L('数据库连接配置文件 %s 不存在','App',null,$sConfigfile));
		}

		$this->assign('arrConfig',$arrConfig);

		$this->display('update+step3');
	}

	public function first(){
		global $hConn,$sSql4Tmp,$sDbprefix,$nMysqlVersion;

		$this->check_update();

		$arrConfig=(array)(include NEEDFORBUG_PATH.'/config/Config.inc.php');
		if(empty($arrConfig['RBAC_DATA_PREFIX'])){
			$this->E(Dyhb::L('Rbac前缀不能为空'));
		}

		if(empty($arrConfig['COOKIE_PREFIX'])){
			$this->E(Dyhb::L('Cookie前缀不能为空'));
		}

		if(!$hConn=@mysql_connect($arrConfig['DB_HOST'],$arrConfig['DB_USER'],$arrConfig['DB_PASSWORD'])){
			$this->E(Dyhb::L('数据库服务器或登录密码无效').",".Dyhb::L('无法连接数据库，请重新设定！'));
		}

		if(!mysql_select_db($arrConfig['DB_NAME'])){
			$this->E(Dyhb::L('选择数据库失败，可能是你没权限，请预先创建一个数据库！'));
		}

		$sRs=mysql_query("SELECT VERSION();",$hConn);
		$arrRow=mysql_fetch_array($sRs);
		$arrMysqlVersions=explode('.',trim($arrRow[0]));
		$nMysqlVersion=$arrMysqlVersions[0].".".$arrMysqlVersions[1];
		mysql_query("SET NAMES 'UTF8',character_set_client=binary,sql_mode='';",$hConn);

		// 前缀
		$sDbprefix=$arrConfig['DB_PREFIX'];
	
		// 防止乱码
		$sSql4Tmp='';
		if($nMysqlVersion>=4.1){
			$sSql4Tmp="ENGINE=MyISAM DEFAULT CHARSET=UTF8";
		}

		// 加载升级界面
		$this->assign('sUpdateTitle','数据库结构添加与更新');
		$this->display('update_message');

		// 开始执行数据库结构升级
		Install_Extend::showJavascriptMessage('<h3>'.'数据库结构添加与更新'.'</h3>');
		Install_Extend::runQuery(APP_PATH.'/Static/Sql/Update/needforbug.table.sql');

		exit();
		$this->assign('__MessageTitle__',Dyhb::L('添加新表成功，请勿关闭窗口，程序自动继续','update'));
		$this->assign('__JumpUrl__',G::U('update/second'));
		$this->assign('__WaitSecond__',3);
		$this->S($sMessage);
	}

}
