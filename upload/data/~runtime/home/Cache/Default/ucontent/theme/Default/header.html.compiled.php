<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 09:07:50  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('cheader'));?>

<div id="wrapper">
	<div id="top_header">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="top_header_menu">
						<div class="left">
							<?php if($GLOBALS['_option_']['language_switch_on']==1 && count($GLOBALS['_cache_']['lang'])>1):?>
							<div id="lang_select_box" class="left">
								<div class="btn-group">
									<a href="javascript:void(0);" id="lang_select" data-toggle="dropdown">Language</a>
									<ul class="dropdown-menu">
									<?php $i=1;?>
<?php if(is_array($GLOBALS['_cache_']['lang'])):foreach($GLOBALS['_cache_']['lang'] as $key=>$sLang):?>

										<li><a href="?l=<?php echo($sLang);?>" <?php if(strtolower(Dyhb::cookie('language'))==$sLang):?>style="font-weight:bold;"<?php endif;?>><?php echo($sLang);?></a></li>
									
<?php $i++;?>
<?php endforeach;endif;?>
									</ul>
								</div>
							</div>
							<span class="pipe">|</span>
							<?php endif;?>
							<i class="icon-signal"></i>
							<a href="<?php echo(Dyhb::U('home://public/mobile'));?>">手机版</a>
							<span class="pipe">|</span>
							<a href="<?php echo(Dyhb::U('home://public/sitemap'));?>">网站地图</a>
						</div>
						<div class="right">
							<?php if($GLOBALS['_option_']['extendstyle_switch_on']==1):?>
							<div id="extendstyle_select_box" class="left">
								<div class="btn-group">
									<a href="javascript:void(0);" id="extendstyle_select" data-toggle="dropdown">&nbsp;&nbsp;&nbsp;&nbsp;</a>
									<ul class="dropdown-menu">
									<?php $i=1;?>
<?php if(is_array($GLOBALS['_style_']['_style_extend_icons_'])):foreach($GLOBALS['_style_']['_style_extend_icons_'] as $sStyleextendicon=>$arrStyleextendicon):?>

										<?php if($sStyleextendicon=='0' && count($GLOBALS['_style_']['_style_extend_icons_'])!=1):?>
										<li class="divider"></li>
										<?php endif;?>
										<li style="background:<?php echo($arrStyleextendicon[2]);?>;"><a href="javascript:void(0);" onclick="<?php if(count($GLOBALS['_style_']['_style_extend_icons_'])==1):?>javascript:void(0);<?php else:?>setExtendstyle('<?php echo($sStyleextendicon);?>','<?php if($sStyleextendicon!='0'):?><?php echo(Core_Extend::getCurstyleCacheurl());?>/t_<?php echo($sStyleextendicon);?>.css<?php endif;?>');<?php endif;?>" style="color:#FFF;<?php if($GLOBALS['_extend_style_']==$sStyleextendicon):?>font-weight:bold;border:2px solid #FFF;<?php endif;?>"><?php echo($arrStyleextendicon[1]);?></a></li>
									
<?php $i++;?>
<?php endforeach;endif;?>
									</ul>
								</div>
							</div>
							<span class="pipe">|</span>
							<?php endif;?>
							<?php $arrHeaderNavs=$GLOBALS['_cache_']['nav']['header'];?>
							<?php $i=1;?>
<?php if(is_array($arrHeaderNavs)):foreach($arrHeaderNavs as $key=>$arrHeaderNav):?>

							<a <?php echo($arrHeaderNav['style']);?> title="<?php echo($arrHeaderNav['description']);?>" href="<?php echo($arrHeaderNav['link']);?>" <?php echo($arrHeaderNav['target']);?>>
								<?php echo($arrHeaderNav['title']);?>
							</a>&nbsp;
							
<?php $i++;?>
<?php endforeach;endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="header">
		<div class="container">
			<div class="row">
				<div class="span7">
					<a class="brand" href="<?php echo(__APP__);?>" title="<?php echo($GLOBALS['_option_']['site_name']);?>"><img src="<?php echo(__PUBLIC__);?>/images/common/logo.png" alt="<?php echo($GLOBALS['_option_']['site_name']);?>"/></a>
				</div>
				<div class="span5">
					<div class="right">
						<?php if($GLOBALS['_option_']['style_switch_on']==1 && count($GLOBALS['_style_']['_style_icons_'])>1):?>
						<div id="style_switch_box">
							<ul id="style_switch">
								<?php $i=1;?>
