<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   用户新鲜事控制器($)*/

!defined('DYHB_PATH') && exit;

class HomefreshController extends Controller{

	public function index(){
		$arrWhere=array();
		
		$sType=trim(G::getGpc('type','G'));
		if(empty($sType)){
			$sType='';
		}
		$this->assign('sType',$sType);
		
		switch($sType){
			case 'myself':
				$arrWhere['user_id']=$GLOBALS['___login___']['user_id'];
				break;
			case 'friend':
				// 仅好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
				
				if(!empty($arrUserIds)){
					$arrWhere['user_id']=$arrUserIds;
				}else{
					$arrWhere['user_id']='';
				}
				break;
			case 'all':
				// 这里可以设置用户隐私，比如用户不愿意将动态放出
				break;
			default:
				// 我和好友
				$arrUserIds=FriendModel::getFriendById($GLOBALS['___login___']['user_id']);
				$arrUserIds[]=$GLOBALS['___login___']['user_id'];

				if(!empty($arrUserIds)){
					$arrWhere['user_id']=array('in',$arrUserIds);
				}else{
					$arrWhere['user_id']='';
				}
				break;
		}
		
		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		// 新鲜事
		$arrWhere['homefresh_status']=1;
		$nTotalRecord=HomefreshModel::F()->where($arrWhere)->all()->getCounts();

		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homefresh_list_num'],G::getGpc('page','G'));

		$arrHomefreshs=HomefreshModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['homefresh_list_num'])->getAll();
		$this->assign('arrHomefreshs',$arrHomefreshs);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_publish_status']);
		
		$this->display('homefresh+index');
	}

	public function add(){
		if($GLOBALS['_option_']['seccode_publish_status']==1){
			$this->check_seccode(true);
		}

		$sMessage=trim(G::cleanJs(G::getGpc('homefresh_message','P')));
		if(empty($sMessage)){
			$this->E(Dyhb::L('新鲜事内容不能为空','Controller/Homefresh'));
		}
		
		$oHomefresh=new HomefreshModel();
		$oHomefresh->safeInput();
		$oHomefresh->homefresh_status=1;
		$oHomefresh->save(0,'save');

		if($oHomefresh->isError()){
			$this->E($oHomefresh->getErrorMessage());
		}else{
			// 判断是否将新鲜事更新到签名
			if(G::getGpc('synchronized-to-sign','P')==1){
				if(strlen($sMessage)>1000){
					$sMessage=Core_Extend::htmlSubstring($sMessage,1000);
				}
				
				// 更新到前用户的签名信息
				$oUser=UserModel::F('user_id=?',$GLOBALS['___login___']['user_id'])->getOne();
				$oUser->user_sign=$sMessage;
				$oUser->save(0,'update');
		
				if($oUser->isError()){
					$this->E($oUser->getErrorMessage());
				}
			}
			
			$this->S(Dyhb::L('添加新鲜事成功','Controller/Homefresh'));
		}
	}

}
