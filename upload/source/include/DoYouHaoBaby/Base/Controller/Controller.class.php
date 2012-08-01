<?php
/* [DoYouHaoBaby!] (C)Dianniu From 2010.
   控制器($)*/

!defined('DYHB_PATH') && exit;

class Controller{

	protected $_oView=null;

	public function __construct(){
		$this->_oView=new View($this);
	}

	public function init__(){}

	public function assign($Name,$Value=''){
		$this->_oView->assign($Name,$Value);
	}

	public function __set($Name,$Value){
		$this->assign($Name,$Value);
	}

	public function get($sName){
		$sValue=$this->_oView->get($sName);

		return $sValue;
	}

	public function &__get($sName){
		$value=$this->get($sName);

		return $value;
	}

	public function display($sTemplateFile='',$sCharset='utf-8',$sContentType='text/html',$bReturn=false){
		return $this->_oView->display($sTemplateFile,$sCharset,$sContentType,$bReturn);
	}

	protected function G($sName,$sViewName=null){
		$value=$this->_oView->getVar($sName);

		return $value;
	}

	protected function isAjax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if('xmlhttprequest'==strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])){return true;}
		}

		if(!empty($_POST['ajax']) || !empty($_GET['ajax'])){
			return true;
		}

		return false;
	}

	protected function E($sMessage='',$bAjax=FALSE){
		$this->J($sMessage,0,$bAjax);
	}

	protected function S($sMessage,$bAjax=FALSE){
		$this->J($sMessage,1,$bAjax);
	}

	protected function A($Data,$sInfo='',$nStatus=1,$sType=''){
		$arrResult=array();

		$arrResult['status']=$nStatus;
		$arrResult['info']=$sInfo?$sInfo:Dyhb::L('Ajax未指定返回消息','__DYHB__@Dyhb');
		$arrResult['data']=$Data;

		if(empty($sType)){
			$sType=$GLOBALS['_commonConfig_']['DEFAULT_AJAX_RETURN'];
		}
		$arrResult['type']=$sType;

		if(strtoupper($sType)=='JSON'){// 返回JSON数据格式到客户端 包含状态信息
			header("Content-Type:text/html; charset=utf-8");
			exit(json_encode($arrResult));
		}elseif(strtoupper($sType)=='XML'){// 返回xml格式数据
			header("Content-Type:text/xml; charset=utf-8");
			exit(G::xmlEncode($arrResult));
		}elseif(strtoupper($sType)=='EVAL'){// 返回可执行的js脚本
			header("Content-Type:text/html; charset=utf-8");
			exit($Data);
		}else{}
	}

	protected function U($sUrl,$arrParams=array(),$nDelay=0,$sMsg=''){
		$sUrl=Dyhb::U($sUrl,$arrParams);
		G::urlGoTo($sUrl,$nDelay,$sMsg);
	}

	private function J($sMessage,$nStatus=1,$bAjax=FALSE){
		// 判断是否为AJAX返回
		if($bAjax || $this->isAjax()){
			$this->A('',$sMessage,$nStatus);
		}

		// 提示标题
		if(!$this->G('__MessageTitle__')){
			$this->assign('__MessageTitle__',$nStatus?Dyhb::L('操作成功','__DYHB__@Dyhb'):Dyhb::L('操作失败','__DYHB__@Dyhb'));
		}

		// 关闭窗口
		if($this->G('__CloseWindow__')){
			$this->assign('__JumpUrl__','javascript:window.close();');
		}

		// 消息图片
		$sLoaderImg=file_exists(TEMPLATE_PATH.'/Public/Images/loader.gif')?__TMPL__.'/Public/Images/loader.gif':
			__THEME__.'/Default/Public/Images/loader.gif';
		$sInfobigImg=file_exists(TEMPLATE_PATH.'/Public/Images/info_big.gif')?__TMPL__.'/Public/Images/info_big.gif':
			__THEME__.'/Default/Public/Images/info_big.gif';
		$sErrorbigImg=file_exists(TEMPLATE_PATH.'/Public/Images/error_big.gif')?__TMPL__.'/Public/Images/error_big.gif':
			__THEME__.'/Default/Public/Images/error_big.gif';
		$this->assign('__LoadingImg__',$sLoaderImg);
		$this->assign('__InfobigImg__',$sInfobigImg);
		$this->assign('__ErrorbigImg__',$sErrorbigImg);

		// 状态
		$this->assign('__Status__',$nStatus);
		if($nStatus){
			$this->assign('__Message__',$sMessage);// 提示信息
		}else{
			$this->assign('__ErrorMessage__',$sMessage);
		}

		$arrInit=array();

		if($nStatus){
			if(!$this->G('__WaitSecond__')){// 成功操作后默认停留1秒
				$this->assign('__WaitSecond__',1);
				$arrInit['__WaitSecond__']=1;
			}else{
				$arrInit['__WaitSecond__']=$this->G('__WaitSecond__');
			}

			if(!$this->G('__JumpUrl__')){// 默认操作成功自动返回操作前页面
				$this->assign('__JumpUrl__',isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'');
				$arrInit['__JumpUrl__']=isset($_SERVER["HTTP_REFERER"])? $_SERVER["HTTP_REFERER"]:'';
			}else{
				$arrInit['__JumpUrl__']=$this->G('__JumpUrl__');
			}

			$sJavaScript=$this->javascriptR($arrInit);
			$this->assign('__JavaScript__',$sJavaScript);

			$sTemplate=strpos($GLOBALS['_commonConfig_']['TMPL_ACTION_SUCCESS'],'public+')===0 && $GLOBALS['_commonConfig_']['TMPL_MODULE_ACTION_DEPR']=='/'?
				str_replace('public+','Public+',$GLOBALS['_commonConfig_']['TMPL_ACTION_SUCCESS']):
				$GLOBALS['_commonConfig_']['TMPL_ACTION_SUCCESS'];

			$this->display($sTemplate);
		}else{
			if(!$this->G('__WaitSecond__')){// 发生错误时候默认停留3秒
				$this->assign('__WaitSecond__',3);
				$arrInit['__WaitSecond__']=3;
			}else{
				$arrInit['__WaitSecond__']=$this->G('__WaitSecond__');
			}

			if(!$this->G('__JumpUrl__')){// 默认发生错误的话自动返回上页
				if(preg_match('/(mozilla|m3gate|winwap|openwave)/i', $_SERVER['HTTP_USER_AGENT'])){
					$this->assign('__JumpUrl__','javascript:history.back(-1);');
				}else{// 手机
					$this->assign('__JumpUrl__',__APP__);
				}
				$arrInit['__JumpUrl__']='';
			}else{
				$arrInit['__JumpUrl__']=$this->G('__JumpUrl__');
			}

			$sJavaScript=$this->javascriptR($arrInit);
			$this->assign('__JavaScript__',$sJavaScript);

			$sTemplate=strpos($GLOBALS['_commonConfig_']['TMPL_ACTION_ERROR'],'public+')===0 && $GLOBALS['_commonConfig_']['TMPL_MODULE_ACTION_DEPR']=='/'?
				str_replace('public+','Public+',$GLOBALS['_commonConfig_']['TMPL_ACTION_ERROR']):
				$GLOBALS['_commonConfig_']['TMPL_ACTION_ERROR'];

			$this->display($sTemplate);
		}

		exit;
	}

	private function javascriptR($arrInit){
		extract($arrInit);
		return "<script type=\"text/javascript\">var nSeconds={$__WaitSecond__};var sDefaultUrl=\"{$__JumpUrl__}\";onload=function(){if((sDefaultUrl=='javascript:history.go(-1)' || sDefaultUrl=='') && window.history.length==0){document.getElementById('__JumpUrl__').innerHTML='';return;};window.setInterval(redirection,1000);};function redirection(){if(nSeconds<=0){window.clearInterval();return;};nSeconds --;document.getElementById('__Seconds__').innerHTML=nSeconds;if(nSeconds==0){document.getElementById('__Loader__').style.display='none';window.clearInterval();if(sDefaultUrl!=''){window.location.href=sDefaultUrl;}}}</script>";
	}

}

class SsmiController extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if(!isset($_REQUEST['param'])){
			$arrParam=array();
			foreach($_REQUEST as $sKey=>$sVal){
				if(preg_match('/^param_(.+)/i',$sKey,$arrRes)){$arrParam[$arrRes[1]]=$sVal;}
			}
		}else{
			$arrParam =array($_REQUEST['param']);
		}

		call_user_func_array(array($_REQUEST['class'],$_REQUEST['method']),$arrParam);
	}

}
