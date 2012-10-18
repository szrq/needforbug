<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 08:40:00  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/group'));?>">小组</a></li>
		</ul>

		<div class="row">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">新帖</a></li>
					<li  class="active"><a href="<?php echo(Dyhb::U('group://public/group'));?>">小组</a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="span12">
				<?php $i=1;?>
<?php if(is_array($arrGroupcategorys)):foreach($arrGroupcategorys as $key=>$oGroupcategory):?>

				<table border="0" cellspacing="0" cellpadding="0" align="left" class="tableborder" width="100%">
					<tr>
						<td class="grouplist_td">
							<table cellpadding="4" cellspacing="1" width="100%" border="0">
								<tr>
									<td colspan="7" class="grouplist_header">
										<span class="grouplist_groupname">
											<div style='display:inline;float:left;'>
												<a href="<?php echo(Dyhb::U('group://category@?id='.$oGroupcategory['groupcategory_id']));?>">
													<?php echo($oGroupcategory['groupcategory_name']);?>
												</a>
											</div>
											<div style='display:inline;float:right;'></div>
										</span>
									</td>
								</tr>
								<tr class="grouplist_index">
									<td width="*" colspan="2"><span>小组名称</span></td>
									<td width="40"><span>主题</span></td>
									<td width="40"><span>回复</span></td>
									<td width="40"><span>用户</span></td>
									<td width="200"><span>最后更新</span></td>
								</tr>
								<?php $arrGroups=$oGroupcategory->group;?>
								<?php if(is_array($arrGroups)):?>
								<?php $i=1;?>
<?php if(is_array($arrGroups)):foreach($arrGroups as $key=>$oGroup):?>

								<tr align="center" valign="middle" class="grouptopicone">
									<td width="26" class="grouplist_borderbottom">
										<a href="">
											<img src='<?php echo(Group_Extend::getGroupIcon($oGroup['group_icon']));?>' border="0" alt="" />
										</a>
									</td>
									<td width="*" align="left" class="grouplist_borderbottom">
										<table width="100%" cellpadding="1">
											<tr>
												<td width="*" rowspan="2"></td>
												<td width="1" rowspan="2"></td>
												<td width="100%" height="10"><span class='grouplist_namelink'><a href="<?php echo(Dyhb::U('group://name@?id='.$oGroup['group_name']));?>" href=""><?php echo($oGroup->group_nikename);?></a></span><span class='grouplist_todaynum'><?php if($oGroup['group_topictodaynum']>0):?>(今日27)</span><?php endif;?>
												</td>
											</tr>
											<?php if($oGroup->group_listdescription):?>
											<tr>
												<td valign="top"><span class="grouplist_description"><?php echo($oGroup->group_listdescription);?></span></td>
											</tr>
											<?php endif;?>
										</table>
									</td>
									<td width="40" valign="middle" align="center" class="grouplist_borderbottom">
										<span class="cau"><?php echo($oGroup->group_topicnum);?></span>
									</td>
									<td width="40" valign="middle" align="center" class="grouplist_borderbottom">
										<span class="cau"><?php echo($oGroup->group_topiccomment);?></span>
									</td>
									<td width="40" valign="middle" align="center" class="grouplist_borderbottom">
										<span class="cau"><?php echo($oGroup->group_usernum);?></span>
									</td>
									<?php $arrLatestComment=$TheController->unserialize($oGroup->group_latestcomment);?>
									<td width="168" align="right" class="grouplist_borderbottom">
										<table width="100%" align="right">
											<tr>
												<td width="2%" align="right">&nbsp;</td>
												<td class="indexsummaryalgin"><?php if(!empty($oGroup->group_topiccomment)):?><a title="Re:<?php echo($arrLatestComment['commenttitle']);?>" href="<?php echo(Dyhb::U('group://grouptopic/view?id='.$arrLatestComment['tid']));?>">Re:<?php echo(G::subString($arrLatestComment['commenttitle'],0,25));?></a><br /><?php echo(Core_Extend::timeFormat($arrLatestComment['commenttime']));?>&nbsp;最后回复:<a href="<?php echo(Dyhb::U('home://space@?id='.$arrLatestComment['commentuserid']));?>"><?php echo(UserModel::getUsernameById($arrLatestComment['commentuserid']));?></a>&nbsp;
												<?php endif;?></td>
											</tr>
										</table>
									</td>
								</tr>
								
<?php $i++;?>
<?php endforeach;endif;?>
								<?php else:?>
								<tr>
									<td valign="middle" align="center" class="grouplist_borderbottom" colspan="6">
										暂时没有发现任何小组
									</td>
								</tr>
								<?php endif;?>
							</table>
							<?php if($key<=count($arrGroupcategorys)):?>
							<div class="space"></div>
							<?php endif;?>
						</td>
					</tr>
				</table>
				
<?php $i++;?>
<?php endforeach;endif;?>
			</div>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>