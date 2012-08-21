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
		$this->display();
	}

	public function mail_check(){
		$sEmailFrom=trim(G::getGpc('from','G'));
		$sEmailTo=trim(G::getGpc('to','G'));

		if(empty($sEmailTo)){
			$this->E(Dyhb::L('邮件接收者不能为空','Controller/Mailoption'));
		}

		$oMailModel=Dyhb::instance('MailModel');
		$oMailConnect=$oMailModel->getMailConnect();

		if(!empty($sEmailFrom) && $sEmailFrom!='none'){
			$oMailConnect->setEmailFrom($sEmailFrom);
		}

		$sEmailSubject=$this->get_email_to_test_subject();
		$sEmailMessage=$this->get_email_to_test_message($oMailConnect);

		$this->send_a_email($oMailConnect,$sEmailTo,$sEmailSubject,$sEmailMessage);
	}

	public function send_a_email($oMailConnect,$sEmailTo,$sEmailSubject,$sEmailMessage){
		$oMailConnect->setEmailTo($sEmailTo);
		$oMailConnect->setEmailSubject($sEmailSubject);
		$oMailConnect->setEmailMessage($sEmailMessage,$oMailSend);
		$oMailConnect->send();

		if($oMailConnect->isError()){
			$this->E($oMailConnect->getErrorMessage());
		}

		$this->S(Dyhb::L('邮件成功发送！注意：使用PHP 函数 Mail函数或者PHP 函数 SMTP发送，虽然显示发送成功，但不保证能够收得到邮件','Controller/Mailoption'));
	}

	public function get_email_to_test_message($oMailSend){
		$sLine=$this->get_mail_line($oMailSend);
		$sMessage=$this->get_email_to_test_subject()."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=G::L('这是系统发出的一封用于测试邮件是否设置成功的测试邮件。')."{$sLine}{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=G::L('消息来源：').Global_Extend::getOption('blog_name')."{$sLine}";
		$sMessage.=G::L('站点网址：').Global_Extend::getOption('blog_url')."{$sLine}";
		$sMessage.="-----------------------------------------------------{$sLine}";
		$sMessage.=G::L('程序支持：').Global_Extend::getOption('blog_program_name')." Blog " .BLOG_SERVER_VERSION. "  Release " .BLOG_SERVER_RELEASE."{$sLine}";
		$sMessage.=G::L('产品官网：').Global_Extend::getOption('blog_program_url')."{$sLine}";
		return $sMessage;
	}

	public function get_email_to_test_subject(){
		return G::L("我的朋友：【%s】您在博客（%s）测试邮件发送成功了！",'app',null,G::L('风随我动'),Global_Extend::getOption('blog_name'));
	}

	public function get_mail_line($oMailConnect){
		return $oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
	}

}
