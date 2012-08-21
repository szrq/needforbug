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
		$sServer=OptionModel::getOption('mailserver');
		$sAuthUsername=OptionModel::getOption('mailauth_username');
		$sAuthPassword=OptionModel::getOption('mailauth_password');
		$nPort=OptionModel::getOption('mailport');
		$sEmailSendType=OptionModel::getOption('mailsend');
		$nMailDelimiter=OptionModel::getOption('maildelimiter');
		$sEmailFrom=OptionModel::getOption('mailfrom');
		if(empty($sEmailFrom)){
			$sEmailFrom=OptionModel::getOption('maildefault');
		}
		if(!in_array($nMailDelimiter,array(0,1,2))){
			$nMailDelimiter=0;
		}
		if(empty($nPort)){
			$nPort=25;
		}
		if($sEmailSendType==1){
			$sEmailSendType=Mail::PHP_MAIL;
		}
		elseif($sEmailSendType==2){
			$sEmailSendType=Mail::SOCKET_SMTP;
		}
		elseif($sEmailSendType==3){
			$sEmailSendType=Mail::PHP_SMTP;
		}
		else{
			$sEmailSendType=Mail::SOCKET_SMTP;
		}
		$oMail=new Mail($sServer,$sAuthUsername,$sAuthPassword,$nPort,$sEmailSendType );
		$oMail->setEmailLimiter($nMailDelimiter );
		$oMail->setEmailFrom($sEmailFrom );// 邮件来源
		$oBlogName=OptionModel::getOption('blog_name');
		if(!empty($oBlogName)){
			$oMail->setSiteName($oBlogName);
		}
		return $oMail;
	}

	public function sendAEmail($oMailSend,$sEmailTo,$sEmailSubject,$sEmailMessage,$sEmailApplication='blog',$bSave=true){
		$oMailSend->setEmailTo($sEmailTo );// 邮件去向
		$oMailSend->setEmailSubject($sEmailSubject );// 邮件主题
		$oMailSend->setEmailMessage($sEmailMessage ,$oMailSend);// 邮件消息
		if($bSave===true){
			$oMail=new MailModel();
			$oMail->mail_subject=$sEmailSubject;
			$oMail->mail_message=$sEmailMessage;
			$oMail->mail_application=$sEmailApplication;
			$oMail->mail_htmlon=$oMailSend->getIsHtml()===true?1:0;
			$oMail->mail_frommail=$oMailSend->getEmailFrom();
			$oMail->mail_tomail=$sEmailTo;
			$oMail->mail_charset=$oMailSend->getCharset();
		}
		$oMailSend->send();
		if($oMailSend->isError()){
			if($bSave===true){
				$oMail->mail_isfailure=1;
				$oMail->save();
			}
			$this->setErrorMessage($oMailSend->getErrorMessage());
		}
		else{
			if($bSave===true){
				$oMail->save();
			}
		}
	}

}
