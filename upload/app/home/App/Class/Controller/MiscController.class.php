<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主页杂项控制器($)*/

!defined('DYHB_PATH') && exit;

class MiscController extends InitController{

	public function district(){
		$sContainer=G::getGpc('container','G');
		$nShowlevel=intval(G::getGpc('level','G'));
		$nShowlevel=$nShowlevel>=1 && $nShowlevel<=4?$nShowlevel:4;
		$arrValues=array(intval(G::getGpc('pid','G')),intval(G::getGpc('cid','G')),intval(G::getGpc('did','G')),intval(G::getGpc('coid','G')));
		$sContainertype=in_array(G::getGpc('containertype','G'),array('birth','reside'),true)?G::getGpc('containertype','G'):'birth';
	
		$nLevel=1;
		if($arrValues[0]){
			$nLevel++;
		}

		if($arrValues[1]){
			$nLevel++;
		}

		if($arrValues[2]){
			$nLevel++;
		}

		if($arrValues[3]){
			$nLevel++;
		}

		$nShowlevel=$nLevel;
		$arrElems=array();
		if(G::getGpc('province','G')){
			$arrElems=array(G::getGpc('province','G'),G::getGpc('city','G'),G::getGpc('district','G'),G::getGpc('community','G'));
		}

		require_once(Core_Extend::includeFile('function/Profile_Extend'));
		echo Profile_Extend::showDistrict($arrValues,$arrElems,$sContainer,$nShowlevel,$sContainertype);
	}

	public function newpmnum(){
		header("Content-Type:text/html; charset=utf-8");
		
		$arrData=array();

		$nUserId=intval(G::getGpc('uid'));
		if(empty($nUserId)){
			$arrData=array('system'=>0,'user'=>0,'total'=>0);
		}else{
			$arrWhere['pm_status']=1;

			// 私人短消息
			$arrWhere['pm_isread']=0;
			$arrWhere['pm_msgtoid']=$GLOBALS['___login___']['user_id'];
			$arrWhere['pm_type']='user';
			$arrData['user']=intval(PmModel::F()->where($arrWhere)->all()->getCounts());
			unset($arrWhere['pm_msgtoid']);

			// 系统短消息
			$arrWhere['pm_type']='system';
			$oSystemMessage=SystempmModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->query();
			if(!empty($oSystemMessage['user_id'])){
				$arrReadPms=unserialize($oSystemMessage['systempm_readids']);
				if(!empty($arrReadPms)){
					$arrWhere['pm_id']=array('NOT IN',$arrReadPms);
				}
			}
			$arrData['system']=intval(PmModel::F()->where($arrWhere)->all()->getCounts());

			// 总共的短消息
			$arrData['total']=$arrData['system']+$arrData['user'];
		}

		exit(json_encode($arrData));
	}

}
