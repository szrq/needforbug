<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组控制器($)*/

!defined('DYHB_PATH') && exit;

class GroupController extends InitController{

	public function show(){
		$sId=trim(G::getGpc('id','G'));
		
		$oGroup=GroupModel::F('group_name=? AND group_status=1 AND group_isaudit=1',$sId)->getOne();
		if(empty($oGroup['group_id'])){
			$this->E('小组不存在或者还在审核中');
		}
		
		$this->assign('oGroup',$oGroup);
		
		$this->display('group+show');
	}

}
