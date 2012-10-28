<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   鍓嶅彴鐢ㄦ埛娉ㄥ唽($)*/

!defined('DYHB_PATH') && exit;

// 瀵煎叆绀句細鍖栫櫥褰曠粍浠�
Dyhb::import(NEEDFORBUG_PATH.'/source/extension/socialization');

class RegisterController extends Controller{

	public function index(){
		if($GLOBALS['___login___']!==false){
			$this->assign('__JumpUrl__',__APP__);
			$this->E(Dyhb::L('浣犲凡缁忕櫥褰�,'Controller/Public'));
		}
		
		if($GLOBALS['_option_']['disallowed_register']){
			$this->E(Dyhb::L('绯荤粺鍏抽棴浜嗙敤鎴锋敞鍐�,'Controller/Public'));
		}

		$this->assign('nDisplaySeccode',$GLOBALS['_option_']['seccode_register_status']);

		$this->display('public+register');
	}

	public function register_title_(){
		return '娉ㄥ唽';
	}

	public function register_keywords_(){
		return $this->register_title_();
	}

	public function register_description_(){
		return $this->register_title_();
	}
	
	public function check_user(){
		$sUserName=trim(strtolower(G::getGpc('user_name')));
		
		$oUser=Dyhb::instance('UserModel');
		if($oUser->isUsernameExists($sUserName)===true){
			echo 'false';
		}else{
			echo 'true';
		}
	}
	
	public function check_email(){
		$sUserEmail=trim(strtolower(G::getGpc('user_email')));
		
		$oUser=Dyhb::instance('UserModel');
		if(!empty($sUserEmail) && $oUser->isUseremailExists($sUserEmail)===true){
			echo 'false';
		}else{
			echo 'true';
		}
	}
	
	public function register_user(){
		if($GLOBALS['___login___']!==false){
			$this->E(Dyhb::L('浣犲凡缁忕櫥褰曚細鍛�涓嶈兘閲嶅娉ㄥ唽','Controller/Public'));
		}
		
		if($GLOBALS['_option_']['disallowed_register']){
			$this->E(Dyhb::L('绯荤粺鍏抽棴浜嗙敤鎴锋敞鍐�,'Controller/Public'));
		}
		
		if($GLOBALS['_option_']['seccode_register_status']==1){
			$this->check_seccode(true);
		}
		
		$sPassword=trim(G::getGpc('user_password','P'));
		if(!$sPassword || $sPassword !=G::addslashes($sPassword)){
			$this->E(Dyhb::L('瀵嗙爜绌烘垨鍖呭惈闈炴硶瀛楃','Controller/Public'));
		}
		if(strpos($sPassword,"\n")!==false || strpos($sPassword,"\r")!==false || strpos($sPassword,"\t")!==false){
			$this->E(Dyhb::L('瀵嗙爜鍖呭惈涓嶅彲鎺ュ彈瀛楃','Controller/Public'));
		}
		
		$sUsername=trim(G::getGpc('user_name','P'));
		$sDisallowedRegisterUser=trim($GLOBALS['_option_']['disallowed_register_user']);
		$sDisallowedRegisterUser='/^('.str_replace(array('\\*',"\r\n",' '),array('.*','|',''),preg_quote(($sDisallowedRegisterUser=trim($sDisallowedRegisterUser)),'/')).')$/i';
		if($sDisallowedRegisterUser && @preg_match($sDisallowedRegisterUser,$sUsername)){
			$this->E(Dyhb::L('鐢ㄦ埛鍚嶅寘鍚绯荤粺灞忚斀鐨勫瓧绗�,'Controller/Public'));
		}
		
		$arrNameKeys=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','$','(',')','%','@','+','?',';','^');
		foreach($arrNameKeys as $sNameKeys){
			if(strpos($sUsername,$sNameKeys)!==false){
				$this->E(Dyhb::L('姝ょ敤鎴峰悕鍖呭惈涓嶅彲鎺ュ彈瀛楃鎴栬绠＄悊鍛樺睆钄�璇烽�鎷╁叾瀹冪敤鎴峰悕','Controller/Public'));
			}
		}
		
		$sUseremail=trim(G::getGpc('user_email','P'));
		$sDisallowedRegisterEmail=trim($GLOBALS['_option_']['disallowed_register_email']);
		if($sDisallowedRegisterEmail){
			$arrDisallowedRegisterEmail=explode("\n",$sDisallowedRegisterEmail);
			$arrDisallowedRegisterEmail=Dyhb::normalize($arrDisallowedRegisterEmail);
			if(in_array($sUseremail,$arrDisallowedRegisterEmail)){
				$this->E(Dyhb::L('浣犳敞鍐岀殑閭欢鍦板潃%s宸茬粡琚畼鏂瑰睆钄�,'Controller/Public',null,$sUseremail));
			}
		}
		
		$sAllowedRegisterEmail=trim($GLOBALS['_option_']['disallowed_register_email']);
		if($sAllowedRegisterEmail){
			$arrAllowedRegisterEmail=explode("\n",$sAllowedRegisterEmail);
			$arrAllowedRegisterEmail=Dyhb::normalize($arrAllowedRegisterEmail);
			if(!in_array($sUseremail,$arrAllowedRegisterEmail)){
				$this->E(Dyhb::L('浣犳敞鍐岀殑閭欢鍦板潃%s涓嶅湪绯荤粺鍏佽鐨勯偖浠朵箣鍒�,'Controller/Public',null,$sUseremail));
			}
		}
		
		$oUser=new UserModel();
		if($GLOBALS['_option_']['audit_register']==0){
			$oUser->user_status=1;
		}
		
		$oUser->save(0);
		if($oUser->isError()){
			$this->E($oUser->getErrorMessage());
		}else{
			$oUserprofile=new UserprofileModel();
			$oUserprofile->user_id=$oUser->user_id;
			$oUserprofile->save(0);

			$oUserCount=new UsercountModel();
			$oUserCount->user_id=$oUser->user_id;
			$oUserCount->save(0);

			$this->cache_site_();

			// 鍒ゆ柇鏄惁缁戝畾绀句細鍖栧笎鍙�
			if(G::getGpc('sociabind','P')==1){
				// 缁戝畾绀句細鍖栫櫥褰曟暟鎹紝浠ヤ究浜庝笅娆＄洿鎺ヨ皟鐢�
				$oSociauser=Dyhb::instance('SociauserModel');
				$oSociauser->processBind($oUser['user_id']);

				if($oSociauser->isError()){
					$this->E($oSociauser->getErrorMessage());
				}

				$arrData=$oUser->toArray();
				$arrData['jumpurl']=Dyhb::U('home://public/sociabind_again');

				$arrSociauser=SociauserModel::F('user_id=?',$arrData['user_id'])->asArray()->getOne();
				Socia::setUser($arrSociauser);
				
				$this->A($arrData,Dyhb::L('缁戝畾鎴愬姛','Controller/Public'),1);

				exit();
			}

			$this->A($oUser->toArray(),Dyhb::L('娉ㄥ唽鎴愬姛','Controller/Public'),1);
		}
	}

	protected function cache_site_(){
		if(!Dyhb::classExists('Cache_Extend')){
			require_once(Core_Extend::includeFile('function/Cache_Extend'));
		}
		Cache_Extend::updateCache("site");
	}

}
