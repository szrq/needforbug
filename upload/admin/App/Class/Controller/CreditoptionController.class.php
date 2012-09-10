<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   积分设置控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入积分相关函数 */
require_once(Core_Extend::includeFile('function/Credit_Extend'));

class CreditoptionController extends OptionController{

	public function index($sModel=null,$bDisplay=true){
		$arrOptionData=$GLOBALS['_option_'];

		$arrExtendCredits=unserialize($GLOBALS['_option_']['extend_credit']);

		$this->assign('arrOptions',$arrOptionData);
		$this->assign('arrExtendCredits',$arrExtendCredits);
		
		$this->display();
	}

	public function update_option(){
		$arrExtendCredits=$_POST['options']['extend_credit'];

		$arrSaveExtendCredits=array();
		foreach($arrExtendCredits as $sKey=>$arrExtendCredit){
			if(!isset($arrExtendCredit['title'])){
				$arrExtendCredit['title']='';
			}

			foreach(array('available','unit','initcredits','lowerlimit','ratio','allowexchangein','allowexchangeout') as $sValue){
				if(!isset($arrExtendCredit[$sValue]) || $arrExtendCredit[$sValue]<0){
					$arrExtendCredit[$sValue]=0;
				}

				$arrExtendCredit[$sValue]=intval($arrExtendCredit[$sValue]);
			}

			if($arrExtendCredit['available']==1 && !$arrExtendCredit['title']){
				$this->E(Dyhb::L('启用的积分名称不能为空','Controller/Creditoption'));
			}

			$arrSaveExtendCredits[$sKey]=$arrExtendCredit;
		}

		$oOptionModel=OptionModel::F('option_name=?','extend_credit')->getOne();
		$oOptionModel->option_value=serialize($arrSaveExtendCredits);
		$oOptionModel->save(0,'update');

		unset($_POST['options']['extend_credit']);

		$this->cache_creditrule();
		
		parent::update_option();
	}

	public function policytable(){
		$arrWhere=array();

		$nTotalRecord=CreditruleModel::F()->where($arrWhere)->all()->getCounts();

		$nEverynum=$GLOBALS['_option_']['admin_list_num'];

		$oPage=Page::RUN($nTotalRecord,$nEverynum,G::getGpc('page','G'));

		$arrCreditrules=CreditruleModel::F()->where($arrWhere)->all()->order('creditrule_id ASC')->limit($oPage->returnPageStart(),$nEverynum)->query();

		$this->assign('sPageNavbar',$oPage->P());
		$this->assign('arrCreditrules',$arrCreditrules);

		$arrAvailableExtendCredits=array();
		$arrAvailableExtendCredits=Credit_Extend::getAvailableExtendCredits();

		$this->assign('arrAvailableExtendCredits',$arrAvailableExtendCredits);
		
		$this->display();
	}

	public function edit($sModel=null,$nId=null,$bDidplay=true){
		$nId=intval(G::getGpc('id','G'));

		if(!empty($nId)){
			$oCreditruleModel=CreditruleModel::F('creditrule_id=?',$nId)->query();

			if(!empty($oCreditruleModel['creditrule_id'])){
				$this->assign('oValue',$oCreditruleModel);
				$this->assign('nId',$nId);
				
				$arrAvailableExtendCredits=array();
				$arrAvailableExtendCredits=Credit_Extend::getAvailableExtendCredits();

				$this->assign('arrAvailableExtendCredits',$arrAvailableExtendCredits);
				
				$this->display('creditoption+edit');
			}else{
				$this->E(Dyhb::L('数据库中并不存在该项，或许它已经被删除','Controller/Common'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}

	public function update($sModel=null,$nId=null){
		$nId=G::getGpc('id');

		for($nI=1;$nI<=8;$nI++){
			$sCreditType='creditrule_extendcredit'.$nI;

			if(isset($_POST[$sCreditType])){
				if(!Credit_Extend::checkCredit($_POST[$sCreditType])){
					$this->E(Dyhb::L('各项积分增减允许的范围为 -99～+99','Controller/Creditoption'));
				}else{
					$_POST[$sCreditType]=intval($_POST[$sCreditType]);
				}
			}
		}
		
		$oCreditruleModel=CreditruleModel::F('creditrule_id=?',$nId)->query();
		$oCreditruleModel->save(0,'update');

		if(!$oCreditruleModel->isError()){
			$this->cache_creditrule();

			$this->S(Dyhb::L('数据更新成功','Controller/Common'));
		}else{
			$this->E($oCreditruleModel->getErrorMessage());
		}
	}

	protected function cache_creditrule(){
		if(!Dyhb::classExists('Cache_Extend')){
			require_once(Core_Extend::includeFile('function/Cache_Extend'));
		}
		Cache_Extend::updateCacheCreditrule();
	}

}
