<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题管理控制器($)*/

!defined('DYHB_PATH') && exit;

class StyleController extends InitController{

	public $_sCurrentStyle='';

	public function index($sName=null,$bDisplay=true){
		$this->assign('sPageNavbar','test');
		$this->display();
	}

	public function install(){
		$this->_sCurrentTheme=$GLOBALS['_option_']['front_theme_name'];
		$this->show_Styles(NEEDFORBUG_PATH.'/ucontent/theme');

		$this->assign('bIsAdmin',false);

		$this->display();
	}

	protected function show_Styles($sStylePath){
		$arrStyles=$this->get_styles($sStylePath);

		$bCurrentStyleIn=true;
		if(!in_array($sStylePath.'/'.$this->_sCurrentStyle,$arrStyles)){
			$arrStyles[]=$sStylePath.'/'.$this->_sCurrentStyle;
			$bCurrentStyleIn=false;
		}

		require_once(Core_Extend::includeFile('class/Style'));

		$oStyle=Dyhb::instance('Style');
		$oStyle->getStyles($arrStyles);

		$arrOkStyles=$oStyle->_arrOkStyles;
		$arrBrokenStyles=$oStyle->_arrBrokenStyles;

		if($bCurrentStyleIn===false){
			unset($arrOkStyles[$this->_sCurrentStyle]);
		}else{
			$this->assign('arrCurrentStyle',$arrOkStyles[$this->_sCurrentStyle]);
		}
G::dump($arrOkStyles);
		$this->assign('arrOkStyles',$arrOkStyles);
		$this->assign('arrBrokenStyles',$arrBrokenStyles);
		$this->assign('nOkStyleNums',count($arrOkStyles));
		$this->assign('nBrokenStyleNums',count($arrBrokenStyles));
		$this->assign('nOkStyleRowNums',ceil(count($arrOkStyles)/3));
	}

	protected function get_Styles($sDir){
		$nEverynum=$GLOBALS['_option_']['admin_theme_list_num'];
		$nPage=intval(G::getGpc('page','G'));

		$oPage=IoPage::RUN($sDir,$nEverynum,$nPage);
		$this->assign('sPageNavbar',$oPage->P());
		$this->assign('nPage',$nPage);

		return $oPage->getCurrentData();
	}

}
