<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-26 17:24:32  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_header.html');?><script type="text/javascript">function testDb(){var dbhost=document.getElementById('dbhost').value;var dbuser=document.getElementById('dbuser').value;var dbpwd=document.getElementById('dbpwd').value;document.getElementById('dbpwdsta').innerHTML="<img src='<?php echo(__PUBLIC__);?>/images/common/ajax/loading.gif'>";Dyhb.AjaxSend('<?php echo(Dyhb::U('index/check_database'));?>','ajax=1&dbhost='+dbhost+'&dbuser='+dbuser+'&dbpwd='+dbpwd,'',function(data,status,info){ document.getElementById('dbpwdsta').innerHTML=info; });haveDb();};function haveDb(){var dbhost=document.getElementById('dbhost').value;var dbname=document.getElementById('dbname').value;var dbuser=document.getElementById('dbuser').value;var dbpwd=document.getElementById('dbpwd').value;document.getElementById('havedbsta').innerHTML="<img src='<?php echo(__PUBLIC__);?>/images/common/ajax/loading.gif'>";Dyhb.AjaxSend('<?php echo(Dyhb::U('index/check_database'));?>','ajax=1&dbhost='+dbhost+'&dbuser='+dbuser+'&dbpwd='+dbpwd+'&dbname='+dbname,'',function(data,status,info){ document.getElementById('havedbsta').innerHTML=info; });};function doInstall(){document.form1.submit();};</script><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'Default/Install',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span></li><li><?php print Dyhb::L("参数配置",'Default/Install',null);?></li></ul><form action="<?php echo(Dyhb::U( 'index/install' ));?>" method="post" name="form1"><div class="row"><div class="span12"><h2><?php print Dyhb::L("数据库设定",'Default/Install',null);?></h2><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><tbody><tr><td><strong><?php print Dyhb::L("数据库主机",'Default/Install',null);?></strong></td><td><input name="dbhost" id="dbhost" type="text" value="localhost" /><small style="margin-left:10px;"><?php print Dyhb::L("一般为localhost",'Default/Install',null);?></small></td></tr><tr><td><strong><?php print Dyhb::L("数据库用户",'Default/Install',null);?></strong></td><td><input name="dbuser" id="dbuser" type="text" value="root"/></td></tr><tr><td><strong><?php print Dyhb::L("数据库密码",'Default/Install',null);?></strong></td><td><div style='float:left;margin-right:3px;'><input name="dbpwd" id="dbpwd" type="password" onChange="testDb()" onBlur="testDb()"/></div><div style='float:left;margin-left:10px;' id='dbpwdsta'>&nbsp;</div></td></tr><tr><td><strong><?php print Dyhb::L("数据表前缀",'Default/Install',null);?></strong></td><td><input name="dbprefix" id="dbprefix" type="text" value="needforbug_" class="input-txt" /><small style="margin-left:10px;"><?php print Dyhb::L("如无特殊需要,请不要修改",'Default/Install',null);?></small></td></tr><tr><td><strong><?php print Dyhb::L("数据库名称",'Default/Install',null);?></strong></td><td><div style='float:left;margin-right:3px;'><input name="dbname" id="dbname" type="text" value="<?php echo(NEEDFORBUG_DATABASE);?>" onChange="haveDb()" onBlur="haveDb()"/></div><div style='float:left;margin-left:10px;' id='havedbsta'>&nbsp;</div></td></tr></tbody></table></p></div></div><div class="row"><div class="span12"><h2><?php print Dyhb::L("管理员数据初始化",'Default/Install',null);?></h2><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><tbody><tr><td><strong><?php print Dyhb::L("用户名",'Default/Install',null);?></strong></td><td><input name="adminuser" type="text" value="admin" /><small style="margin-left:10px;"><?php print Dyhb::L("只能用以数字、字母、下划线组成的字符",'Default/Install',null);?></small></td></tr><tr><td><strong><?php print Dyhb::L("密　码",'Default/Install',null);?></strong></td><td><input name="adminpwd" type="password" value="123456" /><small style="margin-left:10px;"><?php print Dyhb::L("管理员默认密码为123456",'Default/Install',null);?></small></td></tr><tr><td><strong><?php print Dyhb::L("Cookie前缀",'Default/Install',null);?></strong></td><td><input name="cookieprefix" type="text" value="needforbug_<?php echo(G::randString(6));?>_" /></td></tr><tr><td><strong><?php print Dyhb::L("Rbac前缀",'Default/Install',null);?>：</strong></td><td><input name="rbacprefix" type="text" value="needforbug_rbac_<?php echo(G::randString(6));?>_" class="input-txt" /></td></tr></tbody></table></p></div></div><div class="row"><div class="span12"><h2><?php print Dyhb::L("社区设置",'Default/Install',null);?></h2><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><tbody><tr><td><strong><?php print Dyhb::L("社区名称",'Default/Install',null);?></strong></td><td><input name="webname" type="text" value="NeedForBug" /></td></tr><tr><td><strong><?php print Dyhb::L("管理员邮箱",'Default/Install',null);?></strong></td><td><input name="adminmail" type="text" value="admin@admin.com" /></td></tr><tr><td><strong><?php print Dyhb::L("社区地址",'Default/Install',null);?></strong></td><td><input name="baseurl" type="text" value="<?php echo($sBaseurl);?>" /><small style="margin-left:10px;"><?php print Dyhb::L("社区地址由程序自动获取，如果错误请自己修正，注意结尾不要有“/”",'Default/Install',null);?></small></td></tr></tbody></table></p></div></div><div class="row"><div class="span12"><h2><?php print Dyhb::L("安装应用",'Default/Install',null);?></h2><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><tbody><?php $i=1;?><?php if(is_array($arrApps)):foreach($arrApps as $key=>$sApp):?><tr><td><strong><?php echo($sApp);?></strong></td><td><input type="checkbox" name="app[]" value="<?php echo($sApp);?>" checked="true"></td></tr><?php $i++;?><?php endforeach;endif;?></tbody></table></p></div></div></form><div class="row"><div class="span12"><div class="well"><p><input type="button" class="btn" value="<?php print Dyhb::L("后退",'Default/Install',null);?>" onclick="window.location.href='<?php echo(Dyhb::U( 'index/step2' ));?>';" /><span class="pipe">|</span><input type="button" class="btn btn-primary" value="<?php print Dyhb::L("开始安装",'Default/Install',null);?>" onclick="doInstall();" /></p></div></div></div><?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_footer.html');?>