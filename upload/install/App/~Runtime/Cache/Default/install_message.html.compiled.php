<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-08-27 11:21:21  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_header.html');?><script type="text/javascript">function showMessage(sMessage){document.getElementById('message-list').innerHTML+=sMessage+'<br />';document.getElementById('message-list').scrollTop=100000000;}function initInput(){window.location='<?php echo(Dyhb::U('index/success'));?>';}</script><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'Template/Default/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span></li><li><?php print Dyhb::L("正在安装",'Template/Default/Install',null);?></li></ul><?php $this->includeChildTemplate(TEMPLATE_PATH.'/install_process.html');?><div class="row"><div class="span12"><h2><?php print Dyhb::L("请仔细查看安装过程消息",'Template/Default/Install',null);?></h2><div id="message-list"></div></div></div><div class="row"><div class="span12"><div class="well"><p><input type="button" class="btn btn-primary" name="submit" value="<?php print Dyhb::L("正在安装",'Template/Default/Install',null);?>..." disabled="disabled" id="laststep" onclick="initInput()" /></p></div></div></div><?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_footer.html');?>