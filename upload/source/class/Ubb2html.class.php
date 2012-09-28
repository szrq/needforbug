<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Ubb代码解析($)*/

!defined('DYHB_PATH') && exit;

class Ubb2html{
	
	public $_sContent='';
	public $_sLoginurl='';
	public $_sRegisterurl='';
	public $_nOuter=0;

	public function __construct($sContent,$nOuter=0){
		$this->_sContent=$sContent;
		$this->_sLoginurl=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=public&a=login';
		$this->_sRegisterurl=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=public&a=register';
		$this->_nOuter=$nOuter;
	}

	public function convert($sContent=null){
		if($sContent===null){
			$sContent=$this->_sContent;
		}

		// 解析隐藏标签
		if($GLOBALS['___login___']===false){
			$sContent=preg_replace(
				"/\[hide\](.+?)\[\/hide\]/is",
				self::template(
					'隐藏内容',
					'这部分内容只能在登入之后看到。请先 <a href="'.$this->_sRegisterurl.'">注册</a> 或者 <a href="'.$this->_sLoginurl.'">登录</a>',
					'hidebox'
				),
				$sContent
			);
		}else{
			$sContent=str_replace(array('[hide]','[/hide]'),'',$sContent);
		}

		// 解析特殊标签
		$sContent=str_replace(array('{','}'),array('&#123;','&#125;'),$sContent);
		
		// 换行和分割线
		$arrBasicUbbSearch=array('[hr]','<br>','[br]');
		$arrBasicUbbReplace=array('<hr/>','<br/>','<br/>');
		$sContent=str_replace($arrBasicUbbSearch,$arrBasicUbbReplace,$sContent);
		
		// URL和图像标签
		/*$sContent=preg_replace(
			"/\[url=([^\[]*)\]\[img(align=L| align=M| align=R)?(width=[0-9]+)?(height=[0-9]+)?\]\s*(\S+?)\s*\[\/img\]\[\/url\]/ise",
			"Ubb_Extend::makeimgWithurl('\\1','\\2','\\3','\\4','\\5')",
			$sContent
		);*/
		
		$sContent=preg_replace(
			"/\[img(align=L| align=M| align=R)?(width=[0-9]+)?(height=[0-9]+)?\]\s*(\S+?)\s*\[\/img\]/ise",
			"{$this->makeImg('\\1','\\2','\\3','\\4')}",
			$sContent
		);
/*
			$sContent=preg_replace("/\[url=([^\[]*)\]\[upload(align=L| align=M| align=R)?(width=[0-9]+)?(height=[0-9]+)?\]\s*(\S+?)\s*\[\/upload\]\[\/url\]/ise","Ubb_Extend::makeImgWithUrl('\\1','\\2','\\3','\\4','\\5',{$nInRss},1)",$sContent);
			$sContent=preg_replace("/\[upload(align=L| align=M| align=R)?(width=[0-9]+)?(height=[0-9]+)?\]\s*(\S+?)\s*\[\/upload\]/ise","Ubb_Extend::makeImg('\\1','\\2','\\3','\\4',{$nInRss},1)",$sContent);*/

		G::dump($sContent);
		return $sContent;
	}

	public function makeImg($sAlignCode,$sWidthCode,$sHeightCode,$sSrc){
		$sAlign=str_replace(' align=','',strtolower($sAlignCode));
		
		if($sAlign=='l'){
			$sShow=' align="left"';
		}elseif($sAlign=='r'){
			$sShow=' align="right"';
		}else{
			$sShow='';
		}
		
		$nWidth=str_replace(' width=','',strtolower($sWidthCode));
		if(!empty($nWidth)){
			$sShow.=' width="'.$nWidth.'"';
		}
		
		$nHeight=str_replace(' height=','',strtolower($sHeightCode));
		if(!empty($nHeight)){
			$sShow.=' height="'.$nHeight.'"';
		}
		
		$sCode="<a href=\"{$sSrc}\" target=\"_blank\"><img src=\"{$sSrc}\" class=\"content-insert-image\" alt=\"在新窗口浏览此图片\" title=\"在新窗口浏览此图片\" border=\"0\" {$sShow}/></a>";
		
		return $sCode;
	}

	public function getAttachmentpath($Url){
		/*if(!preg_match('/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/',$Url)){
			if(!preg_match("/[^\d-.,]/",$Url)){
				$oAttachment=AttachmentModel::F('attachment_id=?',$Url)->query();
			}else{
				$oAttachment=AttachmentModel::F('attachment_savename=?',$Url)->query();
			}
			
			if(!empty($oAttachment['attachment_id'])){
				return false;
			}
			
			/*if($GLOBALS['_option_']['upload_ishide_reallypath']==1){
				$sUrl=
			}else{
				
			}*/
			
			/*return $oAttachment
		}*/

		return $Url;
	}

	protected function template($sTitle,$sContent,$sId='ubb_box'){
		return <<<NEEDFORBUG
			<div class="{$sId}">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>{$sTitle}</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="background:none;">{$sContent}</td>
						</tr>
					</tbody>
				</table>
			</div>
NEEDFORBUG;
	}

}
