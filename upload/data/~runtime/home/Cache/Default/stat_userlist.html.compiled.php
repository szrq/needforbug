<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:05:19  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

<script type="text/javascript">
function findUser(){
	if(!$('#key').val()){
		needforbugAlert(D.L('用户关键字不能为空','AppJs'),'',3);
		return false;
	}else{
		return true;
	}
}

function addFriend(userid){
	Dyhb.AjaxSend('<?php echo(Dyhb::U('home://friend/add'));?>','ajax=1&uid='+userid,'',function(data,status){
		if(status==1){
			window.location.reload();
		}
	});
}

function deleteFriend(friendid,fan){
	needforbugConfirm(D.L('确实要永久删除选择项吗？','__COMMON_LANG__@Admin/Common_Js'),function(){
		Dyhb.AjaxSend(D.U('home://friend/delete?friendid='+friendid+(fan=='1'?'&fan=1':'')),'','',function(data,status){
			if(status==1){
				window.location.reload();
			}
		});
	});
}
</script>


		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><?php print Dyhb::L("社区广场",'Template/Stat',null);?> <span class="divider">/</span></li>
			<li><a href="<?php echo(Dyhb::U('home://friend/index'));?>"><?php print Dyhb::L("我的好友",'Template/Stat',null);?></a></li>
		</ul>
		
		<?php $this->includeChildTemplate(TEMPLATE_PATH.'/stat_menu.html');?>
		
		<div class="row">
			<div class="span12">
				<form class="well form-search" action="<?php echo(Dyhb::U('home://stat/userlist'));?>" method="get" onsubmit="return findUser();">
					<input type="text" class="input-medium search-query" name="key" id="key">&nbsp;
					<button type="submit" class="btn"><i class="icon-search"></i>&nbsp;<?php print Dyhb::L("查找会员",'Template/Stat',null);?></button>
				</form>

				<?php if($sKey):?>
				<div class="alert alert-success">
					<?php print Dyhb::L("你搜索的关键字为",'Template/Stat',null);?>&nbsp;<strong><span class="label label-success"><a href="<?php echo(Dyhb::U('home://stat/userlist?key='.$sKey));?>"><?php echo($sKey);?></a></span></strong>，<?php print Dyhb::L("你可以查看",'Template/Stat',null);?>&nbsp;<a href="<?php echo(Dyhb::U('home://stat/userlist'));?>"><?php print Dyhb::L("会员列表",'Template/Stat',null);?></a>
				</div>
				<?php endif;?>

				<?php if(is_array($arrUsers)):?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th colspan="2"><a href="<?php echo(Core_Extend::sortBy('user_name'));?>" <?php echo(Core_Extend::sortField('user_name'));?>><?php print Dyhb::L("用户名",'Template/Stat',null);?></a></th>
							<th><a href="<?php echo(Core_Extend::sortBy('user_id'));?>" <?php echo(Core_Extend::sortField('user_id'));?>>UID</a></th>
							<th><?php print Dyhb::L("性别",'Template/Stat',null);?></th>
							<th><a href="<?php echo(Core_Extend::sortBy('create_dateline'));?>" <?php echo(Core_Extend::sortField('create_dateline'));?>><?php print Dyhb::L("注册日期",'Template/Stat',null);?></a></th>
							<th><a href="<?php echo(Core_Extend::sortBy('user_lastlogintime'));?>" <?php echo(Core_Extend::sortField('user_lastlogintime'));?>><?php print Dyhb::L("上次访问",'Template/Stat',null);?></a></th>
							<th><a href="<?php echo(Core_Extend::sortBy('user_logincount'));?>" <?php echo(Core_Extend::sortField('user_logincount'));?>><?php print Dyhb::L("登陆次数",'Template/Stat',null);?></a></th>
							<th><a href="<?php echo(Core_Extend::sortBy('user_status'));?>" <?php echo(Core_Extend::sortField('user_status'));?>><?php print Dyhb::L("状态",'Template/Stat',null);?></a></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
