<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-21 00:30:55  */ ?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title><?php echo($GLOBALS['_option_']['site_name']);?> | <?php echo($GLOBALS['_option_']['site_description']);?></title><meta name="viewport" content="width=device-width,initial-scale=1.0"><meta name="description" content=""><meta name="author" content=""><!--[if lt IE 9]><script src="<?php echo(__PUBLIC__);?>/js/common/html5.js"></script><![endif]--><link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/extension/bootstrap/css/bootstrap.min.css"/><link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/extension/bootstrap/css/bootstrap-responsive.min.css"/><link rel="shortcut icon" href="<?php echo(__PUBLIC__);?>/images/common/favicon.png"><?php echo(Core_Extend::loadCss());?><script type="text/javascript">	var __DYHB_JS_ENTER__='<?php echo(__APP__);?>';
	</script><script src="<?php echo(__PUBLIC__);?>/js/jquery/jquery.js"></script><script type="text/javascript" src="<?php echo __LIBCOM__;?>/Js/Dyhb.package.js"></script><script type="text/javascript">	Dyhb.Lang.SetCurrentLang('<?php echo(LANG_NAME);?>');
	Dyhb.Ajax.Dyhb.Image=['<?php echo(__PUBLIC__);?>/images/common/ajax/loading.gif','<?php echo(__PUBLIC__);?>/images/common/ajax/ok.gif','<?php echo(__PUBLIC__);?>/images/common/ajax/update.gif'];
	<?php echo(App::U());?>	$(document).ready(function(){
		$('#runtime_result').html($('#dyhb_run_time').html());
		$('#dyhb_run_time').html(' ');
	});
	</script><link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__);?>/js/artdialog/skins/default.css"/><script type="text/javascript" src="<?php echo(__PUBLIC__);?>/js/artdialog/jquery.artDialog.min.js"></script><script type="text/javascript" src="<?php echo(__PUBLIC__);?>/js/artdialog/artDialog.plugins.min.js"></script></head><body><div id="DyhbAjaxResult" class="none DyhbAjaxResult">&nbsp;</div><div id="wrapper"><div id="top_header"><div class="container"><div class="row"><div class="span12"><div class="top_header_menu"><div class="left"><?php $arrHeaderNavs=$GLOBALS['_cache_']['nav']['header'];?><?php $i=1;?><?php if(is_array($arrHeaderNavs)):foreach($arrHeaderNavs as $key=>$arrHeaderNav):?><a <?php echo($arrHeaderNav['style']);?> title="<?php echo($arrHeaderNav['description']);?>" href="<?php echo($arrHeaderNav['link']);?>" <?php echo($arrHeaderNav['target']);?>><?php echo($arrHeaderNav['title']);?></a>&nbsp;
							
