<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   找回密码首页($)*/

!defined('DYHB_PATH') && exit;

class IndexController extends Controller{

	public function index(){
		if(UserModel::M()->isLogin()){
			$this->U('home://spaceadmin/password');
		}
	
		$this->display('getpassword+index');
	}

	public function index_title_(){
		return '找回密码';
	}

	public function index_keywords_(){
		return $this->index_title_();
	}

	public function index_description_(){
		return $this->index_title_();
	}

}
