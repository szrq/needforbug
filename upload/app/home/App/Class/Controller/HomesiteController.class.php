<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台站点信息($)*/

!defined('DYHB_PATH') && exit;

class HomesiteController extends InitController{

	public function site(){
		$sName=G::text(G::getGpc('id','G'));
		
		$this->site_($sName);
	}
	
	public function aboutus(){
		$this->site_('aboutus');
	}

	public function contactus(){
		$this->site_('contactus');
	}

	public function agreement(){
		$this->site_('agreement');
	}

	public function privacy(){
		$this->site_('privacy');
	}

	protected function site_($sName){
		$oHomesite=HomesiteModel::F("homesite_name='{$sName}'")->getOne();
		$this->assign('sContent',Core_Extend::replaceSiteVar($oHomesite['homesite_content']));
		$this->assign('sTitle',$oHomesite['homesite_nikename']);
		
		$arrHomesites=HomesiteModel::F()->getAll();
		$this->assign('arrHomesites',$arrHomesites);

		$this->display('homesite+index');
	}

}
