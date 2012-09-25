<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   添加帖子入库控制器($)*/

!defined('DYHB_PATH') && exit;

class AddtopicController extends Controller{

	public function index(){
		$nEdit=intval(G::getGpc('edit'));
		if($nEdit==1)
		$oGrouptopic=new GrouptopicModel();
		$oGrouptopic->save(0);

		if($oGrouptopic->isError()){
			$this->E($oGrouptopic->getErrorMessage());
		}

		$this->S(Dyhb::L('发布帖子成功','Controller/Grouptopic'));
	}

}
