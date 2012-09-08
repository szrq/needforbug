<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   QQ互联处理类($)*/

!defined('DYHB_PATH') && exit;

class VendorQq{

	public function login($sAppid,$sScope,$sCallback){
		$GLOBALS['socia']['qq']['state']=md5(uniqid(rand(),TRUE));

		Dyhb::cookie('_socia_state_',$GLOBALS['socia']['qq']['state']);

		$sLoginurl="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=".$sAppid.
			"&redirect_uri=" . urlencode($sCallback).
			"&state=".$GLOBALS['socia']['qq']['state'].
			"&scope=".$sScope;

		G::urlGoTo($sLoginurl);
	}

	public function callback(){
		$sCookieState=Dyhb::cookie('_socia_state_');
		$sState=trim(G::getGpc('state','G'));
		$sCode=trim(G::getGpc('code','G'));
		
		if(!empty($sCookieState) && $sState==$sCookieState){
			if(empty($sCode)){
				$this->E('Empty code');
			}
			
			$sTokenurl="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&".
				"client_id=".$GLOBALS['socia']['qq']["appid"]."&redirect_uri=".urlencode($GLOBALS['socia']['qq']["callback"]).
				"&client_secret=".$GLOBALS['socia']['qq']["appkey"]."&code=".$sCode;

			$sResponse=file_get_contents($sTokenurl);
			if(strpos($sResponse,"callback")!==false){
				$nLpos=strpos($sResponse,"(");
				$nRpos=strrpos($sResponse,")");
				$sResponse=substr($sResponse,$nLpos+1,$nRpos-$nLpos-1);
				$oMsg=json_decode($sResponse);
				if(isset($msg->error)){
					$sErrorMessage="<h3>error:</h3>".$oMsg->error;
					$sErrorMessage.="<h3>msg :</h3>".$oMsg->error_description;
					
					$this->E($sErrorMessage);
				}
			}

			$arrParams=array();
			parse_str($sResponse,$arrParams);

			if(!isset($arrParams['access_token'])){
				Dyhb::E('access_token is empty');
			}

			Dyhb::cookie("access_token",$arrParams['access_token']);

		}else {
			Dyhb::E("The state does not match. You may be a victim of CSRF.");
		}
	}

	public function getOpenid(){
		$sAccesstoken=Dyhb::cookie("access_token");
		$sGraphurl="https://graph.qq.com/oauth2.0/me?access_token=".$sAccesstoken;

		$sStr=file_get_contents($sGraphurl);
		if (strpos($sStr,"callback")!==false){
			$nLpos=strpos($sStr,"(");
			$nRpos=strrpos($sStr,")");
			$sStr=substr($sStr,$nLpos+1,$nRpos-$nLpos-1);
		}

		$oUser=json_decode($sStr);
		if (isset($oUser->error)){
			$sErrorMessage="<h3>error:</h3>".$oUser->error;
			$sErrorMessage.="<h3>msg:</h3>".$oUser->error_description;
			
			Dyhb::E($sErrorMessage);
		}

		// set openid to cookie
		Dyhb::cookie('_socia_openid_',$oUser->openid);
	}

	public function getUserInfo(){
		$sAccesstoken=Dyhb::cookie('access_token');
		$sOpenid=Dyhb::cookie('_socia_openid_');

		$sGetuserinfo="https://graph.qq.com/user/get_user_info?".
			"access_token=".$sAccesstoken.
			"&oauth_consumer_key=".$GLOBALS['socia']['qq']["appid"].
			"&openid=".$sOpenid.
			"&format=json";

		$info=file_get_contents($sGetuserinfo);
		$info=json_decode($info,true);

		return $info;
	}

}
