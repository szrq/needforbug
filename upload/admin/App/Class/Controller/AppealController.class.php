<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   短消息管理控制器($)*/

!defined('DYHB_PATH') && exit;

require_once(Core_Extend::includeFile('function/Pm_Extend'));

class AppealController extends InitController{

	public function filter_(&$arrMap){
		$arrMap['appeal_email']=array('like',"%".G::getGpc('appeal_email')."%");

		
		$nType=intval(G::getGpc('type','G'));
		if($nType<4&&$nType>=0){
			$arrMap['appeal_progress']=$nType;
		}
		$this->assign('nType',$nType);
	}
	public function show(){
		$nAppealId=intval(G::getGpc('id','G'));

		if(!empty($nAppealId)){
			$oAppeal=AppealModel::F('appeal_id=?',$nAppealId)->getOne();
			if($oAppeal->appeal_progress==0){
				$oAppeal->appeal_progress=1;
				$oAppeal->save(0,'update');
				if(!$oAppeal->isError()){
				$this->assign('oAppeal',$oAppeal);
				$this->display();
				}else{
				$this->E('无法保存用户信息');
				}
			}else{
				$this->assign('oAppeal',$oAppeal);
				$this->display();
			}
		}else{
			$this->E('无法获取用户的申诉信息');
		}
	}

	public function pass(){
		$nAppealId=intval(G::getGpc('id','G'));

		if(!empty($nAppealId)){
			$oAppeal=AppealModel::F('appeal_id=?',$nAppealId)->getOne();
			$oAppeal->appeal_progress=2;
			$oAppeal->save(0,'update');
			if(!$oAppeal->isError()){
				$sEmail=$oAppeal->appeal_email;
				$oUser=UserModel::F('user_id=?',$oAppeal->user_id)->getOne();
				$sTemppassword=md5(G::randString(32));
				$oUser->user_temppassword=$sTemppassword;
				$oUser->save(0,'update');
				if($oUser->isError()){
					$this->E($oUser->getErrorMessage());
				}
				
				$sGetPasswordUrl=$GLOBALS['_option_']['site_url'].'/index.php?c=getpassword&a=reset&email='.urlencode($sEmail).'&appeal=1'.'&hash='.urlencode(G::authcode($sTemppassword,false,null,$GLOBALS['_option_']['getpassword_expired']));

				$oMailModel=Dyhb::instance('MailModel');
				$oMailConnect=$oMailModel->getMailConnect();

				$sEmailSubject=$GLOBALS['_option_']['site_name'].'会员申诉密码重置';
				$sNlbr=$oMailConnect->getIsHtml()===true?'<br/>':"\r\n";
				$sEmailContent='';
				$sEmailContent.='重置密码链接'.':'.$sNlbr;
				$sEmailContent.="<a href=\"{$sGetPasswordUrl}\">{$sGetPasswordUrl}</a>".$sNlbr.$sNlbr;
				$sEmailContent.="-----------------------------------------------------".$sNlbr;
				$sEmailContent.='这是系统用于重置密码的邮件，请勿回复'.$sNlbr;
				$sEmailContent.='链接过期时间'.$GLOBALS['_option_']['getpassword_expired'].
					'秒'.$sNlbr;

				$oMailConnect->setEmailTo($sEmail);
				$oMailConnect->setEmailSubject($sEmailSubject);
				$oMailConnect->setEmailMessage($sEmailContent);
				$oMailConnect->send();
				if($oMailConnect->isError()){
					$this->E($oMailConnect->getErrorMessage());
				}
				$this->S('审核通过');
			}else{
				$this->E('审核失败');
			}
		}else{
			$this->E('无法获取用户的申诉信息');
		}
	}

	public function reject(){
		$nAppealId=intval(G::getGpc('id','G'));
		$sAppealReason=trim(G::getGpc('appeal_reason','P'));

		if(!empty($nAppealId)){
			$oAppeal=AppealModel::F('appeal_id=?',$nAppealId)->getOne();
			$oAppeal->appeal_progress=3;
			$oAppeal->appeal_reason=$sAppealReason;
			$oAppeal->save(0,'update');
			if(!$oAppeal->isError()){
				$this->assign('__JumpUrl__',Dyhb::U('Appeal/index'));
				$this->S('审核驳回');
			}else{
				$this->E('驳回失败');
			}
		}else{
			$this->E('无法获取用户的申诉信息');
		}
	}
}
