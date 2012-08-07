<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题变量模型($)*/

!defined('DYHB_PATH') && exit;

class StylevarModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'stylevar',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function saveStylevarData($arrStylevariableData,$nStyleId){
		foreach($arrStylevariableData as $sKey=>$sValue){
			$oTryStylevar=self::F('style_variable=? AND style_id=?',$sKey,$nStyleId)->getOne();
			if(!empty($oTryStylevar['stylevar_id'])){
				$oTryStylevar->style_substitute=$sValue;
				$oTryStylevar->save(0,'update');

				if($oTryStylevar->isError()){
					$this->setErrorMessage($oTryStylevar->getErrorMessage());
				}
			}else{
				$oStylevar=new self();
				$oStylevar->style_id=$nStyleId;
				$oStylevar->style_variable=$sKey;
				$oStylevar->style_substitute=$sValue;
				$oStylevar->save(0);

				if($oStylevar->isError()){
					$this->setErrorMessage($oStylevar->getErrorMessage());
				}
			}
		}

		return true;
	}

}
