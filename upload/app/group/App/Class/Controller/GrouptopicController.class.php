<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   帖子控制器($)*/

!defined('DYHB_PATH') && exit;

class GrouptopicController extends InitController{

	public function init__(){
		parent::init__();

		//$this->is_login();
	}
	
	public function add(){
		Core_Extend::doControllerAction('Grouptopic@Add','index');
	}	
	
	public function add_topic(){
		Core_Extend::doControllerAction('Grouptopic@Addtopic','index');
	}

	public function view(){
		Core_Extend::doControllerAction('Grouptopic@View','index');
	}

	public function edit(){
		$nTid=intval(G::getGpc('tid','G'));
		$nUid=intval(G::getGpc('uid','G'));
		$nGroupid=intval(G::getGpc('gid','G'));

		if(Core_Extend::isAdmin()===false && $nUid!=$GLOBALS['___login___']['user_id']){
			$this->E("无法编辑他人的主题");
		}
		
		$oGrouptopic=GrouptopicModel::F('grouptopic_id=?',$nTid)->getOne();
		if(empty($oGrouptopic->grouptopic_id)){
			$this->E("不存在你要编辑的主题");
		}

		$this->assign('oGrouptopic',$oGrouptopic);
		
		$arrGrouptopiccategorys=array();
		$oGrouptopiccategory=Dyhb::instance('GrouptopiccategoryModel');
		$arrGrouptopiccategorys=$oGrouptopiccategory->grouptopiccategoryByGroupid($nGroupid);
		$this->assign('arrGrouptopiccategorys',$arrGrouptopiccategorys);
		$this->assign('nGroupid',$nGroupid);

		$this->display('grouptopic+add');
	}

	public function submit_edit(){
		$nGid=intval(G::getGpc('group_id'));
		$nTid=intval(G::getGpc('grouptopic_id'));

		$oGrouptopic=GrouptopicModel::F('group_id=? AND grouptopic_id=?',$nGid,$nTid)->getOne();
		if(empty($oGrouptopic->group_id)){
			$this->E('主题编辑失败');
		}
		$oGrouptopic->grouptopic_updateusername=$GLOBALS['___login___']['user_name'];
		$oGrouptopic->save(0,'update');
		if($oGrouptopic->isError()){
			$this->E($oGrouptopic->getErrorMessage());
		}

		$sUrl=Dyhb::U('group://grouptopic/view?id='.$nTid);
		$this->A(array('url'=>$sUrl),'主题编辑成功',1);
	}

	public function reply(){
		$nId=intval(G::getGpc('id','G'));
		if(empty($nId)){
			$this->E('无法找到该主题');
		}

		$oGrouptopic=GrouptopicModel::F('grouptopic_id=?',$nId)->getOne();
		if(empty($oGrouptopic->grouptopic_id)){
			$this->E('你访问的主题不存在');
		}
		$this->assign('oGrouptopic',$oGrouptopic);

		$this->display('grouptopic+reply');
	}
	
	public function add_reply(){
		$sContent=trim(G::getGpc('grouptopiccomment_message'));
		$nId=intval(G::getGpc('tid'));

		if(empty($nId)){
			$this->E('无法找到该主题');
		}

		$oGrouptopic=GrouptopicModel::F('grouptopic_id=?',$nId)->getOne();
		if(empty($oGrouptopic->grouptopic_id)){
			$this->E('你回复的主题不存在');
		}

		//回复30秒内禁止新的回复
		$oGrouptopiccomment=GrouptopiccommentModel::F("user_id=?",$GLOBALS['___login___']['user_id'])->order('grouptopiccomment_id DESC')->getOne();
		if((CURRENT_TIMESTAMP-$oGrouptopiccomment->create_dateline)<30){
			//$this->E((30-(CURRENT_TIMESTAMP-$oGrouptopiccomment->create_dateline)).'秒后才能回复');
		}
	
		//一天之内禁止重复回复
		$nCurrentTimeStamp=CURRENT_TIMESTAMP;
		$oGrouptopiccomment=GrouptopiccommentModel::F("user_id=? AND grouptopiccomment_content=? AND {$nCurrentTimeStamp}-create_dateline<86400",$GLOBALS['___login___']['user_id'],$sContent)->getOne();
		if(!empty($oGrouptopiccomment->user_id)){
				$this->E('你提交的评论已经存在,24小时之内不允许出现相同的评论');
		}

		$oGrouptopiccomment=new GrouptopiccommentModel();	
		$oGrouptopiccomment->grouptopiccomment_content=$sContent;
		$oGrouptopiccomment->grouptopic_id=$nId;
		$oGrouptopiccomment->save(0);
		if($oGrouptopiccomment->isError()){
			$this->E($oGrouptopiccomment->getErrorMessage());
		}

		$arrLatestData=array('commenttime'=>$oGrouptopiccomment->create_dateline,'commentid'=>$oGrouptopiccomment->grouptopiccomment_id,'tid'=>$oGrouptopic->grouptopic_id,'commentuserid'=>$GLOBALS['___login___']['user_id']);
		$oGrouptopic->grouptopic_latestcomment=serialize($arrLatestData);
		$oGrouptopic->setAutoFill(false);
		$oGrouptopic->save(0,'update');
		if($oGrouptopic->isError()){
			$this->E($oGrouptopic->getErrorMessage());
		}

		$arrLatestData['commenttitle']=$oGrouptopic->grouptopic_title;
		$nCommnum=GrouptopicModel::F('group_id=?',$oGrouptopic->group_id)->getSum('grouptopic_comments');
		$oGroup=GroupModel::F('group_id=?',$oGrouptopic->group_id)->getOne();
		$oGroup->group_latestcomment=serialize($arrLatestData);
		$oGroup->group_topiccomment=$nCommnum;
		$oGroup->save(0,'update');
		if($oGroup->isError()){
			$this->E($oGroup->getErrorMessage());
		}

		$oGrouptopic->grouptopic_comments=GrouptopiccommentModel::F('grouptopic_id=?',$nId)->all()->getCounts();
		$oGrouptopic->setAutofill(false);
		$oGrouptopic->save(0,'update');
		if($oGrouptopic->isError()){
			$this->E($oGrouptopic->getErrorMessage());
		}

		$nTotalComment=GrouptopiccommentModel::F('grouptopic_id=?',$oGrouptopic->grouptopic_id)->getCounts();
		$nPage=ceil($nTotalComment/5);
		
		$sUrl=Dyhb::U('group://grouptopic/view?id='.$oGrouptopic->grouptopic_id.($nPage>1?'&page='.$nPage:'').'&extra=new'.$oGrouptopiccomment->grouptopiccomment_id).'#grouptopiccomment-'.($oGrouptopiccomment->grouptopiccomment_id);

		$this->A(array('url'=>$sUrl),'回复成功',1);
	}
}
