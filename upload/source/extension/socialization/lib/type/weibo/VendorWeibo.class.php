<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Sina微博处理类($)*/

!defined('DYHB_PATH') && exit;

class VendorWeibo extends Vendor{

	const NAME='weibo';
	protected $_oOauth=null;

	public function __construct(){
		parent::__construct(self::NAME);
		new OauthWeibo();
		$this->_oOauth=new SaeTOAuthV2($this->_arrConfig['sociatype_appid'],$this->_arrConfig['sociatype_appkey']);
	}

	public function login($sAppid,$sScope,$sCallback){
		$sState=md5(uniqid(rand(),TRUE));
		Dyhb::cookie('_socia_state_',$sState);
		
		try{
			$sUrl=$this->_oOauth->getAuthorizeURL($this->_arrConfig['sociatype_callback']);
			G::urlGoTo($sUrl);
		}catch(OAuthException $e){
			$this->setErrorMessage($e->getMessage());
			return false;
		}
	}

	public function callback($sAppid,$sAppkey,$sCallback){
		$sCookieState=Dyhb::cookie('_socia_state_');
		
		if(isset($_REQUEST['code'])){
			$arrKeys= array();
			$arrKeys['code']=$_REQUEST['code'];
			$arrKeys['redirect_uri']=$this->_arrConfig['sociatype_callback'];
			
			try{
				$sToken=$this->_oOauth->getAccessToken('code',$arrKeys);

				if(isset($sToken['error_code']) && $sToken['error_code']>0){
					$sErrorMessage="<h5>Error:</h5>".$sToken['error_code'];
					$sErrorMessage.="<h5>Msg :</h5>".$sToken['error'];

					$this->setErrorMessage($sErrorMessage);
					return false;
				}
			}catch(OAuthException $e){
				$this->setErrorMessage($e->getMessage());
				return false;
			}
		}

		if ($sToken) {
			Dyhb::cookie("_socia_access_token_",$sToken);
			Dyhb::cookie('_socia_weibojs_'.$this->_oOauth->client_id,http_build_query($sToken));
		}
	}

	public function getUserInfo($sAppid){
		if(($this->getAccessToken()===false)){
			return false;
		}
		
		try{
			$oClient=new SaeTClientV2($this->_arrConfig['sociatype_appid'],$this->_arrConfig['sociatype_appkey'],Dyhb::cookie("_socia_access_token_"));
			$ms=$oClient->home_timeline();
			$arrUidget=$oClient->get_uid();

			if(isset($arrUidget['error_code']) && $arrUidget['error_code']>0){
				$sErrorMessage="<h5>Error:</h5>".$arrUidget['error_code'];
				$sErrorMessage.="<h5>Msg :</h5>".$arrUidget['error'];

				$this->setErrorMessage($sErrorMessage);
				return false;
			}
			
			$nUid=$arrUidget['uid'];
			$arrUserMessage=$oClient->show_user_by_id($nUid);

			return $arrUser;
		}catch(OAuthException $e){
			$this->setErrorMessage($e->getMessage());
			return false;
		}
	}

	public function gotoLoginPage(){
		$this->login($this->_sAppid,$this->_arrConfig['sociatype_scope'],$this->_sCallback);
	}

	public function getAccessToken(){
		return $this->callback($this->_sAppid,$this->_sSecid,$this->_sCallback);
	}

	public function showUser($keys=array()){
		$arrQquser=$this->getUserInfo($this->_sAppid);

		if($arrQquser && $arrQquser['ret']==0){
			$arrKeys=Socia::getKeys();

			$arrSaveData=array();
			$arrSaveData['sociauser_appid']=$this->_sAppid;
			$arrSaveData['sociauser_openid']=Dyhb::cookie('_socia_openid_');
			$arrSaveData['sociauser_vendor']=$this->_sVendor;
			$arrSaveData['sociauser_keys']=$this->_sSecid;
			$arrSaveData['sociauser_gender']=$arrQquser['gender'];
			$arrSaveData['sociauser_name']=$arrQquser['nickname'];
			$arrSaveData['sociauser_nikename']=$arrQquser['nickname'];
			$arrSaveData['sociauser_desc']=$arrQquser['msg'];
			$arrSaveData['sociauser_img']=$arrQquser['figureurl'];
			$arrSaveData['sociauser_img1']=$arrQquser['figureurl_1'];
			$arrSaveData['sociauser_img2']=$arrQquser['figureurl_2'];
			$arrSaveData['sociauser_vip']=$arrQquser['vip'];
			$arrSaveData['sociauser_level']=$arrQquser['level'];
			
			return $arrSaveData;
		}

		return FALSE;
	}

}
