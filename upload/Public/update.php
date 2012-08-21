<?php
	header("Content-type:text/html;charset=utf-8");
	ini_set('default_charset','utf-8');
	function errorMessage($content){
		echo "throw new Error('{$content}');";
		exit;
	}
	$sServerVersion='1.1';
	$nServerRelease=20140821;
	
	$sVersion=isset($_GET['version'])?trim($_GET['version']):'';
	$nRelease=isset($_GET['release'])?intval($_GET['release']):'';
	$sHostname=isset($_GET['hostname'])?trim($_GET['hostname']):'';
	$sUrl=isset($_GET['url'])?trim($_GET['url']):'';

	if(empty($sVersion)){
			errorMessage('无法获取版本信息');
	}
	if(empty($nRelease)){
			errorMessage('无法获取版本发布日期');
	} 
	if(empty($sHostname)){
			errorMessage('无法获取域名信息');
	}
	if(empty($sUrl)){
			errorMessage('无法获取程序安装地址');
	}
	if($nServerRelease>$nRelease){
	    $sInfo=<<<INFO
		parent.menu.document.getElementById("update_num").innerHTML="<span class=\"update_num\">3</span>";
		document.getElementById("welcome_info").style.display="none";
		document.getElementById("newest_version").innerHTML="{$sServerVersion} Build {$nServerRelease}";
		document.getElementById("news_box").style.display="";
		document.getElementById("news_title").innerHTML="更新提示";
		document.getElementById("news_content").innerHTML="<span>{$sServerVersion} Build {$nServerRelease}已经发布。下载地址: <a href=\"http://www.baidu.com/\" target=\"_blank\">http://www.baidu.com/</a></span>";
INFO;
	echo $sInfo;
	}
?>
