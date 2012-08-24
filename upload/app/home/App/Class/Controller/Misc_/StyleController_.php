<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题切换控制器($)*/

!defined('DYHB_PATH') && exit;

class StyleController extends Controller{

	public function index(){
		$nStyleId=intval(G::getGpc('id','G'));
		if(empty($nStyleId)){
			$this->E(Dyhb::L('主题切换失败','Controller/Misc'));
		}

		$oStyle=StyleModel::F('style_id=? AND style_status=1',$nStyleId)->getOne();
		if(empty($oStyle['style_id'])){
			$this->E(Dyhb::L('主题切换失败','Controller/Misc'));
		}

		$oTheme=ThemeModel::F('theme_id=?',$oStyle['theme_id'])->getOne();
		if(empty($oTheme['theme_id'])){
			$this->E(Dyhb::L('主题切换失败','Controller/Misc'));
		}

		$sThemeDir=NEEDFORBUG_PATH.'/ucontent/theme/'.ucfirst(strtolower($oTheme['theme_dirname']));
		if(!is_dir($sThemeDir)){
			$this->E(Dyhb::L('主题切换失败','Controller/Misc'));
		}

		// 发送主题COOKIE
		Dyhb::cookie('style_id',$nStyleId);
		Dyhb::cookie('template',ucfirst(strtolower($oTheme['theme_dirname'])));
		Dyhb::cookie('extend_style_id',$GLOBALS['_style_']['_current_style_']);

		$this->S(Dyhb::L('主题切换成功','Controller/Misc'));
	}

}