<?php $i++;?><?php endforeach;endif;?></div><div class="right"><a href="javascript:void(0);" onclick="javascript:void(0);"><?php print Dyhb::L("切换到窄版",'__COMMON_LANG__@Template/Header',null);?></a></div></div></div></div></div></div><div id="header"><div class="container"><div class="row"><div class="span7"><a class="brand" href="<?php echo(__APP__);?>" title="<?php echo($GLOBALS['_option_']['site_name']);?>"><img src="<?php echo(__PUBLIC__);?>/images/common/logo.png" alt="<?php echo($GLOBALS['_option_']['site_name']);?>"/></a></div><div class="span5"><?php if(count($GLOBALS['_style_']['_style_icons_'])>1):?><div class="right"><div id="style_switch_box"><ul id="style_switch" class=""><?php $i=1;?><?php if(is_array($GLOBALS['_style_']['_style_icons_'])):foreach($GLOBALS['_style_']['_style_icons_'] as $nStyleicon=>$sStyleicon):?><li <?php if(Core_Extend::getStyleId()==$nStyleicon):?>class="current"<?php endif;?>><a  href="javascript:void(0);" onclick="<?php if(Core_Extend::getStyleId()==$nStyleicon):?>javascript:void(0);<?php else:?>setStyle(<?php echo($nStyleicon);?>)<?php endif;?>" title="<?php echo($nStyleicon);?>" style="background: <?php echo($sStyleicon);?>;"><?php echo($nStyleicon);?></a></li><?php $i++;?><?php endforeach;endif;?></ul></div></div><?php endif;?></div></div></div><div class="navbar-inner"><div class="navbar"><div class="container-fluid"><a class="brand" href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("首页",'__COMMON_LANG__@Template/Common',null);?>"><?php print Dyhb::L("首页",'__COMMON_LANG__@Template/Common',null);?></a><ul class="nav"><?php $arrMainNavs=$GLOBALS['_cache_']['nav']['main'];?><?php $i=1;?><?php if(is_array($arrMainNavs)):foreach($arrMainNavs as $key=>$arrMainNav):?><?php if($arrMainNav['sub']):?><li class="dropdown"><a <?php echo($arrMainNav['style']);?> title="<?php echo($arrMainNav['description']);?>" href="javascript:void(0);" <?php echo($arrMainNav['target']);?> class="dropdown-toggle" data-toggle="dropdown"><?php echo($arrMainNav['title']);?><b class="caret"></b></a><ul class="dropdown-menu"><li><a <?php echo($arrMainNav['style']);?> title="<?php echo($arrMainNav['description']);?>" href="<?php echo($arrMainNav['link']);?>" <?php echo($arrMainNav['target']);?>><?php echo($arrMainNav['title']);?></a></li><li class="divider"></li><?php $arrMainSubNavs=$arrMainNav['sub'];?><?php $i=1;?><?php if(is_array($arrMainSubNavs)):foreach($arrMainSubNavs as $key=>$arrMainSubNav):?><li><a <?php echo($arrMainSubNav['style']);?> title="<?php echo($arrMainSubNav['description']);?>" href="<?php echo($arrMainSubNav['link']);?>" <?php echo($arrMainSubNav['target']);?>><?php echo($arrMainSubNav['title']);?></a></li><?php $i++;?><?php endforeach;endif;?></ul></li><?php else:?><li><a <?php echo($arrMainNav['style']);?> title="<?php echo($arrMainNav['description']);?>" href="<?php echo($arrMainNav['link']);?>" <?php echo($arrMainNav['target']);?>><?php echo($arrMainNav['title']);?></a></li><?php endif;?><?php $i++;?><?php endforeach;endif;?></ul><div class="btn-group pull-right"><?php if($GLOBALS['___login___']===false):?><a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><i class="icon-user"></i>&nbsp;<?php print Dyhb::L("未登录",'__COMMON_LANG__@Template/Header',null);?><span class="caret"></span></a><ul class="dropdown-menu"><li><a href="<?php echo(Dyhb::U('home://public/login'));?>"><?php print Dyhb::L("用户登录",'__COMMON_LANG__@Template/Header',null);?></a></li><li class="divider"></li><li><a href="<?php echo(Dyhb::U('home://public/register'));?>"><?php print Dyhb::L("用户注册",'__COMMON_LANG__@Template/Header',null);?></a></li></ul><?php else:?><a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><i class="icon-user"></i>&nbsp;
							<?php if($GLOBALS['___login___']['user_nikename']):?><?php echo($GLOBALS['___login___']['user_nikename']);?><?php else:?><?php echo($GLOBALS['___login___']['user_name']);?><?php endif;?><span class="caret"></span></a><ul class="dropdown-menu"><?php $arrAdmins=explode(',',$GLOBALS['_commonConfig_']['ADMIN_USERID']);?><?php if(in_array($GLOBALS['___login___']['user_id'],$arrAdmins)):?><li><a href="<?php echo(__ROOT__);?>/admin.php" target="_blank"><?php print Dyhb::L("管理中心",'__COMMON_LANG__@Template/Header',null);?></a></li><?php endif;?><li><a href="<?php echo(Dyhb::U('home://user/index'));?>"><?php print Dyhb::L("个人中心",'__COMMON_LANG__@Template/Header',null);?></a></li><li><a href="<?php echo(Dyhb::U('home://user/base'));?>"><?php print Dyhb::L("修改资料",'__COMMON_LANG__@Template/Header',null);?></a></li><li><a href="<?php echo(Dyhb::U('home://friend/index'));?>"><?php print Dyhb::L("我的好友",'__COMMON_LANG__@Template/Header',null);?></a></li><li class="divider"></li><li><a href="<?php echo(Dyhb::U('home://public/logout'));?>"><?php print Dyhb::L("注销",'__COMMON_LANG__@Template/Header',null);?></a></li></ul><?php endif;?></div><ul class="nav pull-right"><li class="dropdown <?php if(MODULE_NAME==='stat'):?>active<?php endif;?>"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><?php print Dyhb::L("社区广场",'__COMMON_LANG__@Template/Header',null);?><b class="caret"></b></a><ul class="dropdown-menu"><li><a href="<?php echo(Dyhb::U('home://stat/index'));?>"><?php print Dyhb::L("基本概况",'__COMMON_LANG__@Template/Header',null);?></a></li><li><a href="<?php echo(Dyhb::U('home://stat/userlist'));?>"><?php print Dyhb::L("会员列表",'__COMMON_LANG__@Template/Header',null);?></a></li><li class="divider"></li><li><a href="<?php echo(Dyhb::U('home://stat/explore'));?>"><?php print Dyhb::L("随便看看",'__COMMON_LANG__@Template/Header',null);?></a></li></ul></li><li class="divider-vertical"></li><?php if($GLOBALS['___login___']!==false):?><li <?php if(MODULE_NAME==='pm'):?>class="active"<?php endif;?> id="new-message-box"><a title="短消息" href="<?php echo(Dyhb::U('home://pm/index'));?>"><?php print Dyhb::L("短消息",'__COMMON_LANG__@Template/Header',null);?></a></li><?php endif;?></ul><form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="<?php print Dyhb::L("搜索",'__COMMON_LANG__@Template/Header',null);?>"></form></div><!--/container-fluid--></div><!--/navbar-inner--></div><!--/navbar--></div><div id="content"><div class="container">