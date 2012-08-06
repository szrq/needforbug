<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   好友系统显示($)*/

!defined('DYHB_PATH') && exit;

class FriendController extends InitController{

	public function init__(){
		parent::init__();

		$this->is_login();
	}
	
	public function index(){
		$arrWhere=array();
		
		$sType=trim(G::getGpc('type','G'));
		if($sType=='fan'){
			$arrWhere['friend_friendid']=$GLOBALS['___login___']['user_id'];
		}else{
			$arrWhere['user_id']=$GLOBALS['___login___']['user_id'];;
		}
		
		$sKey=trim(G::getGpc('key'));
		if(!empty($sKey)){
			if($sType=='fan'){
				$arrWhere['friend_username']=array('like',"%".$sKey."%");
			}else{
				$arrWhere['friend_friendusername']=array('like',"%".$sKey."%");
			}
		}
		
		$arrOptionData=$GLOBALS['_cache_']['home_option'];
	
		// 好友
		$arrWhere['friend_status']=1;
		$nTotalRecord=FriendModel::F()->where($arrWhere)->all()->getCounts();
		
		$oPage=Page::RUN($nTotalRecord,$arrOptionData['friend_list_num'],G::getGpc('page','G'));
		
		$arrFriends=FriendModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['friend_list_num'])->getAll();
		$this->assign('arrFriends',$arrFriends);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('sType',$sType);
		$this->assign('sKey',$sKey);
		
		$this->display('friend+index');
	}
	
	public function add(){
		$nUserId=intval(G::getGpc('uid'));
		
		$oFriendModel=Dyhb::instance('FriendModel');
		$oFriendModel->addFriend($nUserId,$GLOBALS['___login___']['user_id']);
		
		if($oFriendModel->isError()){
			$this->E($oFriendModel->getErrorMessage());
		}else{
			$this->S('添加好友成功');
		}
	}
	
	public function delete(){
		$nFriendId=intval(G::getGpc('friendid'));
		$nFan=intval(G::getGpc('fan'));
		
		$oFriendModel=Dyhb::instance('FriendModel');
		$oFriendModel->deleteFriend($nFriendId,$GLOBALS['___login___']['user_id'],$nFan);
		
		if($oFriendModel->isError()){
			$this->E($oFriendModel->getErrorMessage());
		}else{
			$this->S('删除好友成功');
		}
	}
	
	public function edit(){
		$nFriendId=G::getGpc('friendid');
		$sComment=trim(G::getGpc('comment'));
		$nFan=intval(G::getGpc('fan'));

		$oFriendModel=Dyhb::instance('FriendModel');
		$oFriendModel->editFriendComment($nFriendId,$GLOBALS['___login___']['user_id'],$sComment,$nFan);
		
		if($oFriendModel->isError()){
			$this->E($oFriendModel->getErrorMessage());
		}else{
			$this->S('更新备注成功');
		}
	}
	
}
