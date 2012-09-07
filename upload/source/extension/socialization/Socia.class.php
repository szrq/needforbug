<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录入口($)*/

!defined('DYHB_PATH') && exit;

class Socia{
	
	static public function getUser(){
		$sSociaUsercookie=Dyhb::cookie('SOCIAUSER');
		return !empty($sSociaUsercookie)?$sSociaUsercookie:FALSE;
	}

	static public function getKeys(){
		$sSociaKeys=Dyhb::cookie('SOCIAKEYS');
		return !empty($sSociaKeys)?$sSociaKeys:FALSE;
	}

	static public function clearCookie(){
		Dyhb::cookie('SOCIAUSER',null,-1);
		Dyhb::cookie('SOCIAKEYS',null,-1);
	}

}
