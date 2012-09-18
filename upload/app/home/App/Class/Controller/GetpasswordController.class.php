<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台找回密码控制器($)*/

!defined('DYHB_PATH') && exit;

class GetpasswordController extends InitController{

	public function index(){
		if(UserModel::M()->isLogin()){
			$this->U('home://spaceadmin/password');
		}
	
		$this->display('getpassword+index');
	}

	public function index_title_(){
		return '找回密码';
	}

	public function index_keywords_(){
		return $this->index_title_();
	}

	public function index_description_(){
		return $this->index_title_();
	}

	public function email(){
		if(UserModel::M()->isLogin()){
			$this->U('home://spaceadmin/password');
		}
		$this->check_seccode(true);

		$sEmail=trim(G::getGpc('user_email','P'));
		if(empty($sEmail)){
			$this->E(Dyhb::L('Email地址不能为空','Controller/Getpassword'));
		}

		Check::RUN();
		if(!Check::C($sEmail,'email')){
			$this->E(Dyhb::L('Email格式不正确','Controller/Getpassword'));
		}

		$oUser=UserModel::F('user_email=?',$sEmail)->getOne();
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Getpassword'));
		}
		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Getpassword'));
		}

		$sTemppassword=md5(G::randString(32));
		$oUser->user_temppassword=$sTemppassword;
		$oUser->save(0,'update');
		if($oUser->isError()){
			$this->E($oUser->getErrorMessage());
		}
		
		$sGetPasswordUrl=$GLOBALS['_option_']['site_url'].'/index.php?c=getpassword&a=reset&email='.urlencode($sEmail).'&hash='.urlencode(G::authcode($sTemppassword,false,null,$GLOBALS['_option_']['getpassword_expired']));

		$oMailModel=Dyhb::instance('MailModel');
		$oMailConnect=$oMailModel->getMailConnect();

		$sEmailSubject=$GLOBALS['_option_']['site_name'].Dyhb::L('会员密码找回','Controller/Getpassword');
		$sNlbr=$oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
		$sEmailContent=Dyhb::L('你的登录信息','Controller/Getpassword').':'.$sNlbr;
		$sEmailContent.='Email:'.$sEmail.$sNlbr;
		$sEmailContent.=Dyhb::L('重置密码链接','Controller/Getpassword').':'.$sNlbr;
		$sEmailContent.="<a href=\"{$sGetPasswordUrl}\">{$sGetPasswordUrl}</a>".$sNlbr.$sNlbr;
		$sEmailContent.="-----------------------------------------------------".$sNlbr;
		$sEmailContent.=Dyhb::L('这是系统用于找回密码的邮件，请勿回复','Controller/Getpassword').$sNlbr;
		$sEmailContent.=Dyhb::L('链接过期时间','Controller/Getpassword').':'.$GLOBALS['_option_']['getpassword_expired'].Dyhb::L('秒','__COMMON_LANG__@Common').$sNlbr;

		$oMailConnect->setEmailTo($sEmail);
		$oMailConnect->setEmailSubject($sEmailSubject);
		$oMailConnect->setEmailMessage($sEmailContent);
		$oMailConnect->send();
		if($oMailConnect->isError()){
			$this->E($oMailConnect->getErrorMessage());
		}

		$this->S(Dyhb::L('邮件已发送到你指定的邮箱','Controller/Getpassword'));
	}

	public function reset(){
		if(UserModel::M()->isLogin()){
			$this->U('home://spaceadmin/password');
		}
		$sEmail=trim(G::getGpc('email','G'));
		$sHash=trim(G::getGpc('hash','G'));
		$nAppeal=intval(G::getGpc('appeal','G'));

		if(empty($sHash)){
			$this->U('home://getpassword/index');
		}

		$sHash=G::authcode($sHash);

		if(empty($sHash)){
			$this->assign('__JumpUrl__',Dyhb::U('home://getpassword/index'));
			$this->E(Dyhb::L('找回密码链接已过期','Controller/Getpassword'));
		}
		
		if($nAppeal==1){
			$oUser=UserModel::F('user_temppassword=?',$sHash)->getOne();
		}else{
			$oUser=UserModel::F('user_email=? AND user_temppassword=?',$sEmail,$sHash)->getOne();
		}
		
		if(empty($oUser->user_id)){
			$this->assign('__JumpUrl__',Dyhb::U('home://getpassword/index'));
			$this->E(Dyhb::L('找回密码链接已过期','Controller/Getpassword'));
		}

		$this->assign('sEmail',$sEmail);
		$this->assign('nAppeal',$nAppeal);
		$this->assign('user_id',$oUser->user_id);

		$this->display('getpassword+reset');
	}

	public function reset_title_(){
		return '密码重置';
	}

	public function reset_keywords_(){
		return $this->reset_title_();
	}

	public function reset_description_(){
		return $this->reset_title_();
	}

	public function change_pass(){
		$this->check_seccode(true);

		$sPassword=trim(G::getGpc('user_password','P'));
		$sNewPassword=trim(G::getGpc('new_password','P'));
		$sEmail=trim(G::getGpc('user_email','P'));
		$nAppeal=intval(G::getGpc('appeal','P'));
		$nUserId=intval(G::getGpc('user_id','P'));
		
		if(!empty($nUserId)&&$nAppeal==1){
			$oUser=UserModel::F('user_id=?',$nUserId)->getOne();
		}else{
			$oUser=UserModel::F('user_email=?',$sEmail)->getOne();
		}

		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Getpassword'));
		}
		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Getpassword'));
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

			$this->S(Dyhb::L('密码修改成功，你需要重新登录','Controller/Getpassword'));
		}
	}

}
