<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-21 00:30:09  */ ?>
<!DOCTYPE html><html><head><title><?php echo($GLOBALS['_option_']['needforbug_program_name']);?>! <?php print Dyhb::L("管理平台",'Template/Default/Common',null);?></title><meta http-equiv="Content-type" content="text/html; charset=utf-8" /><!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="<?php echo(__TMPLPUB__);?>/Css/ie.css"/><script src="<?php echo(__PUBLIC__);?>/js/common/html5.js" type="text/javascript"></script><![endif]--><link rel="stylesheet" type="text/css" href="<?php echo(__TMPLPUB__);?>/Css/style.css"/><style type="text/css">overflow-x: hidden;
</style><script type="text/javascript">var __DYHB_JS_ENTER__='<?php echo(__APP__);?>';
</script><script type="text/javascript" src="<?php echo __LIBCOM__;?>/Js/Vendor/Jquery.js"></script><script type="text/javascript" src="<?php echo __LIBCOM__;?>/Js/Dyhb.package.js"></script><script src="<?php echo(__PUBLIC__);?>/Js/Common/global.js"></script><link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/js/artdialog/skins/default.css"/><script type="text/javascript" src="<?php echo(__PUBLIC__);?>/js/artdialog/jquery.artDialog.min.js"></script><script type="text/javascript" src="<?php echo(__PUBLIC__);?>/js/artdialog/artDialog.plugins.min.js"></script><script type="text/javascript" src="<?php echo(__PUBLIC__);?>/js/jquery/jquery.equalHeight.js"></script><script type="text/javascript">Dyhb.Lang.SetCurrentLang('<?php echo(LANG_NAME);?>');
Dyhb.Ajax.Dyhb.Image=['<?php echo(__PUBLIC__);?>/images/common/ajax/loading.gif', '<?php echo(__PUBLIC__);?>/images/common/ajax/ok.gif','<?php echo(__PUBLIC__);?>/images/common/ajax/update.gif' ];
var URL='<?php echo(__URL__);?>';
<?php echo(App::U());?><?php if(isset($sSortUrl)):?>var SORTURL =<?php echo($sSortUrl);?>;
<?php endif;?>$(document).ready(function(){
		$('.column').equalHeight();
		$(".tablesorter tr:odd").addClass("data_odd");
		$(".tablesorter tr:even").addClass("data_even");
		$(".tablesorter tr").hover(function(){
		$(this).addClass("data_tr")
	},function(){
		$(this).removeClass("data_tr")
	});

	$(".tablesorter tbody tr")
		.mouseover(function(){$(this).addClass("row-actions-display")})
		.mouseout(function(){$(this).removeClass("row-actions-display")});
});
</script><script src="<?php echo(__PUBLIC__);?>/js/common/global.js" type="text/javascript"></script><script src="<?php echo(__PUBLIC__);?>/js/admin/common.js" type="text/javascript"></script><link rel="shortcut icon" href="<?php echo(__PUBLIC__);?>/images/common/admin_favicon.png"></head><body id="main"><div id="DyhbAjaxResult" class="none DyhbAjaxResult">&nbsp;</div><script type="text/javascript">function adminctrlmenuAdd(sUrl,sTitle){
	Dyhb.AjaxSend(D.U('adminctrlmenu/add_url?url='+encodeURIComponent(sUrl)+'&title='+sTitle),'','',function(data,status){
		if(status==1){
			parent.menu.location=D.U( 'public/fmenu?title='+encodeURIComponent('<?php print Dyhb::L("首页",'Template/Default/Common',null);?>')+'&currentid=3&notrefershmain=1' );
		}
	});
}
</script>