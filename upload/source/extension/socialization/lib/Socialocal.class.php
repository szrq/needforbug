<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录数据本地化($)*/

!defined('DYHB_PATH') && exit;

class Socialocal{

	private $dlt_user;

	public function __construct(){}

	public function localLogout(){}

	public function checkLogin(){
		return $GLOBALS['___login___'];
	}

	public function localLogin($nUserid){
		return true;
	}
	
	public function checkBinded(){
		$arrUser=Socia::getUser();

		$oSociauser=SociauserModel::F('sociauser_userid=? AND sociauser_vendor=?',$arrUser['id'],$arrUser['vendor'])->getOne();

		return !empty($oSociauser['sociauser_id'])?$oSociauser['user_id']:FALSE;
	}
	
	public function bind(){
		$arrUser=$this->checkLogin();
		$nUserid=$this->checkBinded();

		if($nUserid){
			if($this->localLogin($nUserid)){
				$this->success();
			}else{
				$this->error();
			}
		}else{
			if($arrUser){
				$this->processBind($arrUser);
			}else{
				$this->gotoLogin();
			}
		}
	}
	
	public function processBind($nUserid){
		if(!$nUserid){
			return FALSE;
		}

		$arrUser=Socia::getUser();
		$arrUser['sociauser_userid']=$arrUser['id'];
		unset($arrUser['id']);

		$arrUser['user_id']=$nUserid;
		$arrUser['socialuser_keys']=serialize(Socia::getKeys());
		$arrUser['socialuser_name']=trim($arrUser['name']);
		$arrUser['socialuser_screenname']=trim($arrUser['screen_name']);
		$arrUser['socialuser_desc']=trim($arrUser['desc']);

		$oSociauser=new SociauserModel($arrUser);
		$oSociauser->save(0);

		if($oSociauser->isError()){
			exit($oSociauser->getErrorMessage());
		}

		if(!empty($oSociauser['sociauser_id'])){
			Socia::clearCookie();
		}else{
			exit('绑定失败');
		}
	}
	
	public function updateBind(){}
	
	public function gotoRegister(){}

	public function gotoLogin(){}
	
	public function success(){
		exit('登录成功');
	}
	
	public function error(){
		exit('登录失败');
	}
	
	public function getBinded($nUserid,$sVendor=''){
		$oSocaiuser=SociauserModel::F('user_id=?'.($sVendor?" AND sociauser_vendor={$sVendor}":''),$nUserid)->getOne();
		return $oSociauser;
	}

	public function unbind($nUserid='',$sVendor=''){
		if(empty($nUserid)){
			$nUserid=$GLOBALS['___login___']['user_id'];
		}else{
			$nUserid='';	
		}

		if(empty($nUserid)){
			return FALSE;
		}

		SociauserModel::M()->deleteWhere('user_id=?'.($sVendor?" AND sociauser_vendor={$sVendor}":''),$nUserid);
	}
	
}
