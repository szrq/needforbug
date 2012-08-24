<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题样式切换控制器($)*/

!defined('DYHB_PATH') && exit;

class ExtendstyleController extends Controller{

	public function index(){
		$sStyleId=trim(G::getGpc('id','G'));

		// 发送主题COOKIE
		Dyhb::cookie('extend_style_id',$sStyleId);

		if($GLOBALS['___login___']!==false){
			$oUser=UserModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();
			$oUser->user_extendstyle=$sStyleId;
			$oUser->save(0,'update');

			if($oUser->isError()){
				$this->E($oUser->getErrorMessage());
			}
		}

		$this->S(Dyhb::L('主题样式切换成功','Controller/Misc'));
	}

}
