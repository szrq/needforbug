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

		$sContent=trim(G::getGpc('comment_message','P'));
		$nId=intval(G::getGpc('tid','P'));

		if(empty($nId)){
			$this->E('无法找到该主题',2);
		}

		$oGrouptopic=GrouptopicModel::F('grouptopic_id=?',$nId)->getOne();
		if(empty($oGrouptopic->grouptopic_id)){
			$this->E('你回复的主题不存在',2);
		}
		$oGrouptopiccomment=new GrouptopicModel();

		/*$nCommentPostSpace=intval($arrOptions['comment_post_space']);
		if($nCommentPostSpace){
		
		}

		if($arrOptions['comment_repeat_check']){*/
		$nCurrentTimeStamp=CURRENT_TIMESTAMP;
		$oGrouptopiccomment=GrouptopiccommentModel::F("user_id=? AND grouptopiccomment_content=? AND {$nCurrentTimeStamp}-create_dateline<86400",$GLOBALS['___login___']['user_id'],$sContent)->getOne();
		if(!empty($oGrouptopiccomment->user_id)){
				$this->E('你提交的评论已经存在,24小时之内不允许出现相同的评论',2);
		}
		
		$oGrouptopiccomment->grouptopiccomment_content=$sContent;
		$oGrouptopiccomment->grouptopic_id=$nId;
		$oGrouptopiccomment->save(0);

		$this->S('回复成功',2);
	}
}
