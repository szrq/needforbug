<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:05:30  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><?php print Dyhb::L("社区广场",'Template/Stat',null);?></li>
		</ul>
		
		<?php $this->includeChildTemplate(TEMPLATE_PATH.'/stat_menu.html');?>

		<div class="row">
			<div class="span12">
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">&times;</button>
					<?php print Dyhb::L("这里为整个站点的概况，它可以帮助你了解我们",'Template/Stat',null);?>
				</div>

				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2"><?php print Dyhb::L("会员统计",'Template/Stat',null);?></th>
						</tr>
					</thead>
					<tr>
						<td width="36%"><?php print Dyhb::L("注册会员",'Template/Stat',null);?></td>
						<td width="64%"><span class="badge badge-success"><a href="<?php echo(Dyhb::U('home://stat/userlist'));?>"><?php echo($arrSite['user']);?></a></span></td>
					</tr>
					<tr>
						<td><?php print Dyhb::L("管理成员",'Template/Stat',null);?></td>
						<td><span class="badge"><?php echo($arrSite['adminuser']);?></span></td>
					</tr>
					<tr>
						<td><?php print Dyhb::L("新会员",'Template/Stat',null);?></td>
						<td><span class="badge"><?php echo($arrSite['newuser']);?></span></td>
					</tr>
				</table>

				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2"><?php print Dyhb::L("站点统计",'Template/Stat',null);?></th>
						</tr>
					</thead>
					<tr>
						<td width="36%"><?php print Dyhb::L("应用数量",'Template/Stat',null);?></td>
						<td width="64%"><span class="badge"><?php echo($arrSite['app']);?></span></td>
					</tr>
					<tr>
						<td width="36%"><?php print Dyhb::L("新鲜事数量",'Template/Stat',null);?></td>
						<td width="64%"><span class="badge"><?php echo($arrSite['homefresh']);?></span></td>
					</tr>
					<tr>
						<td width="36%"><?php print Dyhb::L("评论数量",'Template/Stat',null);?></td>
						<td width="64%"><span class="badge"><?php echo($arrSite['homefreshcomment']);?></span></td>
					</tr>
				</table>
			</div>
		</div><!--/row-->

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>