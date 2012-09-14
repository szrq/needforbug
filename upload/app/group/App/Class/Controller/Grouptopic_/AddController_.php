<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   添加帖子控制器($)*/

!defined('DYHB_PATH') && exit;

class AddController extends Controller{

	public function index(){
		$nGroupid=intval(G::getGpc('gid','G'));

		$oGroup=GroupModel::F('group_id=? AND group_status=1 AND group_isaudit=1',$nGroupid)->getOne();
		if(empty($oGroup->group_id)){
			$this->E(Dyhb::L('小组不存在或者还在审核中','Controller/Grouptopic'));
		}

		if($oGroup->group_isopen==0){
			$oGroupuser=GroupuserModel::F('user_id=? AND group_id=?',$GLOBALS['___login___']['user_id'],$nGroupid)->getOne();
			if(empty($oGroupuser->user_id)){
				$this->E(Dyhb::L('只有该小组成员才能够访问小组','Controller/Grouptopic'));
			}
		}

		if($oGroup->group_ispost==0){
			$oGroupuser=GroupuserModel::F('user_id=? AND group_id=?',$GLOBALS['___login___']['user_id'],$nGroupid)->getOne();
			if(empty($oGroupuser->user_id)){
				$this->E(Dyhb::L('只有该小组成员才能发帖','Controller/Grouptopic'));
			}
		}elseif($oGroup->group_ispost==1){
			$this->E(Dyhb::L('该小组目前拒绝任何人发帖','Controller/Grouptopic'));
		}

		$arrGrouptopiccategorys=array();
		$oGrouptopiccategory=Dyhb::instance('GrouptopiccategoryModel');
		$arrGrouptopiccategorys=$oGrouptopiccategory->grouptopiccategoryByGroupid($nGroupid);

		$this->assign('arrGrouptopiccategorys',$arrGrouptopiccategorys);
		$this->assign('nGroupid',$nGroupid);

		$this->display('grouptopic+add');
	}

}
