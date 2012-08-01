<?php
/* [DoYouHaoBaby!] (C)Dianniu From 2010.
   异常捕获($)*/

!defined('DYHB_PATH') && exit;

class DException extends Exception{

	private $_sType;

	public function __construct($sMessage,$nCode=0){
		parent::__construct($sMessage,$nCode);
	}

	public function __toString(){
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

	public function formatException(){
		$arrError=array();
		
		$arrTrace=array_reverse($this->getTrace());

		$this->class=isset($arrTrace['0']['class'])?$arrTrace['0']['class']:'';
		$this->function=isset($arrTrace['0']['function'])?$arrTrace['0']['function']:'';
		
		$sTraceInfo='';

		if($GLOBALS['_commonConfig_']['APP_DEBUG']){
			foreach($arrTrace as $Val){
				$sClass=isset($Val['class'])?$Val['class']:'';
				$this->_sType=$sType=isset($Val['type'])?$Val['type']:'';
				$sFunction=isset($Val['function'])?$Val['function']:'';
				$sFile=isset($Val['file'])?$Val['file']:'';
				$sLine=isset($Val['line'])?$Val['line']:'';
				$args=isset($Val['args'])?$Val['args']:'';

				$sArgsInfo='';
				if(is_array($args)){
					foreach($args as $sK=>$V){
						$sArgsInfo.=($sK!=0?',':'').(is_scalar($V)?strip_tags(var_export($V,true)):gettype($V));
					}
				}

				$sFile=$this->safeFile($sFile);

				$sTraceInfo.="<li>[Line: {$sLine}] {$sFile} - {$sClass}{$sType}{$sFunction}({$sArgsInfo})</li>";
			}
			$arrError['trace']=$sTraceInfo;
		}

		$arrError['message']=$this->message;
		$arrError['type']=$this->_sType;
		$arrError['class']=$this->class;
		$arrError['code']=$this->getCode();
		$arrError['function']=$this->function;
		$arrError['line']=$this->line;
		$arrError['file']=$this->safeFile($this->file);

		return $arrError;
	}

	public function safeFile($sFile){
		$sFile=str_replace(G::tidyPath(DYHB_PATH),'{DYHB_PATH}',G::tidyPath($sFile));
		$sFile=str_replace(G::tidyPath(APP_PATH),'{APP_PATH}',G::tidyPath($sFile));

		if(strpos($sFile,':/') || strpos($sFile,':\\') || strpos($sFile,'/')===0){
			$sFile=basename($sFile);
		}

		return $sFile;
	}

}

/** 注册默认异常处理函数 */
set_exception_handler(array('Dyhb','exceptionHandler'));
