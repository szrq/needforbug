<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   用户申诉控制器($)*/

!defined('DYHB_PATH') && exit;

class UserappealController extends InitController{

	public function index(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}

		$this->display('userappeal+index');
	}

	public function get_progress(){
		if(ACTION_NAME==='index'){
			return 25;
		}elseif(ACTION_NAME==='step2'){
			return 50;
		}elseif(ACTION_NAME==='step3'){
			return 75;
		}elseif(ACTION_NAME==='step4'){
			return 100;
		}

		return 0;
	}

	public function step2(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}

		$this->check_seccode(true);
	
		$sUsername=trim(G::getGpc('user_name','P'));
		if(Core_Extend::isPostInt($sUsername)){
			$oUser=UserModel::F('user_id=?',$sUsername)->getOne();
		}else{
			$oUser=UserModel::F('user_name=?',$sUsername)->getOne();
		}
		
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('用户名或者用户ID不存在','Controller/Userappeal'));
		}

		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Userappeal'));
		}

		$sUserid=G::authcode($oUser['user_id'],false,null,$GLOBALS['_option_']['getpassword_expired']);
		$this->assign('sUserid',$sUserid);

		$this->display('userappeal+step2');
	}

	public function step3(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}

		$this->check_seccode(true);
		
		$sRealname=trim(G::getGpc('real_name','P'));
		$sAddress=trim(G::getGpc('address','P'));
		$sIdnumber=trim(G::getGpc('id_number','P'));
		$sAppealemail=trim(G::getGpc('appeal_email','P'));
		$sUserid=trim(G::getGpc('user_id','P'));

		if(empty($sRealname)){
			$this->E(Dyhb::L('真实姓名不能为空','Controller/Userappeal'));
		}

		if(empty($sAppealemail)){
			$this->E(Dyhb::L('申诉结果接收邮箱不能为','Controller/Userappeal'));
		}	
		
		Check::RUN();
		if(!Check::C($sAppealemail,'email')){
			$this->E(Dyhb::L('Email格式不正确','Controller/Userappeal'));
		}
		
		$sUserid=G::authcode($sUserid);
		if(empty($sUserid)){
			$this->E(Dyhb::L('页面已过期','Controller/Userappeal'));
		}

		$oUser=UserModel::F('user_email=? AND user_id!=?',$sAppealemail,$sUserid)->getOne();
		if(!empty($oUser->user_id)){
			$this->E(Dyhb::L('该邮箱已经存在','Controller/Userappeal'));
		}

		$oUser=UserModel::F('user_id=?',$sUserid)->getOne();
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Userappeal'));
		}

		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Userappeal'));
		}
		
		$sHashcode=G::randString(32);
		$sUserid=G::authcode($oUser['user_id'],false,null,$GLOBALS['_option_']['getpassword_expired']);

		$sGetPasswordUrl=$GLOBALS['_option_']['site_url'].'/index.php?c=userappeal&a=step4&user_id='.
			urlencode($sUserid).'&real_name='.urlencode($sRealname).'&address='.urlencode($sAddress).'&id_number='.urlencode($sIdnumber).'&appeal_email='.urlencode($sAppealemail).'&emaillink=1';

		$oMailModel=Dyhb::instance('MailModel');
		$oMailConnect=$oMailModel->getMailConnect();

		$sEmailSubject=$GLOBALS['_option_']['site_name'].Dyhb::L('会员申诉验证码','Controller/Userappeal');
		$sNlbr=$oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
		$sEmailContent='<b>'.Dyhb::L('尊敬的用户','Controller/Userappeal').':</b>'.$sNlbr;
		$sEmailContent.='-----------------------------------------------------'.$sNlbr;
		$sEmailContent.=Dyhb::L('你的登录信息','Controller/Userappeal').':';
		$sEmailContent.=Dyhb::L('用户ID','Controller/Userappeal').'('.$oUser->user_id.')'.$sNlbr;
		$sEmailContent.=Dyhb::L('本次申诉验证码','Controller/Userappeal').':<span style="color:red;font-weight:bold;">'.$sHashcode.'</span>'.$sNlbr;
		$sEmailContent.=Dyhb::L('如果你关闭了申诉页面，你也可以点击下面的链接','Controller/Userappeal').Dyhb::L('申诉链接','Controller/Userappeal').$sNlbr;
		$sEmailContent.="<a href=\"{$sGetPasswordUrl}\">{$sGetPasswordUrl}</a>".$sNlbr.$sNlbr;
		$sEmailContent.="-----------------------------------------------------".$sNlbr;
		$sEmailContent.=Dyhb::L('这是系统用于发送申诉验证码的邮件，请勿回复','Controller/Userappeal').$sNlbr;
		$sEmailContent.=Dyhb::L('申诉验证码过期时间','Controller/Userappeal').':'.$GLOBALS['_option_']['getpassword_expired'].Dyhb::L('秒','__COMMON_LANG__@Common').$sNlbr;
		
		$oMailConnect->setEmailTo($sAppealemail);
		$oMailConnect->setEmailSubject($sEmailSubject);
		$oMailConnect->setEmailMessage($sEmailContent);
		$oMailConnect->send();
		if($oMailConnect->isError()){
			$this->E($oMailConnect->getErrorMessage());
		}
		
		$sUserid=G::authcode($oUser['user_id'],false,null,$GLOBALS['_option_']['getpassword_expired']);
		$sHashcode=G::authcode($sHashcode,false,null,$GLOBALS['_option_']['getpassword_expired']);

		$arrAppealemail=explode('@',$sAppealemail);
		$sAppealemailsite="http://".$arrAppealemail[1];

		$this->assign('sUserid',$sUserid);
		$this->assign('sHashcode',$sHashcode);
		$this->assign('sAppealemailsite',$sAppealemailsite);
		$this->assign('sRealname',$sRealname);
		$this->assign('sAddress',$sAddress);
		$this->assign('sIdnumber',$sIdnumber);
		$this->assign('sAppealemail',$sAppealemail);

		$this->display('userappeal+step3');
	}

	public function step4(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}

		$nEmaillink=intval(G::getGpc('emaillink'));

		if($nEmaillink!=1){
			$this->check_seccode(true);
		}
		
		$sRealname=trim(G::getGpc('real_name'));
		$sAddress=trim(G::getGpc('address'));
		$sIdnumber=trim(G::getGpc('id_number'));
		$sAppealemail=trim(G::getGpc('appeal_email'));
		$sUserid=trim(G::getGpc('user_id'));
		$sHashcode=trim(G::getGpc('hashcode','P'));
		$sOldHashcode=trim(G::getGpc('old_hashcode','P'));

		$sUserid=G::authcode($sUserid);
		if(empty($sUserid)){
			$this->E(Dyhb::L('页面已过期','Controller/Userappeal'));
		}

		$oUser=UserModel::F('user_id=?',$sUserid)->getOne();
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Userappeal'));
		}

		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Userappeal'));
		}


		if($nEmaillink!=1){
			if(empty($sHashcode)){
				$this->E(Dyhb::L('申诉验证码不能为空','Controller/Userappeal'));
			}

			$sOldHashcode=G::authcode($sOldHashcode);
			if(empty($sOldHashcode)){
				$this->E(Dyhb::L('申诉验证码已过期','Controller/Userappeal'));
			}

			if($sOldHashcode!=$sHashcode){
				$this->E(Dyhb::L('申诉验证码错误','Controller/Userappeal'));
			}
		}

		$sReceiptnumber=G::randString(32);

		// 将申诉信息保存到数据库
		$oAppeal=new AppealModel();
		$oAppeal->user_id=intval($sUserid);
		$oAppeal->appeal_realname=$sRealname;
		$oAppeal->appeal_address=$sAddress;
		$oAppeal->appeal_idnumber=$sIdnumber;
		$oAppeal->appeal_email=$sAppealemail;
		$oAppeal->appeal_receiptnumber=$sReceiptnumber;
		$oAppeal->save(0);

		if($oAppeal->isError()){
			$this->E($oAppeal->getErrorMessage());
		}
	
		$sUserid=G::authcode($oAppeal['user_id'],false,null,$GLOBALS['_option_']['getpassword_expired']);
		
		$this->assign('sUserid',$sUserid);
		$this->assign('oAppeal',$oAppeal);

		$this->display('userappeal+step4');
	}
	
	public function tocomputer(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}

		$nAppealId=intval(G::getGpc('id','G'));
		$sUserid=trim(G::getGpc('user_id','G'));

		$sUserid=G::authcode($sUserid);
		if(empty($sUserid)){
			$this->E(Dyhb::L('页面已过期','Controller/Userappeal'));
		}

		$oUser=UserModel::F('user_id=?',$sUserid)->getOne();
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Userappeal'));
		}

		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Userappeal'));
		}

		if(empty($nAppealId)){
			$this->E(Dyhb::L('无法获取申诉ID','Controller/Userappeal'));
		}

		$oAppeal=AppealModel::F('appeal_id=?',$nAppealId)->getOne();

		if(empty($oAppeal->appeal_id)){
			$this->E(Dyhb::L('无效的申诉ID','Controller/Userappeal'));
		}

		$sName='APPEAL_'.date('Y_m_d_H_i_s',CURRENT_TIMESTAMP).'.txt';

		header('Content-Type: text/plain');
		header('Content-Disposition: attachment;filename="'.$sName.'"');
		if(preg_match("/MSIE([0-9].[0-9]{1,2})/",$_SERVER['HTTP_USER_AGENT'])){
			header('Cache-Control: must-revalidate,post-check=0,pre-check=0');
			header('Pragma: public');
		}else{
			header('Pragma: no-cache');
		}
		
		$sAppealscheduleUrl=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=userappeal&a=schedule';
		$sNlbr="\r\n";

		$sContent='['.$GLOBALS['_option_']['site_name'].']'.Dyhb::L('用户申诉回执单','Controller/Userappeal').$sNlbr;
		$sContent.='-----------------------------------------------------'.$sNlbr;
		$sContent.=Dyhb::L('申诉人','Controller/Userappeal').':'.$oAppeal->appeal_realname.$sNlbr.$sNlbr;
		$sContent.=Dyhb::L('申诉回执编号','Controller/Userappeal').':'.$oAppeal->appeal_receiptnumber.$sNlbr.$sNlbr;
		$sContent.='--'.Dyhb::L('请牢记你的申诉编号，以便于随时查询申诉进度','Controller/Userappeal').$sNlbr;
		$sContent.=$sAppealscheduleUrl.$sNlbr.$sNlbr;
		$sContent.=Dyhb::L('接受申诉结果的Email','Controller/Userappeal').':'.$oAppeal->appeal_email.$sNlbr.$sNlbr;
		$sContent.='-----------------------------------------------------'.$sNlbr;
		$sContent.=date('Y-m-d H:i',CURRENT_TIMESTAMP);

		echo $sContent;
	}

	public function tomail(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}

		$nAppealId=intval(G::getGpc('id','G'));
		$sUserid=trim(G::getGpc('user_id','G'));

		$sUserid=G::authcode($sUserid);
		if(empty($sUserid)){
			$this->E(Dyhb::L('页面已过期','Controller/Userappeal'));
		}

		$oUser=UserModel::F('user_id=?',$sUserid)->getOne();
		if(empty($oUser->user_id)){
			$this->E(Dyhb::L('Email账号不存在','Controller/Userappeal'));
		}

		if($oUser->user_status==0){
			$this->E(Dyhb::L('该账户已经被禁止','Controller/Userappeal'));
		}

		if(empty($nAppealId)){
			$this->E(Dyhb::L('无法获取申诉ID','Controller/Userappeal'));
		}

		$oAppeal=AppealModel::F('appeal_id=?',$nAppealId)->getOne();

		if(empty($oAppeal->appeal_id)){
			$this->E(Dyhb::L('无效的申诉ID','Controller/Userappeal'));
		}
		
		$oMailModel=Dyhb::instance('MailModel');
		$oMailConnect=$oMailModel->getMailConnect();

		$sAppealscheduleUrl=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=userappeal&a=schedule';
		$sNlbr=$oMailConnect->getIsHtml()===true?'<br/>':"\r\n";

		$sEmailSubject=$GLOBALS['_option_']['site_name'].Dyhb::L('用户申诉回执单','Controller/Userappeal');
		$sEmailContent='<b>'.Dyhb::L('尊敬的用户','Controller/Userappeal').':</b>'.$sNlbr;
		$sEmailContent.='-----------------------------------------------------'.$sNlbr;
		$sEmailContent.=Dyhb::L('申诉人','Controller/Userappeal').':'.$oAppeal->appeal_realname.$sNlbr.$sNlbr;
		$sEmailContent.=Dyhb::L('申诉回执编号','Controller/Userappeal').':'.$oAppeal->appeal_receiptnumber.$sNlbr.$sNlbr;
		$sEmailContent.='--'.Dyhb::L('请牢记你的申诉编号，以便于随时查询申诉进度','Controller/Userappeal').$sNlbr;
		$sEmailContent.="<a href=\"{$sAppealscheduleUrl}\">{$sAppealscheduleUrl}</a>".$sNlbr.$sNlbr;
		$sEmailContent.=Dyhb::L('接受申诉结果的Email','Controller/Userappeal').':'.$oAppeal->appeal_email.$sNlbr.$sNlbr;
		$sEmailContent.='-----------------------------------------------------'.$sNlbr;
		$sEmailContent.=date('Y-m-d H:i',CURRENT_TIMESTAMP);

		$oMailConnect->setEmailTo($oAppeal->appeal_email);
		$oMailConnect->setEmailSubject($sEmailSubject);
		$oMailConnect->setEmailMessage($sEmailContent);
		$oMailConnect->send();
		if($oMailConnect->isError()){
			$this->E($oMailConnect->getErrorMessage());
		}

		$this->assign('__WaitSecond__',5);
		$this->assign('__JumpUrl__','javascript:history.back(-1);');

		$this->S(Dyhb::L('申诉回执编号已发送到您的邮箱','Controller/Userappeal').' '.$oAppeal->appeal_email);
	}

	public function schedule(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}
		$this->display('userappeal+schedule');
	}

	public function schedule_result(){
		if(UserModel::M()->isLogin()){
			$this->U('home://user/index');
		}

		$this->check_seccode(true);

		$sAppealReceiptnumber=trim(G::getGpc('appeal_receiptnumber','P'));
		$sAppealEmail=trim(G::getGpc('appeal_email','P'));
		if(empty($sAppealReceiptnumber)){
			$this->E(Dyhb::L('申诉回执编号不能为空','Controller/Userappeal'));
		}
		if(empty($sAppealEmail)){
			$this->E(Dyhb::L('申诉邮箱不能为空','Controller/Userappeal'));
		}

		Check::RUN();
		if(!Check::C($sAppealEmail,'email')){
			$this->E(Dyhb::L('申诉邮箱错误','Controller/Userappeal'));
		}
		$oAppeal=AppealModel::F('appeal_email=? AND appeal_receiptnumber=?',$sAppealEmail,$sAppealReceiptnumber)->getOne();
		if(empty($oAppeal->appeal_id)){
			$this->E(Dyhb::L('申诉回执编号或者申诉邮箱错误,又或者该申诉回执已被删除','Controller/Userappeal'));
		}
		if($oAppeal->appeal_status==0){
			$this->E(Dyhb::L('该申诉回执已经被关闭','Controller/Userappeal'));
		}

		$this->assign('oAppeal',$oAppeal);
		
		$this->display('userappeal+scheduleresult');
	}

	public function schedule_progress($nProgress){
		if($nProgress==0){
			return 33;
		}elseif($nProgress==1){
			return 66;
		}elseif($nProgress==2 || $nProgress==3){
			return 100;
		}

		return 0;
	}

}
