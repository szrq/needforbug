<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-27 11:29:15  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_header.html');?><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'Template/Default/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span></li><li><?php print Dyhb::L("升级数据库确认",'Template/Default/Update',null);?></li></ul><?php $this->includeChildTemplate(TEMPLATE_PATH.'/update_process.html');?><div class="row"><div class="span12"><h2><?php print Dyhb::L("你认真看看数据库连接信息是否是你需要的",'Template/Default/Update',null);?></h2><p><span style="color:#f00;"><?php print Dyhb::L("这是升级前的最后一次检查，请确保社区的数据库正确，以免覆盖其它程序。",'Template/Default/Update',null);?></span></p><div class="alert"><span style="color:#f00;font-weight:700;"><?php print Dyhb::L("再次提醒，升级前必须备份数据！",'Template/Default/Update',null);?></span></div></div></div><div class="row"><div class="span12"><h2><?php print Dyhb::L("当前连接的社区设置信息如下",'Template/Default/Update',null);?></h2><p><table border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered"><thead><tr><th width="300px" align="center"><?php print Dyhb::L("设置名称",'Template/Default/Update',null);?></th><th><?php print Dyhb::L("设置值",'Template/Default/Update',null);?></strong></th></tr></thead><tbody><?php $i=1;?><?php if(is_array($arrConfig)):foreach($arrConfig as $key=>$value):?><tr><td><strong><?php echo($key);?></strong></td><td><?php echo($value);?></td></tr><?php $i++;?><?php endforeach;endif;?></tbody></table></p></div></div><div class="row"><div class="span12"><h2><?php print Dyhb::L("确认开始升级",'Template/Default/Update',null);?></h2><p><?php print Dyhb::L("如果你没有了疑问，那么请点击升级数据即可（注意请备份老的数据库）。",'Template/Default/Update',null);?></p></div></div><div class="row"><div class="span12"><div class="well"><p><input type="button" class="btn" value="<?php print Dyhb::L("后退",'Template/Default/Common',null);?>" onclick="window.location.href='<?php echo(Dyhb::U( 'update/step2' ));?>';" /><span class="pipe">|</span><input type="button" class="btn btn-primary" value="<?php print Dyhb::L("升级数据",'Template/Default/Update',null);?>" onclick="window.location.href='<?php echo(Dyhb::U( 'update/first' ));?>'" /></p></div></div></div><?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_footer.html');?>