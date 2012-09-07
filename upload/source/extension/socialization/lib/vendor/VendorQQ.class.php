<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录QQ登录处理入口($)*/

!defined('DYHB_PATH') && exit;

class VendorQQ extends SociaVendor{

	static $_sSite='QQ';
	static $_sName='腾讯QQ';
	static $_sLogo='';
	protected $_oOauth;
	protected $_oClient;

	public function __construct(){
		parent::__construct(self::$_sSite);
		$this->_oOauth=new QQOauth();
	}

	public function gotoLoginPage(){
		$this->getRequestToken();
	}
	
	public function getRequestToken(){
		$sKeys=getRequestToken($this->_sAppid,$this->_sSecid,$this->_sCallback);
		if($sKeys){
			Socia::setKeys($sKeys);
			gotoAuthorizeURL($this->_sAppid,$this->_sSecid,$sKeys,$this->_sCallback);
			exit();
		}else{
			Dyhb::E('Get Request Token Error.');
		}
	}

	public function getAccessToken($arrArgs=array()){
		if(!empty($arrArgs['oauth_token']) && !empty($arrArgs['oauth_token_secret'])) {
			$sResult=get_access_token($this->_sAppid,$this->_sSecid,$arrArgs['oauth_token'],$arrArgs['oauth_token_secret'],$arrArgs['oauth_vericode']);

			$arrKeys=array() ;
			parse_str($sResult,$arrKeys);
			if(isset($arrKeys['openid'])){
				Socia::setKeys($arrKeys);
				return $arrKeys;
			}else {
				return FALSE;
			}
		}
	}
	
	public function showUser($arrKeys=array()){
		$arrQquser=get_user_info($this->_sAppid,$this->_sSecid,$arrKeys['oauth_token'],$arrKeys['oauth_token_secret'],$arrKeys['openid']);

		if($arrQquser && $arrQquser['ret']==0){
			$arrKeys=Socia::getKeys();
			$arrUser=array(
				'id'=>$arrKeys['openid'],
				'name'=>$arrQquser['nickname'],
				'screen_name'=>$arrQquser['nickname'],
				'desc'=>'',
				'url'=>'',
				'img'=>$arrQquser['figureurl_1'],  /*尺寸 figureurl 30*30,figureurl_1 50*50,figureurl_2 100*100*/
				'gender'=>'',
				'email'=>'',
				'location'=>'',
			);

			return $arrUser;
		}

		return FALSE;
	}

}
