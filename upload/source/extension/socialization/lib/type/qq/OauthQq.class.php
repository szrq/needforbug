<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   QQ互联API处理类($)*/

!defined('DYHB_PATH') && exit;

class OauthQq extends Oauth{

	public function __construct(){
		parent::__construct();
	}

	public function login($sAppid,$sScope,$sCallback,$sState){
		$sLoginurl="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$sAppid.
			"&redirect_uri=".urlencode($sCallback).
			"&state=".$sState.
			"&scope=".$sScope;

		G::urlGoTo($sLoginurl);
	}

	public function callback($sAppid,$sAppkey,$sCallback,$sCookieState){
		$sState=trim(G::getGpc('state','G'));
		$sCode=trim(G::getGpc('code','G'));
		
		if(!empty($sCookieState) && $sState==$sCookieState){
			if(empty($sCode)){
				$this->setErrorMessage('Empty QQ callback code');
				return false;
			}
			
			$sTokenurl="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&".
				"client_id=".$sAppid."&redirect_uri=".urlencode($sCallback).
				"&client_secret=".$sAppkey."&code=".$sCode;

			$sResponse=$this->file_get_contents($sTokenurl);
			if(strpos($sResponse,"callback")!==false){
				$nLpos=strpos($sResponse,"(");
				$nRpos=strrpos($sResponse,")");
				$sResponse=substr($sResponse,$nLpos+1,$nRpos-$nLpos-1);
				$oMsg=json_decode($sResponse);
				if(isset($oMsg->error)){
					$sErrorMessage="<h5>Error:</h5>".$oMsg->error;
					$sErrorMessage.="<h5>Msg :</h5>".$oMsg->error_description;
					
					$this->setErrorMessage($sErrorMessage);
					return false;
				}
			}

			$arrParams=array();
			parse_str($sResponse,$arrParams);

			if(!isset($arrParams['access_token'])){
				$this->setErrorMessage('access_token is empty');
				return false;
			}

			Dyhb::cookie("_socia_access_token_",$arrParams['access_token']);
		}else{
			$this->setErrorMessage("The state does not match. You may be a victim of CSRF.");
			return false;
		}
	}

	public function getOpenid(){
		$sAccesstoken=Dyhb::cookie("_socia_access_token_");
		$sGraphurl="https://graph.qq.com/oauth2.0/me?access_token=".$sAccesstoken;

		$sStr=$this->file_get_contents($sGraphurl);
		if(empty($sStr)){
			$this->setErrorMessage('Empty openid result');
			return false;
		}
		
		if(strpos($sStr,"callback")!==false){
			$nLpos=strpos($sStr,"(");
			$nRpos=strrpos($sStr,")");
			$sStr=substr($sStr,$nLpos+1,$nRpos-$nLpos-1);
		}

		$oUser=json_decode($sStr);
		if(isset($oUser->error)){
			$sErrorMessage="<h5>Error:</h5>".$oUser->error;
			$sErrorMessage.="<h5>Msg:</h5>".$oUser->error_description;
			
			$this->setErrorMessage($sErrorMessage);
			return false;
		}

		// set openid to cookie
		Dyhb::cookie('_socia_openid_',$oUser->openid);
	}

	public function getUserInfo($sAppid){
		$sAccesstoken=Dyhb::cookie('_socia_access_token_');
		$sOpenid=Dyhb::cookie('_socia_openid_');

		$sGetuserinfo="https://graph.qq.com/user/get_user_info?".
			"access_token=".$sAccesstoken.
			"&oauth_consumer_key=".$sAppid.
			"&openid=".$sOpenid.
			"&format=json";

		$info=$this->file_get_contents($sGetuserinfo);
		$info=json_decode($info,true);

		return $info;
	}

}
