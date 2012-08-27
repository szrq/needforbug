<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   邮件发送模型($)*/

!defined('DYHB_PATH') && exit;

class MailModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'mail',
			'autofill'=>array(
				array('mail_fromuserid','getUserid','create','callback'),
			),
			'check'=>array(
				'mail_subject'=>array(
					array('max_length',300,Dyhb::L('邮件主题的最大字符数为300','__COMMON_LANG__@Model/Mail'))
				),
				'mail_tomail'=>array(
					array('require',Dyhb::L('邮件接收者不能为空','__COMMON_LANG__@Model/Mail')),
					array('email',Dyhb::L('邮件接收者必须为正确的E-mail格式','__COMMON_LANG__@Model/Mail')),
					array('max_length',100,Dyhb::L('邮件接收者的最大字符数为100','__COMMON_LANG__@Model/Mail')),
				),
			),
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function getUserid(){
		$arrUserData=$GLOBALS['___login___'];
		return $arrUserData['user_id']?$arrUserData['user_id']:0;
	}

	public function getMailConnect(){
		// 取得邮件配置信息
		$sMailServer=$GLOBALS['_option_']['mail_server'];
		$sMailAuthUsername=$GLOBALS['_option_']['mail_auth_username'];
		$sMailAuthPassword=$GLOBALS['_option_']['mail_auth_password'];
		$nMailPort=$GLOBALS['_option_']['mail_port'];
		$nMailSendtype=$GLOBALS['_option_']['mail_sendtype'];
		$nMailDelimiter=$GLOBALS['_option_']['mail_delimiter'];
		$sMailFrom=$GLOBALS['_option_']['mail_from'];

		if(empty($sMailFrom)){
			$sMailFrom=$GLOBALS['_option_']['mail_default'];
		}

		if(!in_array($nMailDelimiter,array(0,1,2))){
			$nMailDelimiter=0;
		}

		if(empty($nMailPort)){
			$nMailPort=25;
		}

		if($nMailSendtype==1){
			$nMailSendtype=Mail::PHP_MAIL;
		}elseif($nMailSendtype==2){
			$nMailSendtype=Mail::SOCKET_SMTP;
		}elseif($nMailSendtype==3){
			$nMailSendtype=Mail::PHP_SMTP;
		}else{
			$nMailSendtype=Mail::SOCKET_SMTP;
		}

		$oMailConnect=new Mail($sMailServer,$sMailAuthUsername,$sMailAuthPassword,$nMailPort,$nMailSendtype);
		$oMailConnect->setEmailLimiter($nMailDelimiter);
		$oMailConnect->setEmailFrom($sMailFrom);

		$sSiteName=$GLOBALS['_option_']['site_name'];
		if(!empty($sSiteName)){
			$oMailConnect->setSiteName($sSiteName);
		}

		return $oMailConnect;
	}

	public function sendAEmail(Mail $oMailConnect,$sMailTo,$sMailSubject,$sMailMessage,$sMailApplication='home',$bSave=true){
		// 设置邮件发送信息
		$oMailConnect->setEmailTo($sMailTo);
		$oMailConnect->setEmailSubject($sMailSubject );
		$oMailConnect->setEmailMessage($sMailMessage);
		
		// 保存邮件到服务器
		if($bSave===true){
			$oMail=new MailModel();
			$oMail->mail_subject=$sMailSubject;
			$oMail->mail_message=$sMailMessage;
			$oMail->mail_application=$sMailApplication;
			$oMail->mail_htmlon=$oMailConnect->getIsHtml()===true?1:0;
			$oMail->mail_frommail=$oMailConnect->getEmailFrom();
			$oMail->mail_tomail=$sMailTo;
			$oMail->mail_charset=$oMailConnect->getCharset();
		}

		// 发送邮件
		$oMailConnect->send();

		if($oMailConnect->isError()){
			if($bSave===true){
				$oMail->mail_status=0;
				$oMail->save(0,'update');

				if($oMail->isError()){
					$this->setErrorMessage($oMail->getErrorMessage());
				}
			}

			$this->setErrorMessage($oMailConnect->getErrorMessage());
		}else{
			if($bSave===true){
				$oMail->save(0,'update');

				if($oMail->isError()){
					$this->setErrorMessage($oMail->getErrorMessage());
				}
			}
		}
	}

}
