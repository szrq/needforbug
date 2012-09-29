<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   添加帖子入库控制器($)*/

!defined('DYHB_PATH') && exit;

class AddtopicController extends Controller{

	public function index(){
		$oGrouptopic=new GrouptopicModel();
		$oGrouptopic->save(0);

		if($oGrouptopic->isError()){
			$this->E($oGrouptopic->getErrorMessage());
		}

		$sUrl=Dyhb::U('group://grouptopic/view?id='.$oGrouptopic['grouptopic_id']);

		$this->A(array('url'=>$sUrl),'发布帖子成功',1);
	}

}
