<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录处理($)*/

!defined('DYHB_PATH') && exit;

class SociaVendor{

	static public $_sSite;
	static public $_sName;
	static public $_sLogo;
	static $_sMinitheme="<a class=\"socia_mini_bars socia_mini_{vendor}\" href=\"javascript:sociaWin=sociaWinopen('{url}{vendor}','sociaWin','900','550')\" title=\"用{name}帐号登录\"></a>";
	static $_sTheme="<a class=\"socia_{vendor}\" href=\"javascript:sociaWin=sociaWinOpen('{url}{vendor}','sociaWin','900','550')\"> </a>";
	protected $_oConfig;
	public $_sAppid;
	public $_sSecid;
	public $_sCallback;
	public $error;

	public function __construct($sVender){
		$this->_oConfig=Sociaconfig::getInstance();

		// get KEYID from config
		$this->_sAppid=Sociaconfig::getKeys('KEYID',$sVender);
		if(!$this->_aAppid){
			Dyhb::E($sVender.' KEYID NOT EXISTS');
		}

		// get SECID from config
		$this->_sSecid=sociaconfig::getKeys('SECID',$sVender);
		if(!$this->_sSecid){
			Dyhb::E($sVender.' SECID NOT EXISTS');
		}

		// get CallBack from config
		$this->_sCallback=($this->_oConfig->CallBack.$sVender);
		if(!$this->_sAppid || !$this->_sSecid){
			Dyhb::E($sVender.' KEYID OR SECID NOT EXISTS');
		}
	}

	public static function getLogo($sVender){
		$sLogo=Sociaconfig::getKeys('LOGO',$sVender);
		return $sLogo;
	}
	
	public static function getBar($sTheme='theme',$sUrl='',$sVendor='',$sName=''){
		if(empty($sTheme)){
			$sTheme='theme';
		}else{
			$sTheme='';
		}

		$sTheme='_s'.ucfirst($sTheme);
		$sStr=static::$$sTheme;

		$sVendor==''?$sVendor=static::$_sSite:'';
		$sName==''?$sName=static::$sName:'';

		if(empty($sUrl)){
			$sUrl=Sociaconfig::getInstance()->LoginUrl;
		}

		$sLogo=self::getLogo($sVendor);

		return str_replace(array('{url}','{vendor}','{logo}','{name}'),array($sUrl,$sVendor,$sLogo,$sName),$sStr);
	}

	public function login($arrArgs=array()){
		$sKey=$this->getAccessToken($arrArgs);
		return $this->showUser($sKey);
	}
	
	public function getRequestToken(){}

	public function getAccessToken($args=array()){}

	public function gotoLoginPage(){}

	public function logout(){}

	public static function openidredirect(){
		$sQuery=str_replace('dltact=login','dltact=callback',$_SERVER['QUERY_STRING']);
		header('Location: ?'.$sQuery);
	}

}