<?php if(is_array($GLOBALS['_style_']['_style_icons_'])):foreach($GLOBALS['_style_']['_style_icons_'] as $nStyleicon=>$sStyleicon):?>

								<li <?php if(Core_Extend::getStyleId()==$nStyleicon):?>class="current"<?php endif;?>><a  href="javascript:void(0);" onclick="<?php if(Core_Extend::getStyleId()==$nStyleicon):?>javascript:void(0);<?php else:?>setStyle(<?php echo($nStyleicon);?>)<?php endif;?>" title="<?php echo($nStyleicon);?>" style="background: <?php echo($sStyleicon);?>;"><?php echo($nStyleicon);?></a></li>
								
<?php $i++;?>
<?php endforeach;endif;?>
							</ul>
						</div>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
		<div class="navbar-inner">
			<div class="navbar">
				<div class="container-fluid">
					<a class="brand" href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("首页",'__COMMON_LANG__@Template/Common',null);?>"><?php print Dyhb::L("首页",'__COMMON_LANG__@Template/Common',null);?></a>
					<ul class="nav">
						<?php $arrMainNavs=$GLOBALS['_cache_']['nav']['main'];?>
						<?php $i=1;?>
<?php if(is_array($arrMainNavs)):foreach($arrMainNavs as $key=>$arrMainNav):?>

						<?php if($arrMainNav['sub']):?>
						<li class="dropdown">
							<a <?php echo($arrMainNav['style']);?> title="<?php echo($arrMainNav['description']);?>" href="javascript:void(0);" <?php echo($arrMainNav['target']);?> class="dropdown-toggle" data-toggle="dropdown">
								<?php echo($arrMainNav['title']);?> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a <?php echo($arrMainNav['style']);?> title="<?php echo($arrMainNav['description']);?>" href="<?php echo($arrMainNav['link']);?>" <?php echo($arrMainNav['target']);?>><?php echo($arrMainNav['title']);?></a>
								</li>
								<li class="divider"></li>
								<?php $arrMainSubNavs=$arrMainNav['sub'];?>
								<?php $i=1;?>
<?php if(is_array($arrMainSubNavs)):foreach($arrMainSubNavs as $key=>$arrMainSubNav):?>

								<li>
									<a <?php echo($arrMainSubNav['style']);?> title="<?php echo($arrMainSubNav['description']);?>" href="<?php echo($arrMainSubNav['link']);?>" <?php echo($arrMainSubNav['target']);?>><?php echo($arrMainSubNav['title']);?></a>
								</li>
								
<?php $i++;?>
<?php endforeach;endif;?>
							</ul>
						</li>
						<?php else:?>
						<li>
							<a <?php echo($arrMainNav['style']);?> title="<?php echo($arrMainNav['description']);?>" href="<?php echo($arrMainNav['link']);?>" <?php echo($arrMainNav['target']);?>><?php echo($arrMainNav['title']);?></a>
						</li>
						<?php endif;?>
						
