<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   查看帖子控制器($)*/

!defined('DYHB_PATH') && exit;

class ViewController extends Controller{

	public function index(){
		$nId=intval(G::getGpc('id','G'));
		$oGrouptopic=GrouptopicModel::F('grouptopic_id=?',$nId)->getOne();
		if(empty($oGrouptopic->user_id)){
			$this->E('你访问的主题不存在或已删除');
		}
		$oGrouptopic->grouptopic_views=$oGrouptopic->grouptopic_views+1;
		//$oGrouptopic->grouptopic_views=GrouptopiccommentModel::F('grouptopic_id=?',$nId)->all()->getCounts()+1;
		$oGrouptopic->save(0,'update');
		if($oGrouptopic->isError()){
			$this->E($oGrouptopic->getErrorMessage());
		}
		$nGrouptopic=GrouptopicModel::F('user_id=?',$oGrouptopic->user_id)->getCounts();
		$this->assign('nGrouptopic',$nGrouptopic);

		$oUserprofile=UserprofileModel::F('user_id=?',$oGrouptopic->user_id)->getOne();
		$this->assign('oUserprofile',$oUserprofile);
		
		//$nGrouptopicview=
		//回复列表
		$arrWhere=array();
		$nEverynum=5;
		$arrWhere['grouptopiccoment_status']=1;
		$arrWhere['grouptopic_id']=$oGrouptopic->grouptopic_id;
		$nTotalComment=GrouptopiccommentModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalComment,$nEverynum,G::getGpc('page','G'));
		$arrComment=GrouptopiccommentModel::F()->where($arrWhere)->limit($oPage->returnPageStart(),$nEverynum)->getAll();
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('arrComment',$arrComment);
		
		$this->assign('oGrouptopic',$oGrouptopic);
		$this->display('grouptopic+view');
	}

}
