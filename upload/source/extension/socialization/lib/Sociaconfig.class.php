<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录数据配置($)*/

!defined('DYHB_PATH') && exit;

class Sociaconfig{

	private static $_oInstance=NULL;
	private $_arrProp=array();

	private function __construct(){}
	
	private function __clone(){}
	
	static function getInstance(){
		if(!self::$_oInstance){
			self::$_oInstance=new self();
		}

		return self::$_oInstance;
	}
	
	public function __set($sName,$sValue){
		$this->_arrProp[$sName]=$sValue;
	}

	public function __get($sName){
		return !empty($this->_arrProp[$sName])?$this->_arrProp[$sName]:NULL;
	}

	public function getAll(){
		return $this->_arrProp;
	}

	public static function getKeys($sType,$sName,$bDefault=FALSE){
		$arrValues=self::getInstance()->$_arrType;

		if($arrValues && !empty($arrValues[$sName])){
			return $arrValues[$sName];
		}

		return $bDefault;
	}

}
