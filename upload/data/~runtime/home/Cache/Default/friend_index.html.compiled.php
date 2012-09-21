<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:06:07  */ ?>
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

function changeDiv(buddyid){
	showDiv('commenthide_'+buddyid);
	showDiv('commentbox_'+buddyid);
	showDiv('commentedit_'+buddyid);
}

function editComment(buddyid){
	changeDiv(buddyid);
	document.getElementById('comment_'+buddyid).focus();
}

function updateComment(buddyid,fan){
	changeDiv(buddyid);
	var comment=Dyhb.Browser.Ie && document.charset=='utf-8'?encodeURIComponent(document.getElementById('comment_'+buddyid).value):document.getElementById('comment_'+ buddyid).value;
	document.getElementById('commenthide_'+buddyid).innerHTML=preg_replace(['&','<','>','"'],['&amp;','&lt;','&gt;','&quot;'], comment);
	Dyhb.AjaxSend('<?php echo(Dyhb::U('home://friend/edit'));?>','ajax=1&friendid='+buddyid+'&comment='+comment+(fan=='1'?'&fan=1':''),'');
}

function preg_replace(search, replace, str){
	var len=search.length;
	for(var i=0;i < len;i++){
		re=new RegExp(search[i], "ig");
		str=str.replace(re,typeof replace=='string'?replace:(replace[i]?replace[i]:replace[0]));
	}
	
	return str;
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
			<li><?php if($sType=='fan'):?><?php print Dyhb::L("我的粉丝",'Template/Friend',null);?><?php else:?><?php print Dyhb::L("我的好友",'Template/Friend',null);?><?php endif;?> <span class="divider">/</span></li>
			<li><a href="<?php echo(Dyhb::U('home://stat/userlist'));?>"><?php print Dyhb::L("会员列表",'Template/Friend',null);?></a></li>
		</ul>
		
		<div class="row">
			<div class="span2">
				<div class="well" style="padding: 8px 0;">
					<ul class="nav nav-list">
						<li class="nav-header"><i class="icon-user"></i>&nbsp;<?php print Dyhb::L("我的好友",'Template/Friend',null);?></li>
						<li class="active"><a href="#"><?php print Dyhb::L("好友列表",'Template/Friend',null);?></a></li>
						<li><a href="#"><?php print Dyhb::L("查找好友",'Template/Friend',null);?></a></li>
						<li><a href="#"><?php print Dyhb::L("可能认识的人",'Template/Friend',null);?></a></li>
						<li><a href="#"><?php print Dyhb::L("好友请求",'Template/Friend',null);?></a></li>
						<li><a href="#"><?php print Dyhb::L("好友分组",'Template/Friend',null);?></a></li>
						<li class="divider"></li>
						<li><a href="<?php echo(Dyhb::U('home://ucenter/index'));?>"><i class="icon-share-alt"></i>&nbsp;<?php print Dyhb::L("返回个人中心",'Template/Friend',null);?></a></li>
					</ul>
				</div>
			</div>
		
			<div class="span10">
				<ul class="nav nav-pills">
					<li <?php if(!$sType=='fan'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://friend/index'));?>"><?php print Dyhb::L("我的好友",'Template/Friend',null);?></a></li>
					<li <?php if($sType=='fan'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('home://friend/index?type=fan'));?>"><?php print Dyhb::L("我的粉丝",'Template/Friend',null);?></a></li>
				</ul>
				<form class="well form-search" action="<?php echo(Dyhb::U('home://friend/index'));?>" method="get" onsubmit="return findUser();">
					<?php if($sType=='fan'):?><input type="hidden" name="type" value="fan"><?php endif;?>
					<input type="text" class="input-medium search-query" name="key" id="key">&nbsp;
					<button type="submit" class="btn"><i class="icon-search"></i>&nbsp;<?php if($sType=='fan'):?><?php print Dyhb::L("查找粉丝",'Template/Friend',null);?><?php else:?><?php print Dyhb::L("查找好友",'Template/Friend',null);?><?php endif;?></button>
				</form>
				<?php if($sKey):?>
				<div class="alert alert-success">
					<?php print Dyhb::L("你搜索的关键字为",'Template/Friend',null);?>&nbsp;<strong><span class="label label-success"><a href="<?php echo(Dyhb::U('home://friend/index?key='.$sKey.($sType=='fan'?'&type=fan':'')));?>"><?php echo($sKey);?></a></span></strong>，<?php print Dyhb::L("你可以查看",'Template/Friend',null);?>&nbsp;<a href="<?php if($sType=='fan'):?><?php echo(Dyhb::U('home://friend/index?type=fan'));?><?php else:?><?php echo(Dyhb::U('home://friend/index'));?><?php endif;?>"><?php if($sType=='fan'):?><?php print Dyhb::L("粉丝列表",'Template/Friend',null);?><?php else:?><?php print Dyhb::L("好友列表",'Template/Friend',null);?><?php endif;?></a>
				</div>
				<?php endif;?>
				<?php if(is_array($arrFriends)):?>
				<ul class="thumbnails">
					<?php $i=1;?>
<?php if(is_array($arrFriends)):foreach($arrFriends as $key=>$oFriend):?>

					<?php $nUserId=($sType=='fan'?$oFriend['user_id']:$oFriend['friend_friendid']);?>
					<li class="span3">
						<div class="thumbnail">
							<img src="<?php echo(Core_Extend::avatar( $nUserId,'middle' ));?>" width="120px" height="120px" alt="">
							<div class="caption" style="text-align:center;">
								<a href="<?php echo(Dyhb::U('home://space@?id='.$nUserId));?>"><h5><?php echo(UserModel::getUsernameById($nUserId));?>@<?php echo($nUserId);?></h5></a>
								<p><?php $sUsersign=UserModel::getUsernameById($nUserId,'user_sign');?>
									<?php if($sUsersign):?><?php echo(strip_tags($sUsersign));?><?php else:?><?php print Dyhb::L("该用户很懒，暂时没有签名",'Template/Friend',null);?><?php endif;?><br/>
									<span id="commenthide_<?php echo($nUserId);?>"><?php if($sType=='fan'):?><?php echo($oFriend['friend_fancomment']);?><?php else:?><?php echo($oFriend['friend_comment']);?><?php endif;?></span> <span id="commentedit_<?php echo($nUserId);?>">[<a href="javascript:;" onclick="editComment(<?php echo($nUserId);?>)">+<?php print Dyhb::L("添加备注",'Template/Friend',null);?></a>]</span>
									<span id="commentbox_<?php echo($nUserId);?>" style="display:none"><input name="comment_<?php echo($nUserId);?>" value="" id="comment_<?php echo($nUserId);?>" onBlur="updateComment(<?php echo($nUserId);?>,'<?php if($sType=='fan'):?>1<?php else:?>0<?php endif;?>')" class="input-small"></span>
								</p>
								<p><a href="<?php echo(Dyhb::U('home://pm/pmnew?uid='.$nUserId));?>" class="btn btn-success"><i class="icon-envelope icon-white"></i>&nbsp;<?php print Dyhb::L("短消息",'Template/Friend',null);?></a>&nbsp;
								<a href="javascript:void(0);" onclick="deleteFriend('<?php echo($nUserId);?>','<?php if($sType=='fan'):?>1<?php else:?>0<?php endif;?>');" class="btn"><i class="icon-remove-sign"></i>&nbsp;<?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?></a></p>
							</div>
						</div>
					</li>
					
<?php $i++;?>
<?php endforeach;endif;?>
				</ul>
				<?php else:?>
				<?php if($sType=='fan'):?><?php print Dyhb::L("暂时没有发现任何粉丝",'Template/Friend',null);?><?php else:?><?php print Dyhb::L("暂时没有发现任何好友",'Template/Friend',null);?><?php endif;?>
				<?php endif;?>
		
				<?php echo($sPageNavbar);?>
			</div>
		</div><!--/row-->
		
<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>