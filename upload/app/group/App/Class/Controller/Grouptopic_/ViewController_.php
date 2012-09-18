<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   查看帖子控制器($)*/

!defined('DYHB_PATH') && exit;

class ViewController extends Controller{

	public function index(){
		$nId=intval(G::getGpc('id','G'));
		$oGrouptopic=GrouptopicModel::F('grouptopic_id=?',$nId)->getOne();

		$this->assign('oGrouptopic',$oGrouptopic);
		$this->display('grouptopic+view');
	}

}
