<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-26 17:23:42  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_header.html');?><ul class="breadcrumb"><li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'Default/Install',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span></li><li><?php echo($__MessageTitle__);?></li></ul><div class="row"><div class="span2">&nbsp;</div><div class="span8"><div class="well"><h3><?php echo($__MessageTitle__);?></h3><?php if(isset( $__Message__ ) AND !empty( $__Message__ )):?><p><img src="<?php echo($__InfobigImg__);?>" style="margin-right:10px;"/><?php echo($__Message__);?></p><?php endif;?><?php if(isset( $__ErrorMessage__ ) AND !empty( $__ErrorMessage__ )):?><p><img src="<?php echo($__ErrorbigImg__);?>" style="margin-right:10px;"/><?php echo($__ErrorMessage__);?></p><?php endif;?><p><div id="__Loader__"><img src="<?php echo($__LoadingImg__);?>"/></div></p><p id="__JumpUrl__"><?php if(isset( $__CloseWindow__ ) AND !empty( $__CloseWindow__ )):?><span class="red" id="__Seconds__"><?php echo($__WaitSecond__);?></span>&nbsp;<?php print Dyhb::L("系统即将自动关闭",'Default/Common',null);?><?php print Dyhb::L("如果不想等待,直接点击",'Default/Common',null);?>&nbsp;<a href="<?php echo($__JumpUrl__);?>" class="lightlink"><?php print Dyhb::L("这里",'Default/Common',null);?></a>&nbsp;<?php print Dyhb::L("关闭",'Default/Common',null);?><?php endif;?><?php if(!isset( $__CloseWindow__ ) OR empty( $__CloseWindow__ )):?><span class="red" id="__Seconds__"><?php echo($__WaitSecond__);?></span>&nbsp;<?php print Dyhb::L("系统即将自动跳转",'Default/Common',null);?><?php print Dyhb::L("如果不想等待,直接点击",'Default/Common',null);?>&nbsp;<a href="<?php echo($__JumpUrl__);?>" class="lightlink "><?php print Dyhb::L("这里",'Default/Common',null);?></a>&nbsp;<?php print Dyhb::L("跳转",'Default/Common',null);?><?php endif;?></p></div></div><div class="span2">&nbsp;</div></div><?php echo($__JavaScript__);?><?php $this->includeChildTemplate(TEMPLATE_PATH.'/common_footer.html');?>