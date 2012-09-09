<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台登陆($)*/

!defined('DYHB_PATH') && exit;

// 导入社会化登录组件
Dyhb::import(NEEDFORBUG_PATH.'/source/extension/socialization');

class LoginController extends Controller{

	public function index(){
		if($GLOBALS['___login___']!==false){
			$this->assign('__JumpUrl__',__APP__);
			$this->E(Dyhb::L('你已经登录','Controller/Public'));
		}

		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
		$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);
		
		$this->display('public+login');
	}

	public function socia(){
		$sVendor=trim(G::getGpc('vendor','G'));

		$oSocia=Dyhb::instance('Socia',$sVendor);
		$oSocia->login();
		
		if($oSocia->isError()){
			$this->E($oSocia->getErrorMessage());
		}
	}

	public function callback(){
		$sVendor=trim(G::getGpc('vendor','G'));
		
		$oSocia=Dyhb::instance('Socia',$sVendor);
		$arrUser=$oSocia->callback();
		$oSocia->bind();
		
		if($oSocia->isError()){
			$this->E($oSocia->getErrorMessage());
		}
	}

	public function bind(){
		$arrUser=Socia::getUser();

		if(empty($arrUser)){
			$this->assign('__JumpUrl__',Dyhb::U('home://public/login'));
			$this->E(Dyhb::L('你尚未登录社会化帐号','Controller/Public'));
		}

		$this->assign('arrUser',$arrUser);
		$this->assign('sRandPassword',G::randString(10));

		$this->display('public+sociabind');
	}

	public function unbind(){
		$sVendor=trim(G::getGpc('vendor','G'));

		SociauserModel::M()->deleteWhere(array('sociauser_vendor'=>$sVendor,'user_id'=>$GLOBALS['___login___']['user_id']));

		$this->assign('__JumpUrl__',Dyhb::U('home://ucenter/index'));
		$this->S(Dyhb::L('帐号解除绑定成功','Controller/Public'));
	}

	public function bind_again(){
		$arrUser=Socia::getUser();

		if(empty($arrUser)){
			$this->E(Dyhb::L('你尚未登录社会化帐号','Controller/Public'));
		}

		$oSocia=Dyhb::instance('Socia',$arrUser['sociauser_vendor']);
		$oSocia->bind();
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
				$sUrl=Dyhb::U('home://ucenter/index');
			}

			$oLoginUser=UserModel::F('user_name=?',$sUserName)->getOne();
			Core_Extend::updateCreditByAction('daylogin',$oLoginUser['user_id']);

			// 如果第三方网站已登录，则进行绑定
			if(Socia::getUser()){
				// 绑定社会化登录数据，以便于下次直接调用
				$oSociauser=Dyhb::instance('SociauserModel');
				$oSociauser->processBind($oLoginUser['user_id']);

				if($oSociauser->isError()){
					$this->E($oSociauser->getErrorMessage());
				}
			}

			$this->A(array('url'=>$sUrl),Dyhb::L('Hello %s,你成功登录','Controller/Public',null,$sUserName),1);
		}
	}

	public function logout(){
		if(UserModel::M()->isLogin()){
			$arrUserData=$GLOBALS['___login___'];
			if(!isset($arrUserData['session_auth_key'])){
				$arrUserData['session_auth_key']='';
			}
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

}
