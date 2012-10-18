<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 09:07:57  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><?php print Dyhb::L("系统消息",'__COMMON_LANG__@Template/Message',null);?></li>
		</ul>
		
		<div class="row">
			<div class="span2">&nbsp;</div>
			<div class="span8">
				<div class="well">
					<h3><?php echo($__MessageTitle__);?></h3>
					<div style="overflow:hidden;">
						<table width="100%" border="0" align="left" valign="middle" cellpadding="0" cellspacing="0">
							<tr>
								<?php if(isset( $__Message__ ) AND !empty( $__Message__ )):?>
								<td width="60px" valign="middle"><img src="<?php echo($__InfobigImg__);?>" style="margin-right:10px;"/></td>
								<td valign="middle"><?php echo($__Message__);?></td>
								<?php endif;?>
								<?php if(isset( $__ErrorMessage__ ) AND !empty( $__ErrorMessage__ )):?>
								<td width="20px" valign="middle"><img src="<?php echo($__ErrorbigImg__);?>" style="margin-right:10px;"/></td>
								<td valign="middle"><?php echo($__ErrorMessage__);?></td>
								<?php endif;?>
							</tr>
						</table>
					</div>
					<p><div id="__Loader__"><img src="<?php echo($__LoadingImg__);?>"/></div></p>
					<p id="__JumpUrl__">
					<?php if(isset( $__CloseWindow__ ) AND !empty( $__CloseWindow__ )):?>
						<span class="red" id="__Seconds__"><?php echo($__WaitSecond__);?></span>&nbsp;<?php print Dyhb::L("系统即将自动关闭",'__COMMON_LANG__@Template/Message',null);?><?php print Dyhb::L("如果不想等待,直接点击",'__COMMON_LANG__@Template/Message',null);?>&nbsp;<a href="<?php echo($__JumpUrl__);?>" class="lightlink"><?php print Dyhb::L("这里",'__COMMON_LANG__@Template/Message',null);?></a>&nbsp;<?php print Dyhb::L("关闭",'__COMMON_LANG__@Template/Message',null);?>
					<?php endif;?>
					<?php if(!isset( $__CloseWindow__ ) OR empty( $__CloseWindow__ )):?>
						<span class="red" id="__Seconds__"><?php echo($__WaitSecond__);?></span>&nbsp;<?php print Dyhb::L("系统即将自动跳转",'__COMMON_LANG__@Template/Message',null);?><?php print Dyhb::L("如果不想等待,直接点击",'__COMMON_LANG__@Template/Message',null);?>&nbsp;<a href="<?php echo($__JumpUrl__);?>" class="lightlink "><?php print Dyhb::L("这里",'__COMMON_LANG__@Template/Message',null);?></a>&nbsp;<?php print Dyhb::L("跳转",'__COMMON_LANG__@Template/Message',null);?>
					<?php endif;?>
					</p>
				</div>
			</div>
			<div class="span2">&nbsp;</div>
		</div>
		<?php echo($__JavaScript__);?>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>