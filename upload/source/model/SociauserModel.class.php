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

	public function getUser(){
		$sSociacookie=Dyhb::cookie('SOCIAUSER');
		return !empty($sSociacookie)?$sSociacookie:FALSE;
	}

	public function setUser($arrUser){
		Dyhb::cookie('SOCIAUSER',null,-1);
		Dyhb::cookie('SOCIAUSER',$arrUser);
	}

	public function checkBinded(){
		$arrUser=$this->getUser();
		if($arrUser===false){
			return false;
		}



		$oSociauser=self::F('sociauser_userid=? AND sociauser_vendor=?',$arrUser['appid'],$arrUser['vendor'])->getOne();
		
		if(!empty($oSociauser['sociauser_id'])){
			return $oSociauser['user_id'];
		}else{
			return false;
		}
	}

	public function checkLogin(){
		return $GLOBALS['___login___']===FALSE?FALSE:$GLOBALS['___login___']['user_id'];
	}

  public function localLogin($nUserid)
  {
    $oUser=UserModel::F('user_id=?',$nUserid)->getOne();

	if(!empty($oUser['user_id'])){
		echo '登录代码';
	}else{
		return false;
	}
	
	/*$sql="select * from user where id='{$uid}'";
    $result=$this->db->select($sql);
    if($result)
    {
      $_SESSION['user']=array('id'=>$result[0]['id'],'name'=>$result[0]['user_name']);
      return TRUE;
    }else{
      return FALSE;
    }*/
    
  }

	public function bind(){
		$nUserlocal=$this->checkLogin();
		$nUserbinded=$this->checkBinded();


		// 本地用户已绑定
		if($nUserbinded){

			if($nUserlocal){
			

				$oSociauser=SociauserModel::F('user_id=?',$nUserlocal)->getOne();
				
				echo "<img src=\"".$oSociauser->sociauser_img."\"/>";
			}else{
				if($this->localLogin($nUserbinded)){
					//
					echo '登录成功';
				}else{
					echo '登录失败';
				}
			}
		}else{//本地用户未绑定
			if($nUserlocal){
				// 本地用户已登录，进行绑定处理
				$this->processBind($nUserlocal);
			}else{
				//未登录，前往登录页面，登录完成后再次转向绑定页面
				//$this->gotoLogin();
				echo '前往登录';
			}
		}
	}

	public function processBind($nUserid){
		if(empty($nUserid)){
			return FALSE;
		}

		$arrUser=$this->getUser();

		$arrDatasave=array();


		$arrDatasave['sociauser_userid']=$arrUser['appid'];
		$arrDatasave['user_id']=$nUserid;
		$arrDatasave['sociauser_keys']=$arrUser['appkey'];
		$arrDatasave['sociauser_screenname']=$arrDatasave['sociauser_name']=$arrUser['nickname'];
		$arrDatasave['sociauser_gender']=$arrUser['gender'];
$arrDatasave['sociauser_vendor']=$arrUser['vendor'];
 $arrDatasave['sociauser_img']=$arrUser["figureurl"];
 $arrDatasave['sociauser_img1']=$arrUser["figureurl_1"];
 $arrDatasave['sociauser_img2']=$arrUser["figureurl_2"];
		
		$oSociauser=new SociauserModel($arrDatasave);
		$oSociauser->save(0);

		if($oSociauser->isError()){
			$this->setErrorMessage($oSociauser->getErrorMessage());
		}

		  $this->clearCookie();
	  }

  public function clearCookie()
  {

	  Dyhb::cookie('SOCIAUSER',null,-1);
	  Dyhb::cookie('SOCIAKEYS',null,-1);
  }

}
