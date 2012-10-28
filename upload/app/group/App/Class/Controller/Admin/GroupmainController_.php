<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   缇ょ粍閰嶇疆澶勭悊鎺у埗鍣�$)*/

!defined('DYHB_PATH') && exit;

/** 瀵煎叆缇ょ粍妯″瀷 */
Dyhb::import(NEEDFORBUG_PATH.'/app/group/App/Class/Model');

class GroupmainController extends InitController{

	public function index($sModel=null,$bDisplay=true){
		Core_Extend::loadCache('group_option');

		$arrOptionData=$GLOBALS['_cache_']['group_option'];

		$this->assign('nUploadMaxFilesize',ini_get('upload_max_filesize'));
		$this->assign('nUploadSize',Core_Extend::getUploadSize($arrOptionData['group_icon_uploadfile_maxsize']));
		$this->assign('nId',intval(G::getGpc('id','G')));
		$this->assign('arrOptions',$arrOptionData);
		$this->display(Admin_Extend::template('group','groupoption/index'));
	}

	public function update_option(){
		$arrOptions=G::getGpc('options','P');

		foreach($arrOptions as $sKey=>$val){
			$val=trim($val);
			$oOptionModel=GroupoptionModel::F('groupoption_name=?',$sKey)->getOne();
			$oOptionModel->groupoption_value=G::html($val);
			$oOptionModel->save(0,'update');
		}

		GroupCache_Extend::updateCache("option");

		$this->S(Dyhb::L('閰嶇疆鏇存柊鎴愬姛','__APP_ADMIN_LANG__@Controller/Groupoption'));
	}

}
