<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台用户注册($)*/

!defined('DYHB_PATH') && exit;

class RegisterController extends Controller{

	public function index(){
		if($GLOBALS['___login___']!==false){
			$this->assign('__JumpUrl__',__APP__);
			$this->E(Dyhb::L('你已经登录','Controller/Public'));
		}
		
		if($GLOBALS['_option_']['disallowed_register']){
			$this->E(Dyhb::L('系统关闭了用户注册','Controller/Public'));
		}

		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_register_status']);

		$this->display('public+register');
	}
	
	public function check_user(){
		$sUserName=trim(strtolower(G::getGpc('user_name')));
		
		$oUser=Dyhb::instance('UserModel');
		if($oUser->isUsernameExists($sUserName)===true){
			echo 'false';
		}else{
			echo 'true';
		}
	}
	
	public function check_email(){
		$sUserEmail=trim(strtolower(G::getGpc('user_email')));
		
		$oUser=Dyhb::instance('UserModel');
		if(!empty($sUserEmail) && $oUser->isUseremailExists($sUserEmail)===true){
			echo 'false';
		}else{
			echo 'true';
		}
	}
	
	public function register_user(){
		if($GLOBALS['___login___']!==false){
			$this->E(Dyhb::L('你已经登录会员,不能重复注册','Controller/Public'));
		}
		
		if($GLOBALS['_option_']['disallowed_register']){
			$this->E(Dyhb::L('系统关闭了用户注册','Controller/Public'));
		}
		
		if($GLOBALS['_option_']['seccode_register_status']==1){
			$this->check_seccode(true);
		}
		
		$sPassword=trim(G::getGpc('user_password','P'));
		if(!$sPassword || $sPassword !=G::addslashes($sPassword)){
			$this->E(Dyhb::L('密码空或包含非法字符','Controller/Public'));
		}
		if(strpos($sPassword,"\n")!==false || strpos($sPassword,"\r")!==false || strpos($sPassword,"\t")!==false){
			$this->E(Dyhb::L('密码包含不可接受字符','Controller/Public'));
		}
		
		$sUsername=trim(G::getGpc('user_name','P'));
		$sDisallowedRegisterUser=trim($GLOBALS['_option_']['disallowed_register_user']);
		$sDisallowedRegisterUser='/^('.str_replace(array('\\*',"\r\n",' '),array('.*','|',''),preg_quote(($sDisallowedRegisterUser=trim($sDisallowedRegisterUser)),'/')).')$/i';
		if($sDisallowedRegisterUser && @preg_match($sDisallowedRegisterUser,$sUsername)){
			$this->E(Dyhb::L('用户名包含被系统屏蔽的字符','Controller/Public'));
		}
		
		$arrNameKeys=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','$','(',')','%','@','+','?',';','^');
		foreach($arrNameKeys as $sNameKeys){
			if(strpos($sUsername,$sNameKeys)!==false){
				$this->E(Dyhb::L('此用户名包含不可接受字符或被管理员屏蔽,请选择其它用户名','Controller/Public'));
			}
		}
		
		$sUseremail=trim(G::getGpc('user_email','P'));
		$sDisallowedRegisterEmail=trim($GLOBALS['_option_']['disallowed_register_email']);
		if($sDisallowedRegisterEmail){
			$arrDisallowedRegisterEmail=explode("\n",$sDisallowedRegisterEmail);
			$arrDisallowedRegisterEmail=Dyhb::normalize($arrDisallowedRegisterEmail);
			if(in_array($sUseremail,$arrDisallowedRegisterEmail)){
				$this->E(Dyhb::L('你注册的邮件地址%s已经被官方屏蔽','Controller/Public',null,$sUseremail));
			}
		}
		
		$sAllowedRegisterEmail=trim($GLOBALS['_option_']['disallowed_register_email']);
		if($sAllowedRegisterEmail){
			$arrAllowedRegisterEmail=explode("\n",$sAllowedRegisterEmail);
			$arrAllowedRegisterEmail=Dyhb::normalize($arrAllowedRegisterEmail);
			if(!in_array($sUseremail,$arrAllowedRegisterEmail)){
				$this->E(Dyhb::L('你注册的邮件地址%s不在系统允许的邮件之列','Controller/Public',null,$sUseremail));
			}
		}
		
		$oUser=new UserModel();
		if($GLOBALS['_option_']['audit_register']==0){
			$oUser->user_status=1;
		}
		
		$oUser->save(0);
		if($oUser->isError()){
			$this->E($oUser->getErrorMessage());
		}else{
			$oUserprofile=new UserprofileModel();
			$oUserprofile->user_id=$oUser->user_id;
			$oUserprofile->save(0);

			$oUserCount=new UsercountModel();
			$oUserCount->user_id=$oUser->user_id;
			$oUserCount->save(0);

			$this->cache_site_();

			$this->A($oUser->toArray(),Dyhb::L('注册成功','Controller/Public'),1);
		}
	}

	protected function cache_site_(){
		if(!Dyhb::classExists('Cache_Extend')){
			require_once(Core_Extend::includeFile('function/Cache_Extend'));
		}
		Cache_Extend::updateCacheSite();
	}

}