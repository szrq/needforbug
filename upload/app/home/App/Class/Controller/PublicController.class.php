<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台首页显示($)*/

!defined('DYHB_PATH') && exit;

class PublicController extends InitController{

	public function index(){
		Core_Extend::loadCache('slide');
		Core_Extend::loadCache('link');
		$sLogo=$GLOBALS['_option_']['site_logo']?$GLOBALS['_option_']['site_logo']:__PUBLIC__.'/images/common/logo.png';
		
		$this->assign('arrSlides',$GLOBALS['_cache_']['slide']);
		$this->assign('arrLinkDatas',$GLOBALS['_cache_']['link']);
		$this->assign('sHomeDescription',Core_Extend::replaceSiteVar($GLOBALS['_option_']['home_description']));
		$this->assign('sLogo',$sLogo);
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
		$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);

		$this->display('public+index');
	}
	
	public function login(){
		if($GLOBALS['___login___']!==false){
			$this->assign('__JumpUrl__',__APP__);
			$this->E(Dyhb::L('你已经登录','Controller/Public'));
		}

		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
		$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);
		
		$this->display('public+login');
	}
	
	public function register(){
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

	public function seccode(){
		Core_Extend::seccode();
	}

	public function check_seccode($bSubmit=false){
		$sSeccode=G::getGpc('seccode');
		$bResult=G::checkSeccode($sSeccode);

		if(!$bResult){
			$this->E(Dyhb::L('你输入的验证码错误','Controller/Public'));
		}

		if($bSubmit===false){
			$this->S(Dyhb::L('验证码正确','Controller/Public'));
		}
	}

	public function check_login(){
		if($GLOBALS['_option_']['seccode_login_status']==1){
			$this->check_seccode(true);
		}

		$sUserName=G::getGpc('user_name','P');
		$sPassword=G::getGpc('user_password','P');

		if(empty($sUserName)){
			$this->E(Dyhb::L('帐号或者E-mail不能为空','Controller/Public'));
		}elseif(empty($sPassword)){
			$this->E(Dyhb::L('密码不能为空','Controller/Public'));
		}

		Check::RUN();
		if(Check::C($sUserName,'email')){
			$bEmail=true;
			unset($_POST['user_name']);
		}else{
			$bEmail=false;
		}

		$oUserModel=Dyhb::instance('UserModel');
		$oUserModel->checkLogin($sUserName,$sPassword,$bEmail,'admin');
		if($oUserModel->isError()){
			$this->E($oUserModel->getErrorMessage());
		}else{
			if(Dyhb::cookie('needforbug_referer')){
				$sUrl=Dyhb::cookie('needforbug_referer');
				Dyhb::cookie('needforbug_referer','',-1);
			}else{
				$sUrl=Dyhb::U('home://user/index');
			}

			$oLoginUser=UserModel::F('user_name=?',$sUserName)->getOne();
			Core_Extend::updateCreditByAction('daylogin',$oLoginUser['user_id']);

			$this->A(array('url'=>$sUrl),Dyhb::L('Hello %s,你成功登录','Controller/Public',null,$sUserName),1);
		}
	}
	
	public function get_password(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/password');
		}
	
		$this->display('public+getpassword');
	}

	public function password_email(){
		$this->check_seccode(true);

		$sEmail=trim(G::getGpc('user_email','P'));
		if(empty($sEmail)){
			$this->E(Dyhb::L('Email地址不能为空','Controller/Public'));
		}

		Check::RUN();
		if(!Check::C($sEmail,'email')){
			$this->E(Dyhb::L('Email格式不正确','Controller/Public'));
		}

		$oUser=UserModel::F('user_email=?',$sEmail)->getOne();
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Public'));
		}
		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Public'));
		}

		$sTemppassword=md5(G::randString(32));
		$oUser->user_temppassword=$sTemppassword;
		$oUser->save(0,'update');
		if($oUser->isError()){
			$this->E($oUser->getErrorMessage());
		}

		$sGetPasswordUrl=Dyhb::U('home://public/reset_password?email='.urlencode($sEmail).'&hash='.urlencode(str_replace('/',md5('/'),G::authcode($sTemppassword,false,null,3600))));

		$oMailModel=Dyhb::instance('MailModel');
		$oMailConnect=$oMailModel->getMailConnect();

		$sEmailSubject=$GLOBALS['_option_']['site_name'].Dyhb::L('会员密码找回','Controller/Public');
		$sNlbr=$oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
		$sEmailContent=Dyhb::L('你的登录信息','Controller/Public').':'.$sNlbr;
		$sEmailContent.='Email:'.$sEmail.$sNlbr;
		$sEmailContent.=Dyhb::L('重置密码链接','Controller/Public').':'.$sNlbr;
		$sEmailContent.="<a href=\"{$sGetPasswordUrl}\">{$sGetPasswordUrl}</a>";

		$oMailConnect->setEmailTo($sEmail);
		$oMailConnect->setEmailSubject($sEmailSubject);
		$oMailConnect->setEmailMessage($sEmailContent);
		$oMailConnect->send();
		if($oMailConnect->isError()){
			$this->E($oMailConnect->getErrorMessage());
		}

		$this->S(Dyhb::L('邮件已发送到你指定的邮箱','Controller/Public'));
	}

	public function reset_password(){
		$sEmail=trim(G::getGpc('email','G'));
		$sHash=trim(G::getGpc('hash','G'));

		if(empty($sHash)){
			$this->U('home://public/get_password');
		}
		$sHash=str_replace(md5('/'),'/',$sHash);
		$sHash=G::authcode($sHash);
		if(empty($sHash)){
			$this->assign('__JumpUrl__',Dyhb::U('home://public/get_password'));
			$this->E(Dyhb::L('找回密码链接已过期','Controller/Public'));
		}

		$oUser=UserModel::F('user_email=? AND user_temppassword=?',$sEmail,$sHash)->getOne();
		if(empty($oUser->user_id)){
			$this->assign('__JumpUrl__',Dyhb::U('home://public/get_password'));
			$this->E(Dyhb::L('找回密码链接已过期','Controller/Public'));
		}

		$this->assign('sEmail',$sEmail);

		$this->display('public+resetpassword');
	}

	public function change_pass(){
		$this->check_seccode(true);

		$sPassword=trim(G::getGpc('user_password','P'));
		$sNewPassword=trim(G::getGpc('new_password','P'));
		$sEmail=trim(G::getGpc('user_email','P'));
		
		$oUser=UserModel::F('user_email=?',$sEmail)->getOne();
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Public'));
		}
		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Public'));
		}

		$oUserModel=Dyhb::instance('UserModel');
		$oUserModel->changePassword($sPassword,$sNewPassword,'',true,$oUser->toArray(),true);
		if($oUserModel->isError()){
			$this->E($oUserModel->getErrorMessage());
		}else{
			$oUser->user_temppassword='';
			$oUser->save(0,'update');
			if($oUser->isError()){
				$this->E($oUser->getErrorMessage());
			}

			$this->S(Dyhb::L('密码修改成功，你需要重新登录','Controller/Public'));
		}
	}

	public function logout(){
		if(UserModel::M()->isLogin()){
			$arrUserData=$GLOBALS['___login___'];
			UserModel::M()->replaceSession($arrUserData['session_hash'],$arrUserData['user_id'],$arrUserData['session_auth_key']);
			UserModel::M()->logout();

			$GLOBALS['___login___']=false;
	
			$this->assign("__JumpUrl__",Dyhb::U('home://public/login'));
			$this->S(Dyhb::L('登出成功','Controller/Public'));
		}else{
			$this->E(Dyhb::L('已经登出','Controller/Public'));
		}
	}

	public function clear(){
		UserModel::M()->clearThisCookie();
		$this->S(Dyhb::L('清理登录痕迹成功','Controller/Public'));
	}

	public function site_($sName){
		$oHomesite=HomesiteModel::F("homesite_name='{$sName}'")->getOne();
		$this->assign('sContent',Core_Extend::replaceSiteVar($oHomesite['homesite_content']));
		$this->assign('sTitle',$oHomesite['homesite_nikename']);
		
		$arrHomesites=HomesiteModel::F()->getAll();
		$this->assign('arrHomesites',$arrHomesites);

		$this->display('public+site');
	}
	
	public function site(){
		$sName=G::text(G::getGpc('id','G'));
		
		$this->site_($sName);
	}
	
	public function aboutus(){
		$this->site_('aboutus');
	}

	public function contactus(){
		$this->site_('contactus');
	}

	public function agreement(){
		$this->site_('agreement');
	}

	public function privacy(){
		$this->site_('privacy');
	}

	public function help(){
		$arrWhere=array();
		
		$nId=intval(G::getGpc('cid','G'));
		if(empty($nId)){
			$nId=0;
		}else{
			$arrWhere['homehelpcategory_id']=$nId;
		}

		Core_Extend::loadCache('home_option');
		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		$arrWhere['homehelp_status']=1;
		$nTotalRecord=HomehelpModel::F()->where($arrWhere)->all()->getCounts();

		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homehelp_list_num'],G::getGpc('page','G'));

		$arrHomehelps=HomehelpModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['homehelp_list_num'])->getAll();
		$this->assign('arrHomehelps',$arrHomehelps);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nCid',$nId);

		$this->homehelpcategory_();

		$this->display('public+helplist');
	}

	public function show_help(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E(Dyhb::L('你没有指定帮助ID','Controller/Public'));
		}

		$oHomehelp=HomehelpModel::F('homehelp_id=?',$nId)->getOne();
		if(!empty($oHomehelp['homehelp_id'])){
			$this->assign('oHomehelp',$oHomehelp);
			$this->assign('sContent',Core_Extend::replaceSiteVar($oHomehelp['homehelp_content']));

			$this->homehelpcategory_();

			// 更新点击量
			$oHomehelp->homehelp_viewnum=$oHomehelp->homehelp_viewnum+1;
			$oHomehelp->setAutofill(false);
			$oHomehelp->save(0,'update');

			if($oHomehelp->isError()){
				$this->E($oHomehelp->getErrorMessage());
			}
			
			$this->display('public+showhelp');
		}else{
			$this->E(Dyhb::L('你指定的帮助不存在','Controller/Public'));
		}
	}

	public function homehelpcategory_(){
		$oHomehelpcategory=Dyhb::instance('HomehelpcategoryModel');

		$arrHomehelpcategorys=$oHomehelpcategory->getHomehelpcategory();
		$this->assign('arrHomehelpcategorys',$arrHomehelpcategorys);
	}

	protected function cache_site_(){
		if(!Dyhb::classExists('Cache_Extend')){
			require_once(Core_Extend::includeFile('function/Cache_Extend'));
		}
		Cache_Extend::updateCacheSite();
	}

}
