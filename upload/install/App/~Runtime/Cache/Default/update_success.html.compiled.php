<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-08-27 11:29:26  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_header.html');?><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'Template/Default/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span></li><li><?php print Dyhb::L("升级完毕",'Template/Default/Update',null);?></li></ul><?php $this->includeChildTemplate(TEMPLATE_PATH.'/update_process.html');?><div class="row"><div class="span12"><h2><?php print Dyhb::L("恭喜你成功升级",'Template/Default/Update',null);?></h2><p><?php print Dyhb::L("升级成功，请进入后台重建数据以及更新缓存并仔细检查系统设置以完成整个升级过程。",'Template/Default/Update',null);?><br/><blockquote><em><?php print Dyhb::L("浏览器会在5秒后自动跳转页面，无需人工干预",'Template/Default/Update',null);?></em></blockquote></p></div></div><script type="text/javascript">setTimeout(function(){window.location='<?php echo(__ROOT__);?>/index.php';},5000);</script><?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_footer.html');?>