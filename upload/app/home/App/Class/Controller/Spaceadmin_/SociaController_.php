<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化帐号管理($)*/

!defined('DYHB_PATH') && exit;

class SociaController extends Controller{

	public function index(){
		Socia::clearCookie();

		Dyhb::import(NEEDFORBUG_PATH.'/');

		$this->display('spaceadmin+socia');
	}

}
