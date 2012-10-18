<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 08:39:15  */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo(Core_Extend::title($TheController));?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="keywords" content="<?php echo(Core_Extend::keywords($TheController));?>">
	<meta name="description" content="<?php echo(Core_Extend::description($TheController));?>">
	<!--[if lt IE 9]>
	<script src="<?php echo(__PUBLIC__);?>/js/common/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/extension/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/extension/bootstrap/css/bootstrap-responsive.min.css"/>
	<link rel="shortcut icon" href="<?php echo(__PUBLIC__);?>/images/common/favicon.png">
	<?php echo(Core_Extend::loadCss());?>
	<script type="text/javascript">
	var __DYHB_JS_ENTER__='<?php echo(__APP__);?>';
	</script>
	<script src="<?php echo(__PUBLIC__);?>/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="<?php echo __LIBCOM__;?>/Js/Dyhb.package.js"></script>
	<script type="text/javascript">
	Dyhb.Lang.SetCurrentLang('<?php echo(LANG_NAME);?>');
	Dyhb.Ajax.Dyhb.Image=['<?php echo(__PUBLIC__);?>/images/common/ajax/loading.gif','<?php echo(__PUBLIC__);?>/images/common/ajax/ok.gif','<?php echo(__PUBLIC__);?>/images/common/ajax/update.gif'];
	var sBgextendRepeat='<?php echo($GLOBALS['_option_']['bgextend_repeat']);?>';
	<?php echo(App::U());?>
	$(document).ready(function(){
		$('#runtime_result').html($('#dyhb_run_time').html());
		$('#dyhb_run_time').html(' ');
		<?php if($GLOBALS['_option_']['bgextend_on']==1):?>
		setInterval("changeGlobalbg();",<?php echo($GLOBALS['_option_']['bgextend_time']*1000);?>);
		<?php endif;?>
	});
	</script>
	<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/js/artdialog/skins/default.css"/>
	<script type="text/javascript" src="<?php echo(__PUBLIC__);?>/js/artdialog/jquery.artDialog.min.js"></script>
	<script type="text/javascript" src="<?php echo(__PUBLIC__);?>/js/artdialog/artDialog.plugins.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/js/jquery/hovercard/css/main.css"/>
	<script src="<?php echo(__PUBLIC__);?>/js/jquery/hovercard/js/hoverCard.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		/*$(".bind_hover_card").hoverCard({
			url:D.U('home://misc/avatar'),
			borederRadius:true,
			errorText:"get avatar error"
		});*/
	});
	</script>
</head>

<body>
<div id="DyhbAjaxResult" class="none DyhbAjaxResult">&nbsp;</div>