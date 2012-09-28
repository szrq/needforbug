<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Ubb代码解析($)*/

!defined('DYHB_PATH') && exit;

class Ubb2html{
	
	public $_sContent='';
	public $_sLoginurl='';
	public $_sRegisterurl='';
	public $_bOuter=false;

	public function __construct($sContent,$bOuter=false){
		$this->_sContent=$sContent;
		$this->_sLoginurl=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=public&a=login';
		$this->_sRegisterurl=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=public&a=register';
		$this->bOuter=$bOuter;
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
			"Ubb_Extend::makeimgWithurl('\\1','\\2','\\3','\\4','\\5',{$this->bOuter})",
			$sContent
		);*/
		
		$sContent=preg_replace(
			"/\[img(align=L| align=M| align=R)?(width=[0-9]+)?(height=[0-9]+)?\]\s*(\S+?)\s*\[\/img\]/ise",
			"$this->makeImg('\\1','\\2','\\3','\\4',{$this->bOuter})",
			$sContent
		);
/*
			$sContent=preg_replace("/\[url=([^\[]*)\]\[upload(align=L| align=M| align=R)?(width=[0-9]+)?(height=[0-9]+)?\]\s*(\S+?)\s*\[\/upload\]\[\/url\]/ise","Ubb_Extend::makeImgWithUrl('\\1','\\2','\\3','\\4','\\5',{$nInRss},1)",$sContent);
			$sContent=preg_replace("/\[upload(align=L| align=M| align=R)?(width=[0-9]+)?(height=[0-9]+)?\]\s*(\S+?)\s*\[\/upload\]/ise","Ubb_Extend::makeImg('\\1','\\2','\\3','\\4',{$nInRss},1)",$sContent);*/

		G::dump($sContent);
		return $sContent;
	}

	public function makeImg($sAlignCode,$sWidthCode,$sHeightCode,$sSrc,$nInRss=0){
		$arrUrl=self::getUrlPath($sSrc,true);
		if($arrUrl===false || (G::isImplementedTo($arrUrl[0],'IModel') && !is_file(DYHB_PATH.'/../Public/Upload/'.$arrUrl[0]['upload_savepath'].'/'.$arrUrl[0]['upload_savename']))){
			return "<div class=\"quote mediabox\"><div class=\"quote-title\"><img src=\"".($sPublicHeader=$nInRss==1?Global_Extend::getOption('blog_url'):'')."/Images/Public/Images/Media/viewimage.gif"."\" alt=\"\"/>".G::L('损坏图片')."</div><div class=\"quote-content\">".G::L('该文件已经损坏')."</div></div>";
		}
		if(is_array($arrUrl)){
			$sSrc=$arrUrl[2];
			$sTargetSrc=$arrUrl[1];
		}
		else{
			$sTargetSrc=$sSrc;
		}
		$sAlign=str_replace(' align=','',strtolower($sAlignCode));
		if($sAlign=='l') {$sShow=' align="left"';}
		elseif($sAlign=='r') {$sShow=' align="right"';}
		else {$sShow='';}
		$nWidth=str_replace(' width=','',strtolower($sWidthCode));
		if(!empty($nWidth)) {$sShow.=" width=\"{$nWidth}\"";}
		else{
			if(G::isImplementedTo($arrUrl[0],'IModel')){
				$arrImageInfo=getimagesize(DYHB_PATH.'/../Public/Upload/'.$arrUrl[0]->upload_savepath.'/'.$arrUrl[0]->upload_savename);
				$sShow.=self::attachwidth($arrImageInfo[0]);
			}
		}
		$nHeight=str_replace(' height=','',strtolower($sHeightCode));
		if(!empty($nHeight)) {$sShow.=" height=\"{$nHeight}\"";}
		if($nInRss==1 &&(substr(strtolower($sSrc),0,4)!='http')){
			$sHeader=self::getHostHeader();
		}
		else{
			$sHeader='';
		}
		$nContentAutoResizeImg=Global_Extend::getOption('content_auto_resize_img');
		$sOnloadAct=($nInRss==0 && !empty($nContentAutoResizeImg))?" onload=\"if(this.width>{$nContentAutoResizeImg}){this.resized=true;this.width={$nContentAutoResizeImg};}\"":'';
		if($bIsAttached==1){
			if(G::isImplementedTo($arrUrl[0],'IModel')){
				$sDownloadTime=" | ".G::L('已下载').'('.$arrUrl[0]->upload_download.')'.G::L('次');
				$sFileSize=' | '.E::changeFileSize($arrUrl[0]->upload_size);
				$sTitle="Filename:{$oUpload->upload_name} | Upload Time:".date('Y-m-d H:i:s',$arrUrl[0]->create_dateline);
				$sComment=' | '.G::L('评论').'('.$arrUrl[0]['upload_commentnum'].')';
				$sUploadUser=' | '.G::L('上传用户').':'.($arrUrl[0]->user->user_id?$arrUrl[0]->user->user_name:G::L('跌名'));
			}else{
				$sDownloadTime=$sFileSize=$sTitle=$sComment=$sUploadUser='';
			}
			if(Global_Extend::getOption('only_login_can_view_upload')==0 || $GLOBALS['___login___']!==false){
				$sCode="<a href=\"{$sHeader}{$sTargetSrc}\" target=\"_blank\"><img src=\"{$sHeader}{$sSrc}\" class=\"content-insert-image\" alt=\"".G::L('在新窗口浏览此图片')."\" title=\"".G::L('在新窗口浏览此图片')." {$sTitle} {$sUploadUser} {$sComment} {$sFileSize} {$sDownloadTime}\" border=\"0\"{$sOnloadAct}{$sShow}/></a>";
			}
			else{
				$sCode='<div class="locked">'.G::L('这个图片只能在登入之后查看。').G::L('请先')."<a href=\"".self::clearUrl($sHeader.G::U('register/index'))."\">".G::L('注册')."</a> ".G::L('或者')." <a href=\"".self::clearUrl($sHeader.G::U('login/index'))."\">".G::L('登录')."</a></div>";
			}
		}
		else{
			$sCode="<a href=\"{$sHeader}{$sTargetSrc}\" target=\"_blank\"><img src=\"{$sHeader}{$sSrc}\" class=\"content-insert-image\" alt=\"".G::L('在新窗口浏览此图片')."\" title=\"".G::L('在新窗口浏览此图片')."\" border=\"0\"{$sOnloadAct}{$sShow}/></a>";
		}
		return $sCode;
	}

	public function getAttachmentpath($Url,$bImg=false){
		if(!preg_match('/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/',$Url)){
			if(Global_Extend::getOption('is_hide_upload_really_path')==1){
				if(!preg_match("/[^\d-.,]/",$Url)){
					$oUpload=UploadModel::F('upload_id=?',$Url)->query();
				}
				else{
					$oUpload=UploadModel::F('upload_savename=?',$Url)->query();
				}
				if(!($oUpload instanceof UploadModel)){
					return false;
				}
				$sSrcPath=G::U('attachment/index?id='.Global_Extend::aidencode($oUpload['upload_id']));
				if($bImg===true){
					return array($oUpload,$sSrcPath,$oUpload['upload_isthumb']?G::U('attachment/index?id='.Global_Extend::aidencode($oUpload['upload_id']).'&thumb=1'):$sSrcPath);
				}
				else{
					return array($oUpload,$sSrcPath);
				}
			}
			$Url=Blog_Extend::blogContentUpload($Url,$bImg);
		}

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
