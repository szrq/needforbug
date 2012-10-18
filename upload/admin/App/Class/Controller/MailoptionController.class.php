<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   邮件发送设置控制器($)*/

!defined('DYHB_PATH') && exit;

class MailoptionController extends OptionController{

	public function index($sModel=null,$bDisplay=true){
		$arrOptionData=$GLOBALS['_option_'];
		$this->assign('arrOptions',$arrOptionData);
		
		$this->display();
	}

	public function check(){
		$arrOptionData=$GLOBALS['_option_'];
		$this->assign('arrOptions',$arrOptionData);

		$this->display();
	}

	public function mail_check(){
		$sEmailFrom=trim(G::getGpc('test_mail_from','P'));
		$sEmailTo=trim(G::getGpc('test_mail_to','P'));
		$sEmailSubject=trim(G::getGpc('test_mail_subject','P'));
		$sEmailMessage=trim(G::getGpc('test_mail_message','P'));

		if(empty($sEmailTo)){
			$this->E(Dyhb::L('邮件接收者不能为空','Controller/Mailoption'));
		}

		if(empty($sEmailSubject)){
			$this->E(Dyhb::L('邮件测试主题不能为空','Controller/Mailoption'));
		}

		if(empty($sEmailMessage)){
			$this->E(Dyhb::L('邮件测试内容不能为空','Controller/Mailoption'));
		}

		// 将邮件模板保存在配置中
		OptionModel::uploadOption('mail_testmessage',$sEmailMessage);
		OptionModel::uploadOption('mail_testsubject',$sEmailSubject);

		$sEmailSubject=Core_Extend::replaceSiteVar($sEmailSubject);
		$sEmailMessage=str_replace("\r\n",'<br/>',Core_Extend::replaceSiteVar($sEmailMessage));

		$oMailModel=Dyhb::instance('MailModel');
		$oMailConnect=$oMailModel->getMailConnect();

		if(!empty($sEmailFrom)){
			$oMailConnect->setEmailFrom($sEmailFrom);
		}

		$this->send_a_email($oMailConnect,$sEmailTo,$sEmailSubject,$sEmailMessage);
	}

	public function send_a_email($oMailConnect,$sEmailTo,$sEmailSubject,$sEmailMessage){
		$oMailConnect->setEmailTo($sEmailTo);
		$oMailConnect->setEmailSubject($sEmailSubject);
		$oMailConnect->setEmailMessage($sEmailMessage);
		$oMailConnect->send();

		if($oMailConnect->isError()){
			$this->E($oMailConnect->getErrorMessage());
		}

		$this->S(Dyhb::L('邮件成功发送！注意：使用PHP 函数 Mail函数或者PHP 函数 SMTP发送，虽然显示发送成功，但不保证能够收得到邮件','Controller/Mailoption'));
	}

	public function get_mail_line($oMailConnect){
		return $oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
	}

	public function reset_test(){
		$sType=trim(G::getGpc('type','G'));

		if($sType=='subject'){
			echo $GLOBALS['_option_']['mail_testsubject_backup'];
		}elseif($sType=='message'){
			echo $GLOBALS['_option_']['mail_testmessage_backup'];
		}else{
			echo '';
		}
	}

}
