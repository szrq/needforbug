<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录模型($)*/

!defined('DYHB_PATH') && exit;

class SociauserModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'sociauser',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function checkBinded(){
		$arrUser=Socia::getUser();
		if($arrUser===false){
			return false;
		}

		$oSociauser=self::F('sociauser_appid=? AND sociauser_vendor=? AND sociauser_openid=?',$arrUser['sociauser_appid'],$arrUser['sociauser_vendor'],$arrUser['sociauser_openid'])->getOne();
		
		if(!empty($oSociauser['sociauser_id'])){
			return $oSociauser['user_id'];
		}else{
			return false;
		}
	}

	public function checkLogin(){
		return $GLOBALS['___login___']===FALSE?FALSE:$GLOBALS['___login___']['user_id'];
	}



public function processBind($nUserid){
		if(empty($nUserid)){
			return FALSE;
		}

		$arrUser=Socia::getUser();

		$arrUser['user_id']=$nUserid;

		$oSociauser=new SociauserModel($arrUser);
		$oSociauser->save(0);

		if($oSociauser->isError()){
			$this->setErrorMessage($oSociauser->getErrorMessage());
			return false;
		}

		  Socia::clearCookie();
	  }


}
