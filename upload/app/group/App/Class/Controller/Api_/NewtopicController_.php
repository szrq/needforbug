<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   最新帖子Api控制器($)*/

!defined('DYHB_PATH') && exit;

class NewtopicController extends Controller{

	public function index(){
		$nNum=intval(G::getGpc('num','G'));

		if($nNum<1){
			$this->E('最新帖子调用数量不能为空');
		}

		$arrGrouptopics=GrouptopicModel::F()->order('create_dateline DESC')->limit(0,$nNum)->getAll();
		$this->assign('arrGrouptopics',$arrGrouptopics);

		$this->display('api+newtopic');
	}
}
