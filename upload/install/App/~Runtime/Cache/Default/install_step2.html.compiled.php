<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-26 17:24:29  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_header.html');?><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'Default/Install',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span></li><li><?php print Dyhb::L("环境检测",'Default/Install',null);?></li></ul><div class="row"><div class="span12"><h2><?php print Dyhb::L("服务器信息",'Default/Install',null);?></h2><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><thead><tr><th width="300" align="center"><strong><?php print Dyhb::L("参数",'Default/Install',null);?></strong></th><th width="424"><strong><?php print Dyhb::L("值",'Default/Install',null);?></strong></th></tr></thead><tbody><tr><td><?php print Dyhb::L("服务器域名",'Default/Install',null);?></td><td><?php echo($arrInfo['sp_name']);?></td></tr><tr><td><?php print Dyhb::L("服务器操作系统",'Default/Install',null);?></td><td><?php echo($arrInfo['sp_os']);?></td></tr><tr><td><?php print Dyhb::L("服务器解译引擎",'Default/Install',null);?></td><td><?php echo($arrInfo['sp_server']);?></td></tr><tr><td><?php print Dyhb::L("PHP版本",'Default/Install',null);?></td><td><?php echo($arrInfo['phpv']);?></td></tr><tr><td><?php print Dyhb::L("系统安装目录",'Default/Install',null);?></td><td><?php echo(NEEDFORBUG_PATH);?></td></tr></tbody></table></p></div></div><div class="row"><div class="span12"><h2><?php print Dyhb::L("系统环境检测",'Default/Install',null);?></h2><div style="padding:2px 8px 0px; line-height:33px; height:23px; overflow:hidden; color:#666;"><?php print Dyhb::L("系统环境要求必须满足下列所有条件，否则系统或系统部份功能将无法使用。",'Default/Install',null);?></div><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><thead><tr><th width="200" align="center"><strong><?php print Dyhb::L("需开启的变量或函数",'Default/Install',null);?></strong></th><th width="80"><strong><?php print Dyhb::L("要求",'Default/Install',null);?></strong></th><th width="400"><strong><?php print Dyhb::L("实际状态及建议",'Default/Install',null);?></strong></th></tr></thead><tbody><tr><td>allow_url_fopen</td><td align="center">On </td><td><?php echo($arrInfo['sp_allow_url_fopen']);?><small>(<?php print Dyhb::L("不符合要求将导致采集、远程资料本地化等功能无法应用",'Default/Install',null);?>)</small></td></tr><tr><td>safe_mode</td><td align="center">Off</td><td><?php echo($arrInfo['sp_safe_mode']);?><small>(<?php print Dyhb::L("本系统不支持在",'Default/Install',null);?><span class="STYLE2"><?php print Dyhb::L("非win主机的安全模式",'Default/Install',null);?></span><?php print Dyhb::L("下运行",'Default/Install',null);?>)</small></td></tr><tr><td><?php print Dyhb::L("GD 支持",'Default/Install',null);?></td><td align="center">On</td><td><?php echo($arrInfo['sp_gd']);?><small>(<?php print Dyhb::L("不支持将导致与图片相关的大多数功能无法使用或引发警告",'Default/Install',null);?>)</small></td></tr><tr><td><?php print Dyhb::L("MySQL 支持",'Default/Install',null);?></td><td align="center">On</td><td><?php echo($arrInfo['sp_mysql']);?><small>(<?php print Dyhb::L("不支持无法使用本系统",'Default/Install',null);?>)</small></td></tr></tbody></table></p></div></div><div class="row"><div class="span12"><h2><?php print Dyhb::L("目录权限检测",'Default/Install',null);?></h2><div style="padding:2px 8px 0px; line-height:33px; height:23px; overflow:hidden; color:#666;"><?php print Dyhb::L("系统要求必须满足下列所有的目录权限全部可读写的需求才能使用，其它应用目录可安装后在管理后台检测。",'Default/Install',null);?></div><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><thead><tr><th width="300" align="center"><strong><?php print Dyhb::L("目录名",'Default/Install',null);?> + <?php print Dyhb::L("文件名",'Default/Install',null);?></strong></th><th width="212"><strong><?php print Dyhb::L("读取权限",'Default/Install',null);?></strong></th><th width="212"><strong><?php print Dyhb::L("写入权限",'Default/Install',null);?></strong></th></tr></thead><tbody><?php $i=1;?><?php if(is_array($arrSpTestDirs)):foreach($arrSpTestDirs as $key=>$sSpTestDir):?><tr><td><?php echo($sSpTestDir);?></td><?php $sFullPath=NEEDFORBUG_PATH.'/'.str_replace( '/*','',$sSpTestDir );$sRsta=( is_readable( $sFullPath ) ? '<font color=green>[√]'.Dyhb::L( '读','Default/Install' ).'</font>' : '<font color=red>[×]'.Dyhb::L( '读','Default/Install' ).'</font>' );$sWsta=( ( is_file( $sFullPath )?is_writeable( $sFullPath ):Install_Extend::testWrite( $sFullPath ) ) ? '<font color=green>[√]'.Dyhb::L( '写','Default/Install' ).'</font>' : '<font color=red>[×]'.Dyhb::L( '写','Default/Install' ).'</font>' );?><td><?php echo($sRsta);?></td><td><?php echo($sWsta);?></td></tr><?php $i++;?><?php endforeach;endif;?></tbody></table></p></div></div><div class="row"><div class="span12"><div class="well"><p><input type="button" class="btn" value="<?php print Dyhb::L("后退",'Default/Install',null);?>" onclick="window.location.href='<?php if(MODULE_NAME==='index'):?><?php echo(Dyhb::U( 'index/step1' ));?><?php else:?><?php echo(Dyhb::U( 'update/index' ));?><?php endif;?>';" /><span class="pipe">|</span><input type="button" class="btn btn-primary" value="<?php print Dyhb::L("下一步",'Default/Install',null);?>" onclick="window.location.href='<?php if(MODULE_NAME==='index'):?><?php echo(Dyhb::U( 'index/step3' ));?><?php else:?><?php echo(Dyhb::U( 'update/step1' ));?><?php endif;?>';" /></p></div></div></div><?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_footer.html');?>