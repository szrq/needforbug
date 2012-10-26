<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组控制器($)*/

!defined('DYHB_PATH') && exit;

class GroupController extends InitController{

	public function show(){
		$sId=trim(G::getGpc('id','G'));
		$nCid=intval(G::getGpc('cid','G'));
		$nDid=intval(G::getGpc('did','G'));
		$sType=G::getGpc('type','G');

		if(empty($sType)){
			$sType='create_dateline';
		}elseif($sType=="view"){
			$sType='grouptopic_views';
		}elseif($sType=="com"){
			$sType='grouptopic_comments';
		}else{
			$sType='create_dateline';
		}

		$this->assign('sType',$sType);

		if(Core_Extend::isPostInt($sId)){
			$oGroup=GroupModel::F('group_id=? AND group_status=1 AND group_isaudit=1',$sId)->getOne();
		}else{
			$oGroup=GroupModel::F('group_name=? AND group_status=1 AND group_isaudit=1',$sId)->getOne();
		}
		if(empty($oGroup['group_id'])){
			$this->E('小组不存在或在审核中');
		}
		
		// 读取帖子列表
		$arrWhere=array();
		$nEverynum=$GLOBALS['_cache_']['group_option']['group_listtopicnum'];
		if(!empty($nCid)){
			$arrWhere['grouptopiccategory_id']=$nCid;
		}
		if(!empty($nDid)&&$nDid==1){
			$arrWhere['grouptopic_addtodigest']=$nDid;
		}

		$arrWhere['grouptopic_status']=1;
		$arrWhere['grouptopic_isaudit']=1;	
		$arrWhere['group_id']=$oGroup->group_id;

		$nTotalComment=GrouptopicModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalComment,$nEverynum,G::getGpc('page','G'));
		$arrGrouptopics=GrouptopicModel::F()->where($arrWhere)->order("{$sType} DESC")->limit($oPage->returnPageStart(),$nEverynum)->getAll();
		$this->assign('arrGrouptopics',$arrGrouptopics);
		$this->assign('nEverynum',$nEverynum);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		
		// 小组分类
		$arrGrouptopiccategory=GrouptopiccategoryModel::F('group_id=?',$oGroup->group_id)->getAll();
		$arrCid=array();
		foreach($arrGrouptopiccategory as $key=>$oValue){
			array_push($arrCid,$oValue->grouptopiccategory_id);
		}

		$this->assign('arrGrouptopiccategory',$arrGrouptopiccategory);

		// 取得用户是否加入了小组
		if($GLOBALS['___login___']===false){
			$nGroupuser=0;
		}else{
			$nGroupuser=GroupModel::isGroupuser($oGroup['group_id'],$GLOBALS['___login___']['user_id']);
		}

		$this->assign('nGroupuser',$nGroupuser);

		$this->assign('oGroup',$oGroup);
		$this->assign('arrCid',$arrCid);
		$this->assign('nCid',$nCid);
		
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
		
		if($oGroupuser->isError()){
			$this->E($oGroupuser->getErrorMessage());
		}

		$oGroup=GroupModel::F('group_id=?',$nGid)->getOne();
		$oGroup->group_usernum=GroupuserModel::F('group_id=?',$nGid)->getCounts();
		$oGroup->save(0,'update');
		
		if($oGroup->isError()){
			$this->E($oGroup->getErrorMessage());
		}

		$this->S("恭喜你，成功加入{$oGroup->group_nikename}小组");
	}

	public function leavegroup(){
		$nGid=G::getGpc('gid','G');
		$oGroup=GroupModel::F('group_id=?',$nGid)->getOne();

		if(empty($nGid)||empty($oGroup->group_id)){
			$this->E("你访问的小组不存在");
		}

		$arrCondition=array('group_id'=>$nGid,'user_id'=>$GLOBALS['___login___']['user_id']);
		$oGroupuser=GroupuserModel::F($arrCondition)->getOne();
		if(empty($oGroupuser->user_id)){
			$this->E("你尚未加入该小组");
		}

		$oGroupuser->destroy();

		$this->S("成功退出{$oGroup->group_nikename}小组");
	}

	public function getcategory(){
		$nGid=intval(G::getGpc('gid','P'));

		if(empty($nGid)){
			echo '';
		}

		echo "<option value=\"0\">"."默认分类</option>";
		
		$arrGrouptopiccategory=GrouptopiccategoryModel::F('group_id=?',$nGid)->getAll();
		foreach($arrGrouptopiccategory as $key=>$oValue){
			echo "<option value=\"$oValue->grouptopiccategory_id\">".$oValue->grouptopiccategory_name."</option>";
		}
	}

}
