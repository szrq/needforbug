<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题信息模型($)*/

!defined('DYHB_PATH') && exit;

class ThemeModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'theme',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function saveThemeData($arrThemeData,$nThemeId=0){
		$bThemeExists=false;

		if(!empty($nThemeId)){
			$oTryTheme=ThemeModel::F('theme_id=?',$nThemeId)->getOne();
			if(!empty($oTryTheme['theme_id'])){
				$bThemeExists=true;
				$oTryTheme->changeProp($arrThemeData);
				$oTryTheme->save(0,'update');

				if($oTryTheme->isError()){
					$this->setErrorMessage($oTryTheme->getErrorMessage());
				}
			}
		}

		if($bThemeExists===false){
			$oTheme=new ThemeModel($arrThemeData);
			$oTheme->save(0);

			if($oTheme->isError()){
				$this->setErrorMessage($oTheme->getErrorMessage());
			}

			$nThemeId=$oTheme['theme_id'];
		}

		return $nThemeId;
	}

}
