<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   home鍏ュ彛鎺у埗鍣�$)*/

!defined('DYHB_PATH') && exit;

/** 瀵煎叆涓婚〉妯″瀷 */
Dyhb::import(NEEDFORBUG_PATH.'/app/home/App/Class/Model');

class HomemainController extends InitController{

	public function index($sModel=null,$bDisplay=true){
		$sType=trim(G::getGpc('type','G'));

		Core_Extend::loadCache('home_option');

		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		$this->assign('nId',intval(G::getGpc('id','G')));
		$this->assign('arrOptions',$arrOptionData);
		
		$this->display(Admin_Extend::template('home','homeoption/'.($sType?$sType:'index')));
	}

	public function update_option(){
		$arrOptions=G::getGpc('options','P');

		foreach($arrOptions as $sKey=>$val){
			$val=trim($val);
			
			if(in_array($sKey,array('homefreshcomment_limit_num','homefreshchildcomment_limit_num','homefreshchildcomment_list_num'))){
				if($val<1){
					$val=4;
				}
			}
			
			$oOptionModel=HomeoptionModel::F('homeoption_name=?',$sKey)->getOne();
			$oOptionModel->homeoption_value=G::html($val);
			$oOptionModel->save(0,'update');
		}

		HomeCache_Extend::updateCache("option");

		$this->S(Dyhb::L('閰嶇疆鏇存柊鎴愬姛','__APP_ADMIN_LANG__@Controller/Homeoption'));
	}

}