<?php if(is_array($arrUsers)):foreach($arrUsers as $key=>$oUser):?>

						<tr>
							<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oUser['user_id']));?>"><img src="<?php echo(Core_Extend::avatar( $oUser['user_id'],'small' ));?>" width="48px" height="48px" class="thumbnail" /></a></td>
							<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oUser['user_id']));?>"><?php echo($oUser->user_name);?></a>&nbsp;<?php if($oUser['user_nikename']):?>(<?php echo($oUser['user_nikename']);?>)<?php endif;?>
								<?php if($GLOBALS['___login___']!==false):?><br/>
								<?php $nAlreadyFriendId=Core_Extend::isAlreadyFriend($oUser['user_id']);?>
								<?php if($nAlreadyFriendId==1):?><span class="label label-warning"><a href="javascript:void(0);" onclick="deleteFriend('<?php echo($oUser['user_id']);?>','0');return false;"><?php print Dyhb::L("取消关注",'Template/Stat',null);?></a></span>
								<?php elseif($nAlreadyFriendId==2):?><span class="label"><?php print Dyhb::L("你自己",'Template/Stat',null);?></span>
								<?php elseif($nAlreadyFriendId==3):?><span class="label" ><?php print Dyhb::L("你粉丝",'Template/Stat',null);?></span><p style="margin-top:10px;"><span class="label label-success"><a href="javascript:void(0);" onclick="addFriend('<?php echo($oUser->user_id);?>');return false;"><?php print Dyhb::L("关注",'Template/Stat',null);?></a></span>&nbsp;<span class="label label-warning"><a href="javascript:void(0);" onclick="deleteFriend('<?php echo($oUser['user_id']);?>','1');return false;"><?php print Dyhb::L("移除粉丝",'Template/Stat',null);?></a></span></p>
								<?php elseif($nAlreadyFriendId==4):?><span class="label" ><?php print Dyhb::L("相互关注",'Template/Stat',null);?></span><p style="margin-top:10px;"><span class="label label-warning"><a href="javascript:void(0);" onclick="deleteFriend('<?php echo($oUser['user_id']);?>','0');return false;"><?php print Dyhb::L("取消关注",'Template/Stat',null);?></a></span>&nbsp;<span class="label label-warning"><a href="javascript:void(0);" onclick="deleteFriend('<?php echo($oUser['user_id']);?>','1');return false;"><?php print Dyhb::L("移除粉丝",'Template/Stat',null);?></a></span></p>
								<?php else:?><span class="label label-success"><a href="javascript:void(0);" onclick="addFriend('<?php echo($oUser->user_id);?>');return false;"><?php print Dyhb::L("关注",'Template/Stat',null);?></a></span>
								<?php endif;?>
								<p style="margin-top:5px;"><a href="<?php echo(Dyhb::U('home://pm/pmnew?uid='.$oUser->user_id));?>"><?php print Dyhb::L("发送短消息",'Template/Stat',null);?></a></p>
								<?php endif;?>
							</td>
							<td><?php echo($oUser->user_id);?></td>
							<td><?php echo(Profile_Extend::getGender($oUser->userprofile->userprofile_gender));?></td>
							<td><?php echo(Core_Extend::timeFormat($oUser->create_dateline));?></td>
							<td><?php if($oUser['user_lastlogintime']):?><?php echo(Core_Extend::timeFormat($oUser->user_lastlogintime));?><?php else:?><?php print Dyhb::L("注册访问",'Template/Stat',null);?><?php endif;?></td>
							<td><span class="badge badge-label-info"><?php echo($oUser->user_logincount);?></span></td>
							<td><?php if($oUser['user_status']):?><i class="icon-ok"></i><?php else:?><i class="icon-remove"></i><?php endif;?></td>
						</tr>
						
<?php $i++;?>
<?php endforeach;endif;?>
					</tbody>
				</table>
				<?php else:?>
				<?php print Dyhb::L("暂时没有发现任何会员",'Template/Stat',null);?>
				<?php endif;?>
				
				<?php echo($sPageNavbar);?>
			</div>
		</div><!--/row-->

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>