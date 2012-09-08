<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录入口($)*/

!defined('DYHB_PATH') && exit;

/** 导入社会化登录配置文件 */
require_once(NEEDFORBUG_PATH.'/source/extension/socialization/Config.inc.php');

class Socia{

	public static $_oConfig;
	private static $_oInstance=NULL;
	private $_sVendor;
	private $_oLocal;

	public function __construct($sVendor='',$sLocal='Socialocal'){
		self::getConfig();

		$this->setVendor($sVendor);

		$sLocal==''?$sLocal=self::$_oConfig->_local:'';
		$this->setLocal($sLocal);
	}

	static public function getConfig(){
		self::$_oConfig=Sociaconfig::getInstance();
	}

	static function getInstance($sVendor='',$sLocal=''){
		if(!self::$_oInstance){
			self::$_oInstance=new self($sVendor,$sLocal);
		}

		return self::$_oInstance;
	}

	public function setVendor($sVendor=''){
		if($sVendor){
			$this->_oVendor=new $sVendor();
		}
	}

	public function setLocal($sLocal=''){
		if($sLocal){
			$this->_oLocal=new $sLocal();
		}
	}
	
	static public function getUser(){
		$sSociaUsercookie=Dyhb::cookie('SOCIAUSER');
		return !empty($sSociaUsercookie)?$sSociaUsercookie:FALSE;
	}

	static public function setKeys($arrKeys){
		Dyhb::cookie('SOCIAKEYS',$arrKeys);
	}

	static public function getKeys(){
		$arrSociaKeys=Dyhb::cookie('SOCIAKEYS');
		return !empty($arrSociaKeys)?$arrSociaKeys:FALSE;
	}

	static public function clearCookie(){
		Dyhb::cookie('SOCIAUSER',null,-1);
		Dyhb::cookie('SOCIAKEYS',null,-1);
	}

	public function getBinded($nUserid){
		$arrBindeds=$this->_oLocal->getBinded($nUserid);

		$arrResult=array();
		$nI=0;
		$arrSites=self::$_oConfig->KEYID;
		if(is_array($arrSites)){
			foreach($arrSites as $sName=>$sSite){
				$sClass='Vendor'.$sName;
				$arrResult[$nI]=array('site'=>$sClass::$_sSite,'name'=>$sClass::$_sName,'vendor'=>'Vendor'.$sName,'socia_user'=>'');

				if(is_array($arrBindeds)){
					foreach($arrBindeds as $oBind){
						if($oBind['sociauser_vendor']=='Vendor'.$sName){
							$arrResult[$nI]['socia_user']=$oBind['sociauser_screenname'];
							break;
						}
					}
				}

				$nI++;
			}
		}

		return $arrResult;
	}

	public function login($sVendor=''){
		return $this->gotoLoginPage();
	}

	public function gotoLoginPage(){
		self::clearCookie();
		return $this->_oVendor->gotoLoginPage();
	}

}
