<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   主题管理控制器($)*/

!defined('DYHB_PATH') && exit;

class StyleController extends InitController{

	public $_sCurrentStyle='';

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
			$this->E(Dyhb::L('你要安装的主题 %s 样式表不存在','Controller/Style',null,$sThemeXml));
		}

		$arrStyleData=Xml::xmlUnserialize(file_get_contents($sThemeXml));
		if(empty($arrStyleData)){
			$this->E(Dyhb::L('你要安装的主题 %s 样式表可能已经损坏，系统无法读取其数据','Controller/Style',null,$sThemeXml));
		}else{
			$arrStyleData=$arrStyleData['root']['data'];
		}

		// 写入模板数据
		$nThemeId=isset($arrStyleData['template_id'])?intval($arrStyleData['template_id']):0;
		$arrSaveThemeData=array(
			'theme_name'=>$arrStyleData['theme_name'],
			'theme_dirname'=>$arrStyleData['theme_dirname'],
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
			'theme_id'=>$nThemeId,
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

		$this->S(Dyhb::L('主题 %s 安装成功','Controller/Style',null,$sStyle));
	}

	public function bEdit_(){
		$arrThemes=ThemeModel::F()->getAll();
		
		$arrStylevars=StylevarModel::F('style_id=?',intval(G::getGpc('id','G')))->getAll();
		$arrCustomStylevar=$arrSystemStylevar=array();

		$arrCurtomStylevarList=(array)(include NEEDFORBUG_PATH.'/Source/Common/Style.php');
		foreach($arrStylevars as $oStylevar){
			if(!in_array(strtolower($oStylevar['stylevar_variable']),$arrCurtomStylevarList)){
				$arrCustomStylevar[$oStylevar['stylevar_variable']]=$oStylevar['stylevar_substitute'];
			}else{
				$arrSystemStylevar[$oStylevar['stylevar_variable']]=$oStylevar['stylevar_substitute'];
			}
		}

		// 系统图片目录变量
		$sImgdir=$sStyleimgdir='';
		if(!empty($arrSystemStylevar['img_dir'])){
			$sImgdir=$arrSystemStylevar['img_dir'];
		}else{
			$sImgdir='theme/Default/Public/Images';
		}

		if(!empty($arrSystemStylevar['stylevar_img_dir'])){
			$sStyleimgdir=$arrSystemStylevar['stylevar_img_dir'];
		}else{
			$sStyleimgdir=$sImgdir;
		}

		$this->assign('arrThemes',$arrThemes);
		$this->assign('arrCustomStylevar',$arrCustomStylevar);
		$this->assign('arrSystemStylevar',$arrSystemStylevar);
		$this->assign('sImgdir',$sImgdir);
		$this->assign('sStyleimgdir',$sStyleimgdir);
	}

	public function AEditObject_($oModel){
		if(!empty($oModel->style_id)){
			$this->assign('oValue',$oModel);
			$this->assign('nId',$oModel['style_id']);

			
			// 读取扩展配色
			$arrExtendstyle=$arrDefaultextendstyle=array();

			$oTheme=ThemeModel::F('theme_id=?',$oModel['theme_id'])->getOne();
			if(!empty($oTheme['theme_id'])){
				$sStyleExtendDir=NEEDFORBUG_PATH.'/ucontent/'.$oTheme['theme_directory'].'/Public/Style';
				if(is_dir($sStyleExtendDir)){
					$arrStyleDirs=G::listDir($sStyleExtendDir);

					$arrDefaultextendstyle[]=array('',Dyhb::L('默认','Controller/Style'));
					
					foreach($arrStyleDirs as $sStyleDir){
						$sExtendStylefile=$sStyleExtendDir.'/'.$sStyleDir.'/style.css';

						if(file_exists($sExtendStylefile)){
							$sContent=file_get_contents($sExtendStylefile);

							if(preg_match('/\[name\](.+?)\[\/name\]/i',$sContent,$arrResult1) && 
								preg_match('/\[iconbgcolor](.+?)\[\/iconbgcolor]/i',$sContent,$arrResult2))
							{
								$arrExtendstyle[]=array($sStyleDir,'<em style="background:'.$arrResult2[1].'">&nbsp;&nbsp;&nbsp;&nbsp;</em> '.$arrResult1[1]);
								$arrDefaultextendstyle[]=array($sStyleDir,$arrResult1[1]);
							}
						}
					}
				}
			}

			$arrStyleExtendOption=explode('|',$oModel->style_extend);

			if(empty($arrStyleExtendOption[1])){
				$sStyleExtendcolor='';
			}else{
				$sStyleExtendcolor=$arrStyleExtendOption[1];
			}

			$arrStyleExtendcolors=explode("\t",$arrStyleExtendOption[0]);

			$this->assign('arrExtendstyle',$arrExtendstyle);
			$this->assign('arrDefaultextendstyle',$arrDefaultextendstyle);
			$this->assign('sStyleExtendcolor',$sStyleExtendcolor);
			$this->assign('arrStyleExtendcolors',$arrStyleExtendcolors);

			$nAdv=intval(G::getGpc('adv','G'));
			if($nAdv==1){
				$this->display('style+adv_diy');
			}else{
				$this->display('style+diy');
			}
			exit();
		}else{
			$this->E(Dyhb::L('数据库中并不存在该项，或许它已经被删除','Controller/Common'));
		}
	}

	public function get_img($sImg,$sStyleimgdir){
		return $sImg?($this->check_http($sImg)?$sImg:__ROOT__.'/ucontent/'.$sStyleimgdir.'/'.$sImg):__PUBLIC__.'/images/common/none.gif';
	}

	protected function check_http($sUrl){
		$sRe='|^http://|';

		if(preg_match($sRe,$sUrl)){
			return true;
		}else{
			return false;
		}
	}

	public function diy_save(){
		$nStyleId=intval(G::getGpc('style_id','P'));

		if(!empty($nStyleId)){
			$oStyle=StyleModel::F('style_id=?',$nStyleId)->getOne();
			if(!empty($oStyle['style_id'])){
				$oStyle->style_name=trim(G::getGpc('name_new','P'));
				$oStyle->theme_id=intval(G::getGpc('theme_id_new','P'));
				
				$arrStyleextend=G::getGpc('style_extend_new','P');
				$sDefaultExtendstyle=trim(G::getGpc('default_extend_style_new','P'));
				if(!in_array($sDefaultExtendstyle,$arrStyleextend)){
					$arrStyleextend[]=$sDefaultExtendstyle;
				}

				$sStyleExtend=implode("\t",$arrStyleextend).'|'.$sDefaultExtendstyle;
				$oStyle->style_extend=trim($sStyleExtend);

				$oStyle->save(0,'update');

				if($oStyle->isError()){
					$this->E($oStyle->getErrorMessage());
				}

				$arrStylevars=G::getGpc('stylevar','P');

				// 删除
				$arrKeys=G::getGpc('key','P');

				if(!empty($arrKeys)){
					$arrWhere=array();
					$arrWhere['style_id']=$oStyle['style_id'];
					$arrWhere['stylevar_variable']=array('in',$arrKeys);
					foreach($arrKeys as $sKey){
						if(isset($arrStylevars[$sKey])){
							unset($arrStylevars[$sKey]);
						}
					}

					StylevarModel::M()->deleteWhere($arrWhere);
				}

				// 新增
				$sVariableNew=strtolower(trim(G::getGpc('variable_new','P')));
				$sSubstituteNew=strtolower(trim(G::getGpc('substitute_new','P')));
				if($sVariableNew){
					// 判断是否存在
					$arrExistsStylevar=array_keys($arrStylevars);
					if(!in_array($sVariableNew,$arrExistsStylevar)){
						$oNewStylevar=new StylevarModel();
						$oNewStylevar->stylevar_variable=$sVariableNew;
						$oNewStylevar->stylevar_substitute=$sSubstituteNew;
						$oNewStylevar->save(0);

						if($oNewStylevar->isError()){
							$this->E($oNewStylevar->getErrorMessage());
						}
					}
				}

				// 更新当前主题变量
				$oStylevar=Dyhb::instance('StylevarModel');
				$oStylevar->saveStylevarData($arrStylevars,$oStyle['style_id']);

				if($oStylevar->isError()){
					$this->E($oStylevar->getErrorMessage());
				}

				$this->S(Dyhb::L('主题 %s 更新成功','Controller/Style',null,$oStyle['style_name']));
			}else{
				$this->E(Dyhb::L('数据库中并不存在该项，或许它已经被删除','Controller/Common'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}

	public function preview(){
		$nId=intval(G::getGpc('id','G'));

		$this->display();
	}

	public function export(){
		$nStyleId=intval(G::getGpc('id','G'));

		if(!empty($nStyleId)){
			$oStyle=StyleModel::F('style_id=?',$nStyleId)->getOne();
			if(!empty($oStyle['style_id'])){
				$oTheme=ThemeModel::F('theme_id=?',$oStyle['theme_id'])->getOne();
				if(empty($oTheme['theme_id'])){
					$this->E(Dyhb::L('主题 %s 的模板不存在','Controller/Style',null,$oStyle['style_name']));
				}

				$arrData=array();
				
				// 样式版权
				$arrData['title']=$GLOBALS['_option_']['needforbug_program_name'].'! Style';
				$arrData['version']=NEEDFORBUG_SERVER_VERSION;
				$arrData['time']=NEEDFORBUG_SERVER_RELEASE;
				$arrData['url']=$GLOBALS['_option_']['needforbug_program_url'];
				$arrData['copyright']='(C)'.$GLOBALS['_option_']['needforbug_program_year'].' '.$GLOBALS['_option_']['needforbug_program_company'];

				// 主题信息
				$arrStylevarData=array();

				$arrStylevars=StylevarModel::F('style_id=?',$oStyle['style_id'])->getAll();
				foreach($arrStylevars as $oStylevar){
					$arrStylevarData[strtolower($oStylevar['stylevar_variable'])]=trim($oStylevar['stylevar_substitute']);
				}

				$arrData['data']=array(
					'name'=>htmlspecialchars($oStyle['style_name']),
					'theme_id'=>intval($oStyle['theme_id']),
					'theme_name'=>htmlspecialchars(trim($oTheme['theme_name'])),
					'theme_dirname'=>strtolower(trim($oTheme['theme_dirname'])),
					'status'=>intval($oStyle['style_status']),
					'style_id'=>intval($oStyle['style_id']),
					'style_extend'=>trim($oStyle['style_extend']),
					'doyouhaobaby_template_base'=>strtolower($oTheme['theme_dirname']),
					'directory'=>'theme/'.ucfirst($oTheme['theme_dirname']),
					'copyright'=>htmlspecialchars(trim($oTheme['theme_copyright'])),
					'data'=>array_reverse($arrStylevarData),
					'version'=>'For '.$GLOBALS['_option_']['needforbug_program_name'].'-'.NEEDFORBUG_SERVER_VERSION,
				);
				
				// 保存文件
				$sPath='STYLE-needforbug_style_'.strtolower($oTheme['theme_dirname']).'_'.intval($oStyle['style_id']).'-'.date('Y_m_d_H_i_s',CURRENT_TIMESTAMP).'.xml';
				
				ob_end_clean();
			
				header('Content-Encoding: none');
				header('Content-Type: '.(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')?'application/octetstream':'application/octet-stream'));
				header('Content-Disposition: attachment; filename="'.$sPath.'"');
				header('Pragma: no-cache');
				header('Expires: 0');
				
				$arrData=G::stripslashes($arrData,true);
				echo Xml::xmlSerialize($arrData);

				exit;
			}else{
				$this->E(Dyhb::L('数据库中并不存在该项，或许它已经被删除','Controller/Common'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}

	public function copy_style(){
		$nStyleId=intval(G::getGpc('id','G'));

		if(!empty($nStyleId)){
			$oStyle=StyleModel::F('style_id=?',$nStyleId)->getOne();
			if(!empty($oStyle['style_id'])){
				$oTheme=ThemeModel::F('theme_id=?',$oStyle['theme_id'])->getOne();
				if(empty($oTheme['theme_id'])){
					$this->E(Dyhb::L('主题 %s 的模板不存在','Controller/Style',null,$oStyle['style_name']));
				}

				// 保存主题信息
				$arrStyleData=$oStyle->toArray();
				unset($arrStyleData['style_id']);
				$arrStyleData['style_name']=$arrStyleData['style_name'].'_'.G::randString(6);

				$oNewStyle=new StyleModel($arrStyleData);
				$oNewStyle->save(0);

				if($oNewStyle->isError()){
					$this->E($oNewStyle->getErrorMessage());
				}
			
				// 保存主题变量信息
				$arrStylevarData=array();

				$arrStylevars=StylevarModel::F('style_id=?',intval(G::getGpc('id','G')))->getAll();
				foreach($arrStylevars as $oStylevar){
					$arrStylevarData['style_id']=$oNewStyle['style_id'];
					$arrStylevarData['stylevar_variable']=strtolower($oStylevar['stylevar_variable']);
					$arrStylevarData['stylevar_substitute']=trim($oStylevar['stylevar_substitute']);

					$oNewStylevar=new StylevarModel($arrStylevarData);
					$oNewStylevar->save(0);

					if($oNewStylevar->isError()){
						$this->E($oNewStylevar->getErrorMessage());
					}
				}

				$this->S(Dyhb::L('主题 %s 拷贝成功','Controller/Style',null,$oStyle['style_name']));
			}else{
				$this->E(Dyhb::L('数据库中并不存在该项，或许它已经被删除','Controller/Common'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}

	public function bForeverdelete_(){
		$sId=G::getGpc('id');

		if(!empty($sId)){
			$arrIds=explode(',',$sId);
			if(in_array(1,$arrIds)){
				$this->E(Dyhb::L('系统默认主题无法删除','Controller/Style'));
			}
		}
	}

	public function aForeverdelete($sId){
		// 删除主题后清除它的变量
		$arrIds=explode(',',$sId);
		foreach($arrIds as $nId){
			StylevarModel::M()->deleteWhere(array('style_id'=>$nId));
		}
	}

	public function bForbid_(){
		$sId=G::getGpc('id');

		if(!empty($sId)){
			$arrIds=explode(',',$sId);
			if(in_array(1,$arrIds)){
				$this->E(Dyhb::L('系统默认主题无法禁用','Controller/Style'));
			}
		}
	}

	public function reset_style(){
		$nStyleId=intval(G::getGpc('id','G'));

		if(!empty($nStyleId)){
			$oStyle=StyleModel::F('style_id=?',$nStyleId)->getOne();
			if(!empty($oStyle['style_id'])){
				$oTheme=ThemeModel::F('theme_id=?',$oStyle['theme_id'])->getOne();
				if(empty($oTheme['theme_id'])){
					$this->E(Dyhb::L('主题 %s 的模板不存在','Controller/Style',null,$oStyle['style_name']));
				}

				$sThemeXml=NEEDFORBUG_PATH.'/ucontent/'.$oTheme['theme_directory'].'/needforbug_style_'.strtolower($oTheme['theme_dirname']).'.xml';
				if(!is_file($sThemeXml)){
					$this->E(Dyhb::L('你要安装的主题 %s 样式表不存在','Controller/Style',null,$sThemeXml));
				}

				$arrStyleData=Xml::xmlUnserialize(file_get_contents($sThemeXml));
				if(empty($arrStyleData)){
					$this->E(Dyhb::L('你要安装的主题 %s 样式表可能已经损坏，系统无法读取其数据','Controller/Style',null,$sThemeXml));
				}else{
					$arrStyleData=$arrStyleData['root']['data'];
				}

				// 更新扩展风格
				$oStyle->style_extend=$arrStyleData['style_extend'];
				$oStyle->save(0,'update');

				if($oStyle->isError()){
					$this->E($oStyle->getErrorMessage());
				}

				// 对比数据取得要删除的变量
				$arrResetStylevarData=$arrStyleData['style'];
				$arrResetStylevarkeyData=array_keys($arrResetStylevarData);
				$arrStylevarData=$arrDeletevars=array();
			
				$arrStylevars=StylevarModel::F('style_id=?',$nStyleId)->getAll();
				foreach($arrStylevars as $oStylevar){
					$arrStylevarData[strtolower($oStylevar['stylevar_variable'])]=trim($oStylevar['stylevar_substitute']);
					if(!in_array(strtolower($oStylevar['stylevar_variable']),$arrResetStylevarkeyData)){
						$arrDeletevars[]=strtolower($oStylevar['stylevar_variable']);
					}
				}

				if(!empty($arrDeletevars)){
					$arrWhere=array();
					$arrWhere['style_id']=$oStyle['style_id'];
					$arrWhere['stylevar_variable']=array('in',$arrDeletevars);
					StylevarModel::M()->deleteWhere($arrWhere);
				}

				// 更新变量 & 没有则写入新的变量
				$oStylevar=Dyhb::instance('StylevarModel');
				$oStylevar->saveStylevarData($arrResetStylevarData,$nStyleId);

				if($oStylevar->isError()){
					$this->E($oStylevar->getErrorMessage());
				}
				
				$this->S(Dyhb::L('主题 %s 数据恢复成功','Controller/Style',null,$oStyle['style_name']));
			}else{
				$this->E(Dyhb::L('数据库中并不存在该项，或许它已经被删除','Controller/Common'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
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
