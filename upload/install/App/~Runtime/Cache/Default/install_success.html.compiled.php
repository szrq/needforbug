<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-26 17:38:44  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_header.html');?><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'Default/Install',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span></li><li><?php print Dyhb::L("安装成功",'Default/Install',null);?></li></ul><div class="row"><div class="span12"><h2><?php print Dyhb::L("恭喜你安装成功</h2><p>尊敬的用户，你已经成功安装了NeedForBug-",'Default/Install',null);?>-<?php echo(NEEDFORBUG_SERVER_VERSION);?>，系统将进入首页</lang><br/><blockquote><em><?php print Dyhb::L("浏览器会在3秒后自动跳转页面，无需人工干预",'Default/Install',null);?></em></blockquote></p></div></div><script type="text/javascript">setTimeout(function(){window.location='<?php echo(__ROOT__);?>/index.php';},3000);</script><?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_footer.html');?>