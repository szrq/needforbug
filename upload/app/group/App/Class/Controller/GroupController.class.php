<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组控制器($)*/

!defined('DYHB_PATH') && exit;

class GroupController extends InitController{

	public function show(){
		$sId=trim(G::getGpc('id','G'));

		$oGroup=GroupModel::F('group_name=? AND group_status=1 AND group_isaudit=1',$sId)->getOne();
		if(empty($oGroup['group_id'])){
			$this->E('小组不存在或者还在审核中');
		}
		
		$arrWhere=array();
		$nEverynum=4;
		$arrWhere['grouptopic_status']=1;
		$arrWhere['grouptopic_isaudit']=1;	
		$arrWhere['group_id']=$oGroup->group_id;
		$nTotalComment=GrouptopicModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalComment,$nEverynum,G::getGpc('page','G'));
		$arrGrouptopics=GrouptopicModel::F()->where($arrWhere)->limit($oPage->returnPageStart(),$nEverynum)->getAll();
		$this->assign('arrGrouptopics',$arrGrouptopics);
		$this->assign('nEverynum',$nEverynum);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));

		$this->assign('oGroup',$oGroup);
		
		$this->display('group+show');
	}

	public function unserialize($slatestcomment){
		$arrLatestcomment=unserialize($slatestcomment);
		return $arrLatestcomment;
	}

}
