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
		$this->_sCurrentStyle=$GLOBALS['_option_']['front_theme_name'];
		$this->show_Styles(NEEDFORBUG_PATH.'/ucontent/theme');

		$this->display();
	}

	public function get_style_url($arrStyle,$sType='preview'){
		return __ROOT__.'/ucontent/theme/'.$arrStyle['Style'].'/'.$arrStyle[$sType];
	}

	public function install_new(){
		$sStyle=ucfirst(strtolower(trim(G::getGpc('style','G'))));

		if(empty($sStyle)){
			$this->E(Dyhb::L('你没有指定要安装的主题','Controller/Style'));
		}

		$sThemeXml=NEEDFORBUG_PATH.'/ucontent/theme/'.$sStyle.'/needforbug_style_'.strtolower($sStyle).'.xml';
		if(!is_file($sThemeXml)){
			$this->E(Dyhb::L('你要安装的主题 %s 的样式表不存在','Controller/Style',null,$sThemeXml));
		}

		$arrStyleData=Xml::xmlUnserialize(file_get_contents($sThemeXml));
		if(empty($arrStyleData)){
			$this->E(Dyhb::L('你要安装的主题 %s 的样式表可能已经损坏，系统无法读取其数据','Controller/Style',null,$sThemeXml));
		}else{
			$arrStyleData=$arrStyleData['root']['data'];
		}

		// 写入模板数据
		$nThemeId=isset($arrStyleData['template_id'])?intval($arrStyleData['template_id']):0;
		$arrSaveThemeData=array(
			'theme_name'=>$arrStyleData['template_name'],
			'theme_dirname'=>$arrStyleData['template_dirname'],
			'theme_directory'=>$arrStyleData['directory'],
			'theme_copyright'=>$arrStyleData['copyright'],
		);
		
		$oTheme=Dyhb::instance('ThemeModel');
		$nThemeId=$oTheme->saveThemeData($arrSaveThemeData,$nThemeId);

		if($oTheme->isError()){
			$this->E($oTheme->getErrorMessage());
		}

		// 写入主题数据
		$nStyleId=isset($arrStyleData['style_id'])?intval($arrStyleData['style_id']):0;
		$arrSaveStyleData=array(
			'style_name'=>$arrStyleData['name'],
			'style_status'=>isset($arrStyleData['status'])?intval($arrStyleData['status']):0,
			'template_id'=>$nThemeId,
			'style_extend'=>$arrStyleData['style_extend'],
		);

		$oStyle=Dyhb::instance('StyleModel');
		$nStyleId=$oStyle->saveStyleData($arrSaveStyleData,$nThemeId,$nStyleId);

		if($oStyle->isError()){
			$this->E($oStyle->getErrorMessage());
		}

		// 写入主题变量数据
		$arrSaveStylevariableData=$arrStyleData['style'];

		$oStylevar=Dyhb::instance('StylevarModel');
		$oStylevar->saveStylevarData($arrSaveStylevariableData,$nStyleId);

		if($oStylevar->isError()){
			$this->E($oStylevar->getErrorMessage());
		}
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

		$this->assign('arrOkStyles',$arrOkStyles);
		$this->assign('arrBrokenStyles',$arrBrokenStyles);
		$this->assign('nOkStyleNums',count($arrOkStyles));
		$this->assign('nBrokenStyleNums',count($arrBrokenStyles));
		$this->assign('nOkStyleRowNums',ceil(count($arrOkStyles)/2));
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
