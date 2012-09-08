<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台登陆($)*/

!defined('DYHB_PATH') && exit;

// 导入社会化登录组件
Dyhb::import(NEEDFORBUG_PATH.'/source/extension/socialization');

// 申请到的appid
$arrData["appid"]='100303001';

// 申请到的appkey
$arrData["appkey"]="2c8a05c6c7930f7bd0d481a8462c7db0";

// QQ登录成功后跳转的地址,请确保地址真实可用，否则会导致登录失败。
$arrData["callback"]="http://bbs.doyouhaobaby.net/index.php?app=home&c=public&a=socia_callback&type=qq";

// QQ授权api接口.按需调用
$arrData["scope"]="get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo";

$GLOBALS['socia']['qq']=$arrData;

class LoginController extends Controller{

	public function index(){
		if($GLOBALS['___login___']!==false){
			$this->assign('__JumpUrl__',__APP__);
			$this->E(Dyhb::L('你已经登录','Controller/Public'));
		}

		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_login_status']);
		$this->assign('nRememberTime',$GLOBALS['_option_']['remember_time']);
		
		//$oVendorQq=new VendorQq();
		//$arrSociaUserinfo=$oVendorQq->getUserInfo();
		//G::dump($arrSociaUserinfo);
  $arrData["ret"]=0;
  $arrData["msg"]="";
  $arrData["nickname"]="小牛哥Dyhb";
  $arrData["figureurl"]="http://qzapp.qlogo.cn/qzapp/100303001/A3A62D6B7CFB589E2D76D2E2EE787273/30";
  $arrData ["figureurl_1"]="http://qzapp.qlogo.cn/qzapp/100303001/A3A62D6B7CFB589E2D76D2E2EE787273/50";
  $arrData["figureurl_2"]="http://qzapp.qlogo.cn/qzapp/100303001/A3A62D6B7CFB589E2D76D2E2EE787273/100";
  $arrData["gender"]="男";
  $arrData["vip"]="0";
  $arrData["level"]="0";

//G::dump( $arrData);

$oSociaModel=Dyhb::instance('SociauserModel');
$oSociaModel->bind();

		$this->display('public+login');
	}

	public function socia(){
		$oVendorQq=new VendorQq();
		$oVendorQq->login($GLOBALS['socia']['qq']['appid'],$GLOBALS['socia']['qq']['appkey'],$GLOBALS['socia']['qq']['callback']);
	}

	public function callback(){
		$oVendorQq=new VendorQq();
		$oVendorQq->callback();
		$oVendorQq->getOpenid();
		//echo "<script>window.close();</script>";
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
