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
			$oAppeal->appeal_progress=1;
			$oAppeal->save(0,'update');
			if(!$oAppeal->isError()){
				$this->assign('oAppeal',$oAppeal);
				$this->display();
			}else{
				$this->E('无法保存用户信息');
			}
		}else{
			$this->E('无法获取该用户的申诉信息');
		}
	}
	public function pass(){
		$nAppealId=intval(G::getGpc('id','G'));
		if(!empty($nAppealId)){
			$oAppeal=AppealModel::F('appeal_id=?',$nAppealId)->getOne();
			$oAppeal->appeal_progress=2;
			$oAppeal->save(0,'update');
			if(!$oAppeal->isError()){
				$this->assign('oAppeal',$oAppeal);
				$this->S('审核通过');
			}else{
				$this->E('无法保存用户信息');
			}
		}else{
			$this->E('无法获取该用户的申诉信息');
		}
	}
}
