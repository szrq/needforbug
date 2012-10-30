<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   热门帖子Api控制器($)*/

!defined('DYHB_PATH') && exit;

class HottopicController extends Controller{

	public function index(){
		$nNum=intval(G::getGpc('num','G'));
		$nCutNum=intval(G::getGpc('cnum','G'));

		if($nNum<1){
			$this->E('热门帖子调用数量不能为空');
		}

		if(empty($nCutNum)){
			$nCutNum=20;
		}

		$arrGrouptopics=GrouptopicModel::F()->order('grouptopic_comments DESC')->limit(0,$nNum)->getAll();
		$this->assign('arrGrouptopics',$arrGrouptopics);
		$this->assign('nCutNum',$nCutNum);

		$this->display('api+hottopic');
	}
}
