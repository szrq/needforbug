<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 08:40:03  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

<script type="text/javascript">
function joinGroup(gid){
	var sUrl="<?php echo(Dyhb::U('group://group/joingroup'));?>";
	Dyhb.AjaxSend(sUrl,'gid='+gid,'',function(data,status){
		if(status==1){
		}
	});
}
</script>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://name@?id='.$oGroup->group_name));?>"><?php echo($oGroup->group_nikename);?></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li>查看小组</li>
		</ul>

		<div class="row">
			<div class="span12">
				<dl>
					<dt class="left"><a href=""><img src="<?php echo(Group_Extend::getGroupIcon($oGroup['group_icon']));?>" width="48" height="48" alt="" /></a>
					</dt>
					<dd style="padding-left:50px;">
						<p class="name"><a href="<?php echo(Dyhb::U('group://name@?id='.$oGroup['group_name']));?>" id="groupName"><?php echo($oGroup['group_nikename']);?></a>&nbsp;群组&nbsp;<a id="join_group" name="join_group" href="javascript:void(0);" onclick="joinGroup(<?php echo($oGroup['group_id']);?>);">+申请加入</a></p>
						<p>共有 <span class="label label-success"><?php echo($oGroup['group_usernum']);?></span>人关注了此小组
					</dd>
				</dl>
			</div>
			<div class="span12">
				<h4>小组介绍</h4>
				<p class="well" style="margin-top:5px;"><?php echo($oGroup['group_description']);?></p>
			</div>
			<div class="span10">
				<ul class="nav nav-pills" id="navPills">
					<li class="<?php if(empty($nCid)):?>active<?php endif;?>"><a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name));?>">全部帖子</a></li>
					<?php $i=1;?>
<?php if(is_array($arrGrouptopiccategory)):foreach($arrGrouptopiccategory as $key=>$oGrouptopiccategory):?>

					<?php if($i<8):?>
					<li class="<?php if($nCid==$oGrouptopiccategory->grouptopiccategory_id):?>active<?php endif;?>">
						<a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name.'&cid='.$oGrouptopiccategory->grouptopiccategory_id));?>"><?php echo($oGrouptopiccategory->grouptopiccategory_name);?></a>
					</li>
					<?php array_shift($arrCid);?>
					<?php elseif($i==8):?>
					<li class="dropdown <?php if(in_array($nCid,$arrCid)):?>active<?php endif;?>">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
							更多类别<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li class="<?php if($nCid==$oGrouptopiccategory->grouptopiccategory_id):?>active<?php endif;?>">
								<a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name.'&cid='.$oGrouptopiccategory->grouptopiccategory_id));?>"><?php echo($oGrouptopiccategory->grouptopiccategory_name);?></a>
							</li>
							<?php elseif($i>8):?>
							<li class="<?php if($nCid==$oGrouptopiccategory->grouptopiccategory_id):?>active<?php endif;?>">
								<a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name.'&cid='.$oGrouptopiccategory->grouptopiccategory_id));?>"><?php echo($oGrouptopiccategory->grouptopiccategory_name);?></a>
							</li>
							<?php else:?>
						</ul>
					</li>
					<?php endif;?>
					
<?php $i++;?>
<?php endforeach;endif;?>
				</ul>
			</div>
			<div class="span2" style="text-align:right;">
				<p><a href="<?php echo(Dyhb::U('group://grouptopic/add?gid='.$oGroup['group_id']));?>" class="btn btn-success">发布帖子</a></p>
			</div>
			<div class="span12">
				<div id="topic_list_box">
					<table width="100%" class="table">
						<thead>
							<tr style="border-bottom:1px solid #eeeeee;">
								<th style="width:61px;">发帖人</th>
								<th><a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name.'&cid='.$nCid.'&did=1'));?>">精华</a></th>
								<th style="text-align:center;width:130px;">
									<a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name.'&cid='.$nCid));?>" style="<?php if($sType=='create_dateline'):?>color:gray;<?php endif;?>">最新</a>
									<span class="pipe">|</span>
									<a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name.'&cid='.$nCid.'&type='.view));?>" style="<?php if($sType=='grouptopic_views'):?>color:gray;<?php endif;?>">浏览</a>
									<span class="pipe">|</span>
									<a href="<?php echo(Dyhb::U('group://group/show?id='.$oGroup->group_name.'&cid='.$nCid.'&type='.com));?>" style="<?php if($sType=='grouptopic_comments'):?>color:gray;<?php endif;?>">回复</a>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;?>
<?php if(is_array($arrGrouptopics)):foreach($arrGrouptopics as $key=>$oGrouptopic):?>

							<tr>
								<td class="author">
									<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>">
										<img class="thumbnail" src="<?php echo(Core_Extend::avatar($oGrouptopic['user_id'],'small'));?>" width="45px" height="45px" alt="<?php echo($oGrouptopic->grouptopic_username);?>" />
									</a>
								</td>
								<td class="subject">
									<p class="title">
										<?php if($oGrouptopic->grouptopiccategory_id>0):?>
										<a href="#">[<?php echo($oGrouptopic->grouptopiccategory->grouptopiccategory_name);?>]</a>
										<?php else:?>
										<a href="#">[默认分类]</a>
										<?php endif;?>
										<a href="<?php echo(Dyhb::U('group://topic@?id='.$oGrouptopic->grouptopic_id));?>" title="<?php echo($oGrouptopic->grouptopic_title);?>"><?php echo(G::subString($oGrouptopic->grouptopic_title,0,50));?></a>
									</p>
									<p class="info">
										楼主&nbsp;<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id));?>"><?php echo($oGrouptopic->grouptopic_username);?></a>
										<span><?php echo(Core_Extend::timeFormat($oGrouptopic->create_dateline));?></span>
										<span class="pipe">|</span>
										<?php if($oGrouptopic->grouptopic_comments>0):?>
										<?php $arrLatestComment=$TheController->unserialize($oGrouptopic->grouptopic_latestcomment);?>
										最后回复&nbsp;<a href="#"><?php echo($arrLatestComment['commentusername']);?></a>
										<span><?php echo(Core_Extend::timeFormat($arrLatestComment['commenttime']));?></span>
										<?php else:?>
										<span>暂无回复</span>
										<?php endif;?>
									</p>
								</td>
								<td class="num" style="text-align:center;">
									<span>浏览<em><?php echo($oGrouptopic->grouptopic_views);?></em></span>
									<span>回复<em><?php echo($oGrouptopic->grouptopic_comments);?></em></span>
								</td>
							</tr>
							
<?php $i++;?>
<?php endforeach;endif;?>
						</tbody>
					</table>
				</div>

				<?php echo($sPageNavbar);?>
			</div>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>