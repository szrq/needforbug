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

}
