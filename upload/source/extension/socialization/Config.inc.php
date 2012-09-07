<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   社会化登录入口配置文件($)*/

!defined('DYHB_PATH') && exit;

// 创建一个配置对象
$oConfig=Sociaconfig::getInstance();

$oConfig->KEYID=array(
	//VendorSina::SITE=>'',
	VendorQQ::$_sSite=>'2c8a05c6c7930f7bd0d481a8462c7db0',
	/*VendorDouBan::SITE=>'sdfsdfsdf',
	VendorNetEase::SITE=>'',
	VendorRenRen::SITE=>'',
	VendorKaiXin::SITE=>'',
	VendorTaoBao::SITE=>'',
	VendorSohu::SITE=>'',
	VendorMsn::SITE=>'',
	VendorTianYa::SITE=>'',
	VendorGmail::SITE=>true,// OPENID类网站为TRUE*/
);

$oConfig->SECID=array(
	//Vendor_Sina::SITE=>'',
	VendorQQ::$_sSite=>'100303001',
	/*Vendor_DouBan::SITE=>'sdfsdf',
	Vendor_NetEase::SITE=>'',
	Vendor_RenRen::SITE=>'',
	Vendor_KaiXin::SITE=>'',
	Vendor_TaoBao::SITE=>'',
	Vendor_Sohu::SITE=>'',
	Vendor_Msn::SITE=>'',
	Vendor_TianYa::SITE=>'',
	Vendor_Gmail::SITE=>TRUE,// OPENID类网站为TRUE*/
);

$oConfig->LOGO=array(
	//Vendor_Sina::SITE=>'http://open.sinaimg.cn/wikipic/button/24.png',
	VendorQQ::$_sSite=>'http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_3.png',
	/*Vendor_DouBan::SITE=>'http://img3.douban.com/pics/doubanicon-24-full.png',
	Vendor_Gmail::SITE=>__ROOT__.'/source/extension/socialization/static/images/logogmail_small.gif',
	Vendor_NetEase::SITE=>'http://img1.cache.netease.com/cnews/img/wblogostandard/logo3.png',
	Vendor_RenRen::SITE=>'http://wiki.dev.renren.com/mediawiki/images/2/2b/%E8%93%9D%E8%89%B2_112X23.png',
	Vendor_KaiXin::SITE=>'http://img1.kaixin001.com.cn/i3/platform/login_1.png',
	Vendor_TaoBao::SITE=>'http://img01.taobaocdn.com/tps/i1/T1T2RZXf8nXXXXXXXX-140-35.png',
	Vendor_Sohu::SITE=>'http://s1.cr.itc.cn/img/i2/t/130.png',
	Vendor_Msn::SITE=>'http://col.stb.s-msn.com/i/B7/EB75D45B8948F72EE451223E95A96.gif',
	Vendor_TianYa::SITE=>'http://open.tianya.cn/static/wiki/tylogin16.png',*/
);

// 客户端文件
$sBaseurl=$GLOBALS['_option_']['site_url'].'/index.php?app=home&c=socia&a=index';
$oConfig->BaseUrl=$sBaseurl;
$oConfig->LoginUrl=$sBaseurl.'&action=login&vendor=';// 登录条链接地址
$oConfig->CallBack=$sBaseurl.'&action=callback&vendor=';// 回调地址
$oConfig->Local='Socialocal';// 默认本地用户处理类
$oConfig->themefile='showBars';// showMiniBars样式文件
$oConfig->theme='theme';// minitheme样式
