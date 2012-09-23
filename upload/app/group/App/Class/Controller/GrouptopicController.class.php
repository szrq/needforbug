<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   帖子控制器($)*/

!defined('DYHB_PATH') && exit;

class GrouptopicController extends InitController{

	public function init__(){
		parent::init__();

		$this->is_login();
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
		//$arrOptions=$GLOBALS['_cache_']['group_option'];

		$sContent=trim(G::getGpc('comment_message'));
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
			$this->E((30-(CURRENT_TIMESTAMP-$oGrouptopiccomment->create_dateline)).'秒后才能回复');
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
		
		$nTotalComment=GrouptopiccommentModel::F('grouptopic_id=?',$oGrouptopic->grouptopic_id)->getCounts();
		$page=ceil($nTotalComment/5);
		
		$sUrl=Dyhb::U('group://grouptopic/view?id='.$oGrouptopic->grouptopic_id.'&page='.$page).'#'.($oGrouptopiccomment->grouptopiccomment_id);
		$this->A(array('url'=>$sUrl),'回复成功',1);
	}
}
