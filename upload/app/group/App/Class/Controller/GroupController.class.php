<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组控制器($)*/

!defined('DYHB_PATH') && exit;

class GroupController extends InitController{

	public function show(){
		$sId=trim(G::getGpc('id','G'));

		$oGroup=GroupModel::F('group_name=? AND group_status=1 AND group_isaudit=1',$sId)->getOne();
		if(empty($oGroup['group_id'])){
			$this->E('小组不存在或在审核中');
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
		
		$arrGrouptopiccategory=GrouptopiccategoryModel::F('group_id=?',$oGroup->group_id)->getAll();
		$this->assign('arrGrouptopiccategory',$arrGrouptopiccategory);
		$this->assign('oGroup',$oGroup);
		
		$this->display('group+show');
	}

	public function unserialize($slatestcomment){
		$arrLatestcomment=unserialize($slatestcomment);
		return $arrLatestcomment;
	}

	public function joingroup(){
		$nGid=G::getGpc('gid','G');
		$oGroup=GroupModel::F('group_id=?',$nGid)->getOne();
		if(empty($nGid)||empty($oGroup->group_id)){
			$this->E("你访问的小组不存在");
		}
		if(empty($GLOBALS['___login___']['user_id'])){
			$this->E("加入小组需登录后才能进行");
		}
		$arrCondition=array('group_id'=>$nGid,'user_id'=>$GLOBALS['___login___']['user_id']);
		$oGroupuser=GroupuserModel::F($arrCondition)->getOne();
		if(!empty($oGroupuser->user_id)){
			$this->E("你已是该小组成员");
		}
		$oGroupuser=new GroupuserModel();
		$oGroupuser->user_id=$GLOBALS['___login___']['user_id'];
		$oGroupuser->group_id=$nGid;
		$oGroupuser->save(0);
		if($oGroup->isError()){
			$this->E($oGroup->getErrorMessage());
		}
		$this->S("恭喜你，成功加入{$oGroup->group_nikename}小组");
	}

}