<?php $i++;?>
<?php endforeach;endif;?>
					</ul>
					<div class="btn-group pull-right">
						<?php if($GLOBALS['___login___']===false):?>
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
							<i class="icon-user"></i>&nbsp;<?php print Dyhb::L("未登录",'__COMMON_LANG__@Template/Header',null);?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo(Dyhb::U('home://public/login'));?>"><?php print Dyhb::L("用户登录",'__COMMON_LANG__@Template/Header',null);?></a></li>
							<li class="divider"></li>
							<li><a href="<?php echo(Dyhb::U('home://public/register'));?>"><?php print Dyhb::L("用户注册",'__COMMON_LANG__@Template/Header',null);?></a></li>
						</ul>
						<?php else:?>
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
							<?php if($GLOBALS['___login___']['socia_login']===true):?>
							<img src="<?php echo($GLOBALS['___login___']['socia']['logo']);?>"/>&nbsp;
							<?php echo($GLOBALS['___login___']['socia']['sociauser_name']);?>
							<?php else:?>
							<i class="icon-user"></i>&nbsp;
							<?php if($GLOBALS['___login___']['user_nikename']):?>
								<?php echo($GLOBALS['___login___']['user_nikename']);?>
							<?php else:?>
								<?php echo($GLOBALS['___login___']['user_name']);?>
							<?php endif;?>
							<?php endif;?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<?php if(Core_Extend::isAdmin()):?>
							<li><a href="<?php echo(__ROOT__);?>/admin.php" target="_blank"><?php print Dyhb::L("管理中心",'__COMMON_LANG__@Template/Header',null);?></a></li>
							<?php endif;?>
							<li><a href="<?php echo(Dyhb::U('home://ucenter/index'));?>"><?php print Dyhb::L("个人中心",'__COMMON_LANG__@Template/Header',null);?></a></li>
							<li><a href="<?php echo(Dyhb::U('home://spaceadmin/index'));?>"><?php print Dyhb::L("修改资料",'__COMMON_LANG__@Template/Header',null);?></a></li>
							<li><a href="<?php echo(Dyhb::U('home://friend/index'));?>"><?php print Dyhb::L("我的好友",'__COMMON_LANG__@Template/Header',null);?></a></li>
							<li class="divider"></li>
							<li><a href="<?php echo(Dyhb::U('home://public/logout'));?>"><?php print Dyhb::L("注销",'__COMMON_LANG__@Template/Header',null);?></a></li>
						</ul>
						<?php endif;?>
					</div>

					<ul class="nav pull-right">
						<li class="dropdown <?php if(MODULE_NAME==='stat'):?>active<?php endif;?>">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><?php print Dyhb::L("社区广场",'__COMMON_LANG__@Template/Header',null);?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo(Dyhb::U('home://stat/index'));?>"><?php print Dyhb::L("基本概况",'__COMMON_LANG__@Template/Header',null);?></a></li>
								<li><a href="<?php echo(Dyhb::U('home://stat/userlist'));?>"><?php print Dyhb::L("会员列表",'__COMMON_LANG__@Template/Header',null);?></a></li>
								<li class="divider"></li>
								<li><a href="<?php echo(Dyhb::U('home://stat/explore'));?>"><?php print Dyhb::L("随便看看",'__COMMON_LANG__@Template/Header',null);?></a></li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
						<?php if($GLOBALS['___login___']!==false):?>
						<li <?php if(MODULE_NAME==='pm'):?>class="active"<?php endif;?> id="new-message-box">
							<a title="短消息" href="<?php echo(Dyhb::U('home://pm/index'));?>"><?php print Dyhb::L("短消息",'__COMMON_LANG__@Template/Header',null);?></a>
						</li>
						<?php endif;?>
					</ul>
					<form class="navbar-search pull-left" action="">
						<input type="text" class="search-query span2" placeholder="<?php print Dyhb::L("搜索",'__COMMON_LANG__@Template/Header',null);?>">
					</form>
				</div><!--/container-fluid-->
			</div><!--/navbar-inner-->
		</div><!--/navbar-->
	</div>
	<div id="content">
		<div class="container">
			<div class="row">
				<div class="span12">
				<script type="text/javascript">
				var isIe6=false;
				document.write("<!--[iflteIE6]><script>isIe6=true;</scr"+"ipt><![endif]-->");
				if(isIe6){
					document.write('<div class="alert"><strong>本站已停止支持 IE6, 请升级你的浏览器! <a href="http://www.getfirefox.com" target="_blank">Firefox</a> &nbsp; <a href="http://opera.com" target="_blank">Opera</a> &nbsp; <a href="http://apple.com/safari" target="_blank">Safari</a> &nbsp; <a href="http://chrome.google.com">Google Chrome</a> &nbsp; <a href="http://windows.microsoft.com/zh-CN/internet-explorer/products/ie/home" target="_blank">IE8+</a></strong></div>');
				}
				</script>
				</div>
			</div>