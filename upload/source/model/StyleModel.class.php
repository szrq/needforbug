<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题模型($)*/

!defined('DYHB_PATH') && exit;

class StyleModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'style',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function saveStyleData($arrStyleData,$nThemeId,$nStyleId=0){
		$bStyleExists=false;

		if(!empty($nStyleId)){
			$oTryStyle=StyleModel::F('style_id=?',$nStyleId)->getOne();
			if(!empty($oTryStyle['style_id'])){
				$bStyleExists=true;
				$oTryStyle->changeProp($arrStyleData);
				$oTryStyle->save(0,'update');

				if($oTryStyle->isError()){
					$this->setErrorMessage($oTryStyle->getErrorMessage());
				}
			}
		}

		if($bStyleExists===false){
			$oStyle=new StyleModel($arrStyleData);
			$oStyle->save(0);

			if($oStyle->isError()){
				$this->setErrorMessage($oStyle->getErrorMessage());
			}
			
			$nStyleId=$oStyle['style_id'];
		}

		return $nStyleId;
	}

}
