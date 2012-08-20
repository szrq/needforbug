<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   词语过滤模型($)*/

!defined('DYHB_PATH') && exit;

class BadwordModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'badword',
			'props'=>array(
				'badword_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'badword_id',
			'check'=>array(
				'badword_find'=>array(
					array('require',Dyhb::L('待过滤的词语不能为空','__COMMON_LANG__@Model/Badword')),
				),
			),
			'autofill'=>array(
				array('badword_findpattern','findPattern','all','callback'),
				array('badword_admin','admin','create','callback'),
			),
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function truncateBadword(){
		$oDb=$this->getDb();

		return $oDb->query("TRUNCATE ".$GLOBALS['_commonConfig_']['DB_PREFIX'].'badword');
	}

	public function addBadword($sFind,$sReplacement,$sAdmin,$nType=1){
		if(trim($sFind)){
			$sFind=trim($sFind);
			$sReplacement=trim($sReplacement);
			$sFindpattern=$this->patternFind($sFind);
			$arrBadwordData=array(
				'badword_find'=>$sFind ,
				'badword_replacement'=>$sReplacement,
				'badword_admin'=>$sAdmin,
				'badword_findpattern'=>$sFindpattern,
			);

			$oBadword=new self($arrBadwordData);
			$oBadword->setAutofill(false);
			if($nType==1){
				$oBadword->save(0,'replace');
			}elseif($nType==2){
				$oBadword->save(0);
			}

			if($oBadword->isError()){
				$this->setErrorMessage($oBadword->getErrorMessage());
				return false;
			}
		}

		return $oBadword->badword_id;
	}

	protected function findPattern(){
		return $this->patternFind(G::getGpc('badword_find','P'));
	}

	protected function admin(){
		$arrUserData=$GLOBALS['___login___'];

		return $arrUserData['user_name'];
	}

	protected function patternFind($sFind){
		$sFind=preg_quote($sFind,"/'");
		$sFind=str_replace("\\","\\\\",$sFind);
		$sFind=str_replace("'","\\'",$sFind);

		return '/'.preg_replace("/\\\{(\d+)\\\}/",".{0,\\1}",$sFind).'/is';
	}

}
