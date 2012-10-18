<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 08:39:19  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">群组</a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://name@?id='.$oGrouptopic->group->group_name));?>"><?php echo($oGrouptopic->group->group_nikename);?></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li>查看帖子</li>
		</ul>

<script src="<?php echo(__PUBLIC__);?>/js/jquery/autoresize/jquery.autoresize.js"></script>
<script src="<?php echo(__PUBLIC__);?>/js/avatartips/CJL.0.1.min.js"></script>
<script src="<?php echo(__PUBLIC__);?>/js/avatartips/RelativePosition.js"></script>
<script src="<?php echo(__PUBLIC__);?>/js/avatartips/FixedTips.js"></script>

<?php echo(Core_Extend::editorInclude());?>
<?php echo(Core_Extend::emotion());?>

<script type="text/javascript">
$(function(){
	var oFixedTips=new FixedTips("grouptopicview_tip");
	$$A.forEach($$("grouptopicview_list").getElementsByTagName("avatar"),function(o){
		oFixedTips.add(o.getElementsByTagName("img")[0], {
			relative: { customLeft: -12, customTop: -13},
			onShow: function(){ oFixedTips.tip.innerHTML = o.innerHTML; }
		});
	})
	
	$('.grouptopiccomment_message').autoResize({
		onResize:function(){
			$(this).css({opacity:0.8});
		},
		animateCallback:function(){
			$(this).css({opacity:1});
		},
		animateDuration:300,
		extraSpace:0,
		min:'80px'
	});

	$("#grouptopiccomment_quickmessage").focus(function(){
		$("#grouptopiccomment_reply").css("display","block");
	});

	editor=loadEditorThin('grouptopiccomment_message');

	$('a.face-icon').showEmotion({input:editor});
	$('.grouptopiccontent_box').listEmotion();
});

function closeQuickreplay(){
	$("#grouptopiccomment_reply").css("display","none");
}

function addGrouptopiccommentquick(){
	var sCommentMessage=$("#grouptopiccomment_quickmessage").val();
	if(!sCommentMessage){
		needforbugAlert('回复内容不能为空','',3);
		return false;
	}

	var sParameter="ajax=1&grouptopiccomment_message="+encodeURIComponent(sCommentMessage)+"&tid="+<?php echo($oGrouptopic->grouptopic_id);?>;

	Dyhb.AjaxSend('<?php echo(Dyhb::U('group://grouptopic/add_reply'));?>',sParameter,'',function(data,status){
		if(status==1){
			window.location.href=data.url;
		}
	});
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

function addGrouptopiccomment(){
	sGrouptopiccommentmessage=$.trim(editor.html());
	$('#grouptopiccomment_message').val(sGrouptopiccommentmessage);

	if(!sGrouptopiccommentmessage){
		needforbugAlert('回复内容不能为空','',3);
		return false;
	}
	Dyhb.AjaxSubmit("grouptopiccomment_form",'<?php echo(Dyhb::U('group://grouptopic/add_reply'));?>','',function(data,status){
		if(status==1){
			window.location.href=data.url;
		}
	});
}

function showMedia(){
	$('#grouptopiccomment-media-box').toggle('fast');
}

function insertGrouptopicattachment(nAttachmentid){
	insertAttachment(editor,nAttachmentid);
}

function insertGrouptopicvideo(sContent){
	insertVideo(editor,sContent);
}

function insertGrouptopicmusic(sContent){
	insertMusic(editor,sContent);
}
</script>

		<div class="row">
			<div class="span12">
				<div class="floor floor_headerpost">
					<table width="100%" class="floor_table">
						<tr>
							<td width="200px">
								<div><a rel="nofollow" href="<?php echo(Dyhb::U('group://grouptopic/add?gid='.$oGrouptopic->group_id));?>" class="btn btn-success">发帖</a>&nbsp;
									<a rel="nofollow" href="<?php echo(Dyhb::U('group://grouptopic/reply?id='.$oGrouptopic->grouptopic_id));?>" class="btn btn-success">回复</a>
								</div>
							</td>
							<td style="text-align:right;"><?php echo($sPageNavbar);?></td>
						</tr>
					</table>
				</div>
				
				<div id="grouptopicview_tip" class="grouptopicview_tip"></div>
				
				<div id="grouptopicview_list" class="grouptopicview_list">
					<?php if($nPage<2):?>
					<div class="floor clear" id="grouptopicview_0">
						<table width="100%" class="floor_table floor_grouptopictable">
							<tr>
								<td rowspan="2" class="floor_left floor_grouptopictd1" width="350px">
									<div class="floor_info">
										<div class="floor_userinfoname">
											<div class="floor_userinfonameinner">
												<a target="_blank" href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic['user_id']));?>"><?php echo($oGrouptopic->grouptopic_username);?></a>
											</div>
										</div>
										<div>
											<avatar>
												<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic['user_id']));?>" target="_blank">
													<img src="<?php echo(Core_Extend::avatar($oGrouptopic['user_id'],'middle'));?>" target="_blank" width="120px" alt="<?php echo($oGrouptopic->grouptopic_username);?>" class="group_avatar">
												</a>
												<div class="grouptopicview_info"> 
													<div>
														<strong><a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic['user_id']));?>" target="_blank"><?php echo($oGrouptopic->grouptopic_username);?></a></strong>
														<em><img src="<?php echo(Profile_Extend::getUserprofilegender($oGrouptopic->userprofile->userprofile_gender));?>"/></em>
													</div>
													<div class="grouptopicview_tablebox">
														<table style="text-align:left;" cellspacing="0" cellpadding="0" width="100%">
															<tr>
																<td>注册时间</td>
																<td><?php echo(date('Y-m-d',$oGrouptopic->user->create_dateline));?></td>
																<td>最后登录</td>
																<td><?php if($oGrouptopic->user->user_lastlogintime):?>
																	<?php echo(date('Y-m-d',$oGrouptopic->user->user_lastlogintime));?>
																	<?php else:?>
																	注册登陆
																	<?php endif;?>
																</td>
															</tr>
															<tr>
																<td>主题</td>
																<td><a href="<?php echo(Dyhb::U('group://space/topic?uid='.$oGrouptopic['user_id']));?>" target="_blank"><?php echo($TheController->totalTopic($oGrouptopic->user_id));?></a></td>
																<td>积分</td>
																<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id.'&type=friend&fan=1'));?>" target="_blank"><?php echo($oGrouptopic->usercount->usercount_extendcredit1);?></a></td>
															</tr>
															<tr>
																<td>精华</td>
																<td><a href="<?php echo(Dyhb::U('group://space/topic?uid='.$oGrouptopic['user_id'].'&addtodigest=1'));?>" target="_blank"><?php echo($TheController->totalTopic($oGrouptopic->user_id,true));?></a></td>
																<td>帖子</td>
																<td><a href="<?php echo(Dyhb::U('group://space/topiccomment?uid='.$oGrouptopic['user_id']));?>" target="_blank"><?php echo($TheController->totalTopic($oGrouptopic->user_id));?></a></td>
															</tr>
														</table>
													</div>
													<div>
														<?php if($oGrouptopic->userprofile->userprofile_qq):?>
														<a href="http://wpa.qq.com/msgrd?V=1&Uin=<?php echo($oGrouptopic->userprofile->userprofile_qq);?>&Site=<?php echo(urlencode($GLOBALS['_option_']['site_name']));?>&Menu=yes" target="_blank" title="QQ"><img src="<?php echo(__PUBLIC__);?>/images/common/qq.gif" alt="QQ"></a>
														<?php endif;?>
														<?php if($oGrouptopic->userprofile->userprofile_site):?>
														<a href="<?php echo($oGrouptopic->userprofile->userprofile_site);?>" target="_blank" title="查看个人网站"><img src="<?php echo(__PUBLIC__);?>/images/common/grouplink.gif" alt="查看个人网站"></a>
														<?php endif;?>
														<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic['user_id']));?>" target="_blank" title="查看详细资料"><img src="<?php echo(__PUBLIC__);?>/images/common/userinfo.gif" alt="查看详细资料"></a>
													</div>
												</div>
											</avatar>
										</div>
										<div class="floor_groupuserfollow">
											<table cellspacing="0" cellpadding="0" width="100%">
												<tbody>
													<tr>
														<th><p>
																<a href="<?php echo(Dyhb::U('group://space/topic?uid='.$oGrouptopic['user_id']));?>"><?php echo($TheController->totalTopic($oGrouptopic->user_id));?></a>
															</p>主题
														</th>
														<th><p>
																<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id.'&type=friend&fan=1'));?>"><?php echo($oGrouptopic->usercount->usercount_extendcredit1);?></a>
															</p>听众
														</th>
														<td><p>
																<a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id.'&type=rating'));?>"><span title="<?php echo($oGrouptopic->usercount->usercount_extendcredit1);?>"><?php echo($oGrouptopic->usercount->usercount_extendcredit1);?></span></a>
															</p>积分
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div>
											<?php $arrRatinginfo=UserModel::getUserrating($oGrouptopic->usercount->usercount_extendcredit1,false);?>
											<p class="floor_userinforating">
												<em><a target="_blank" href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id.'&type=rating'));?>" title="当前积分&nbsp;<?php echo($oGrouptopic->usercount->usercount_extendcredit1);?>,等级名字&nbsp;<?php echo($arrRatinginfo['rating_name']);?>,距离下一个等级&nbsp;<?php echo($arrRatinginfo['next_rating']['rating_name']);?>&nbsp;还差&nbsp;<?php echo($arrRatinginfo['next_needscore']);?>&nbsp;积分"><?php echo($arrRatinginfo['rating_name']);?></a></em>
											</p>
											<?php if($oGrouptopic->user->user_nikename):?>
											<p class="floor_userinfonikename"><?php echo($oGrouptopic->user->user_nikename);?></p>
											<?php endif;?>
										</div>
										<div class="floor_userinfocount">
											<table style="text-align:left;" cellspacing="0" cellpadding="0" width="100%">
												<tr>
													<td>UID</td>
													<td><?php echo($oGrouptopic->user_id);?></td>
												</tr>
												<tr>
													<td>帖子</td>
													<td><a href="<?php echo(Dyhb::U('group://space/topiccomment?uid='.$oGrouptopic['user_id']));?>" target="_blank"><?php echo($TheController->totalComment($oGrouptopic->user_id));?></a></td>
												</tr>
												<tr>
													<td>金币</td>
													<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id.'&type=rating'));?>"><?php echo($oGrouptopic->usercount->usercount_extendcredit2);?></a></td>
												</tr>
												<tr>
													<td>贡献</td>
													<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oGrouptopic->user_id.'&type=rating'));?>"><?php echo($oGrouptopic->usercount->usercount_extendcredit3);?></a></td>
												</tr>
											</table>
										</div>
										<?php if($oGrouptopic->user_id!=$GLOBALS['___login___']['user_id']):?>
										<div class="floor_userinfooperate">
											<?php $nAlreadyFriendId=Core_Extend::isAlreadyFriend($oGrouptopic->user_id);?>
											<?php if($nAlreadyFriendId==1 || $nAlreadyFriendId==4):?>
											<a rel="nofollow" href="javascript:void(0);" onclick="deleteFriend(<?php echo($oGrouptopic->user_id);?>);"><i class="icon-remove"></i>取消关注</a>
											<?php else:?>
											<a rel="nofollow" href="javascript:void(0);" onclick="addFriend(<?php echo($oGrouptopic->user_id);?>);"><i class="icon-plus"></i>加关注</a>
											<?php endif;?>&nbsp;
											<a rel="nofollow" href="javascript:void(0);" onclick="addMessage('<?php echo($oGrouptopic->user_id);?>');"><i class="icon-envelope"></i>写私信</a>
										</div>
										<?php endif;?>
									</div>
								</td>
								<td class="floor_right"> 
									<div class="floor_title">
										<div class="post_num">
											<ul class="clear">
												<li>阅读&nbsp;<em><?php echo($oGrouptopic->grouptopic_views);?></em></li>
												<li>回复&nbsp;<em><?php echo($oGrouptopic->grouptopic_comments);?></em></li>
											</ul>
										</div>
										<h1><?php echo($oGrouptopic->grouptopic_title);?></h1>
									</div>
									<div class="floor_top_tips">
										<span class="floor_copy" title="复制此楼地址" onclick="copy('<?php echo($oGrouptopic->grouptopic_title);?>'+'\n'+'<?php echo($GLOBALS['_option_']['site_url']);?>/index.php?app=group&c=grouptopic&a=view&id=<?php echo($oGrouptopic->grouptopic_id);?>','楼层复制成功');">楼主<sup>#</sup></span>
										<span>发布于<?php echo(Core_Extend::timeFormat($oGrouptopic->create_dateline));?></span>
									</div>
									<div id="grouptopicview_main">
										<div class="grouptopiccontent_box">
											<?php echo(Core_Extend::ubb($oGrouptopic->grouptopic_content));?>
										</div>
										<?php if($oGrouptopic->update_dateline):?>
										<div class="space"></div>
										<div class="edit_log">
											<blockquote>
												<em>[<?php echo($oGrouptopic->grouptopic_username);?>于<?php echo(Core_Extend::timeFormat($oGrouptopic->update_dateline));?>编辑了帖子]</em>
											</blockquote>
										</div>
										<?php endif;?>
									</div>
								</td>
							</tr>
							<tr>
								<td class="floor_bottom floor_grouptopictd2" valign="bottom">
									<div class="floor_quickreply">
										<h4 style="font-size:13px;">快速回复</h4>
										<textarea class="grouptopiccomment_quickmessage" name="grouptopiccomment_content" id="grouptopiccomment_quickmessage" placeholder="我也说两句" rows="2" cols="10"></textarea>
									</div>
									<div class="grouptopiccomment_reply none" id="grouptopiccomment_reply">
										<button onclick="addGrouptopiccommentquick();" class="btn btn-success grouptopiccomment_btn">回复</button>
										<a href="javascript:void(0);" onclick="closeQuickreplay();"><i class="icon-remove"></i>&nbsp;关闭</a>&nbsp;
										<a href="<?php echo(Dyhb::U('group://grouptopic/reply?id='.$oGrouptopic->grouptopic_id));?>" >进入高级模式&gt;&gt;</a>
									</div>
									<div class="space"></div>
									<div class="signature">
										<?php echo(UserModel::getUsernameById($oGrouptopic['user_id'],'user_sign'));?>
									</div>
								</td>
							</tr>
							<tr>
								<td class="floor_grouptopicbottomtd1"></td>
								<td class="floor_grouptopicbottomtd2"></td>
							</tr>
						</table>
					</div>
					<?php endif;?>

					<?php $i=1;?>
<?php if(is_array($arrComment)):foreach($arrComment as $key=>$oComment):?>

					<a name="grouptopiccomment-<?php echo($oComment->grouptopiccomment_id);?>"></a>
					<div class="floor clear" id="grouptopicview_<?php echo($oComment->grouptopiccomment_id);?>">
						<table width="100%" class="floor_table floor_grouptopiccommenttable">
							<tr>
								<td rowspan="2" class="floor_left floor_grouptopiccommenttd1" width="350px">
									<div class="floor_info">
										<div class="floor_userinfoname">
											<div class="floor_userinfonameinner">
												<a target="_blank" href="<?php echo(Dyhb::U('home://space@?id='.$oComment['user_id']));?>"><?php echo($oComment->user->user_name);?></a>
											</div>
										</div>
										<div>
											<avatar>
												<a href="<?php echo(Dyhb::U('home://space@?id='.$oComment['user_id']));?>" target="_blank">
													<img src="<?php echo(Core_Extend::avatar($oComment['user_id'],'middle'));?>" width="120px" alt="<?php echo($oComment->user->user_name);?>" class="group_avatar">
												</a>
												<div class="grouptopicview_info"> 
													<div>
														<strong><a href="<?php echo(Dyhb::U('home://space@?id='.$oComment['user_id']));?>" target="_blank"><?php echo($oComment->user->user_name);?></a></strong>
														<em><img src="<?php echo(Profile_Extend::getUserprofilegender($oComment->userprofile->userprofile_gender));?>"/></em>
													</div>
													<div class="grouptopicview_tablebox">
														<table style="text-align:left;" cellspacing="0" cellpadding="0" width="100%">
															<tr>
																<td>注册时间</td>
																<td><?php echo(date('Y-m-d',$oComment->user->create_dateline));?></td>
																<td>最后登录</td>
																<td><?php if($oComment->user->user_lastlogintime):?>
																	<?php echo(date('Y-m-d',$oComment->user->user_lastlogintime));?>
																	<?php else:?>
																	注册登陆
																	<?php endif;?>
																</td>
															</tr>
															<tr>
																<td>主题</td>
																<td><a href="<?php echo(Dyhb::U('group://space/topic?uid='.$oComment['user_id']));?>" target="_blank"><?php echo($TheController->totalTopic($oComment->user_id));?></a></td>
																<td>积分</td>
																<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oComment->user_id.'&type=friend&fan=1'));?>" target="_blank"><?php echo($oComment->usercount->usercount_extendcredit1);?></a></td>
															</tr>
															<tr>
																<td>精华</td>
																<td><a href="<?php echo(Dyhb::U('group://space/topic?uid='.$oComment['user_id'].'&addtodigest=1'));?>" target="_blank"><?php echo($TheController->totalTopic($oComment->user_id,true));?></a></td>
																<td>帖子</td>
																<td><a href="<?php echo(Dyhb::U('group://space/topiccomment?uid='.$oComment['user_id']));?>" target="_blank"><?php echo($TheController->totalTopic($oComment->user_id));?></a></td>
															</tr>
														</table>
													</div>
													<div class="imicn">
														<?php if($oComment->userprofile->userprofile_qq):?>
														<a href="http://wpa.qq.com/msgrd?V=1&Uin=<?php echo($oComment->userprofile->userprofile_qq);?>&Site=<?php echo(urlencode($GLOBALS['_option_']['site_name']));?>&Menu=yes" target="_blank" title="QQ"><img src="<?php echo(__PUBLIC__);?>/images/common/qq.gif" alt="QQ"></a>
														<?php endif;?>
														<?php if($oComment->userprofile->userprofile_site):?>
														<a href="<?php echo($oComment->userprofile->userprofile_site);?>" target="_blank" title="查看个人网站"><img src="<?php echo(__PUBLIC__);?>/images/common/grouplink.gif" alt="查看个人网站"></a>
														<?php endif;?>
														<a href="<?php echo(Dyhb::U('home://space@?id='.$oComment['user_id']));?>" target="_blank" title="查看详细资料"><img src="<?php echo(__PUBLIC__);?>/images/common/userinfo.gif" alt="查看详细资料"></a>
													</div>
												</div>
											</avatar>
										</div>
										<div class="floor_groupuserfollow">
											<table cellspacing="0" cellpadding="0" width="100%">
												<tbody>
													<tr>
														<th>
															<p>
																<a href="<?php echo(Dyhb::U('group://space/topic?uid='.$oComment['user_id']));?>"><?php echo($TheController->totalTopic($oComment->user_id));?></a>
															</p>主题
														</th>
														<th>
															<p>
																<a href="<?php echo(Dyhb::U('home://space@?id='.$oComment->user_id.'&type=friend&fan=1'));?>"><?php echo($oComment->usercount->usercount_extendcredit1);?></a>
															</p>听众
														</th>
														<td>
															<p>
																<a href="<?php echo(Dyhb::U('home://space@?id='.$oComment->user_id.'&type=rating'));?>"><span title="<?php echo($oComment->usercount->usercount_extendcredit1);?>"><?php echo($oComment->usercount->usercount_extendcredit1);?></span></a>
															</p>积分
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div>
											<?php $arrRatinginfo=UserModel::getUserrating($oComment->usercount->usercount_extendcredit1,false);?>
											<p class="floor_userinforating">
												<em><a target="_blank" href="<?php echo(Dyhb::U('home://space@?id='.$oComment->user_id.'&type=rating'));?>" title="当前积分&nbsp;<?php echo($oGrouptopic->usercount->usercount_extendcredit1);?>,等级名字&nbsp;<?php echo($arrRatinginfo['rating_name']);?>,距离下一个等级&nbsp;<?php echo($arrRatinginfo['next_rating']['rating_name']);?>&nbsp;还差&nbsp;<?php echo($arrRatinginfo['next_needscore']);?>&nbsp;积分"><?php echo($arrRatinginfo['rating_name']);?></a>
												</em>
											</p>
											<?php if($oComment->user->user_nikename):?>
											<p class="floor_userinfonikename"><?php echo($oComment->user->user_nikename);?></p>
											<?php endif;?>
										</div>
										<div class="floor_userinfocount">
											<table style="text-align:left;" cellspacing="0" cellpadding="0" width="100%">
												<tr>
													<td>UID</td>
													<td><?php echo($oComment->user_id);?></td>
												</tr>
												<tr>
													<td>帖子</td>
													<td><a href="<?php echo(Dyhb::U('group://space/topiccomment?uid='.$oComment['user_id']));?>" target="_blank"><?php echo($TheController->totalComment($oComment->user_id));?></a></td>
												</tr>
												<tr>
													<td>金币</td>
													<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oComment->user_id.'&type=rating'));?>"><?php echo($oComment->usercount->usercount_extendcredit2);?></a></td>
												</tr>
												<tr>
													<td>贡献</td>
													<td><a href="<?php echo(Dyhb::U('home://space@?id='.$oComment->user_id.'&type=rating'));?>"><?php echo($oComment->usercount->usercount_extendcredit3);?></a></td>
												</tr>
											</table>
										</div>
										<?php if($oComment->user_id!=$GLOBALS['___login___']['user_id']):?>
										<div class="floor_userinfooperate">
											<?php $nAlreadyFriendId=Core_Extend::isAlreadyFriend($oComment->user_id);?>
											<?php if($nAlreadyFriendId==1 || $nAlreadyFriendId==4):?>
											<a rel="nofollow" href="javascript:void(0);" onclick="deleteFriend(<?php echo($oComment->user_id);?>);"><i class="icon-remove"></i>取消关注</a>
											<?php else:?>
											<a rel="nofollow" href="javascript:void(0);" onclick="addFriend(<?php echo($oComment->user_id);?>);"><i class="icon-plus"></i>加关注</a>
											<?php endif;?>&nbsp;
											<a rel="nofollow" href="javascript:void(0);" onclick="addMessage('<?php echo($oComment->user_id);?>');"><i class="icon-envelope"></i>写私信</a>
										</div>
										<?php endif;?>
									</div>
								</td>
								<td class="floor_right floor_grouptopiccommenttd2">
									<div class="floor_top_tips">
										<span class="floor_copy" title="复制此楼地址" onclick="copy('楼层'+'\n'+'<?php echo($GLOBALS['_option_']['site_url']);?>/index.php?app=group&c=grouptopic&a=view&id=<?php echo($oGrouptopic->grouptopic_id);?>&cid=<?php echo($oComment->grouptopiccomment_id);?>','楼层复制成功');"><?php echo($TheController->get_commentfloor($i,$nEverynum));?>楼<sup>#</sup></span>
										<span>回复于<?php echo(Core_Extend::timeFormat($oComment->create_dateline));?></span>
									</div>
									<div class="grouptopiccontent_box"><?php echo(Core_Extend::ubb($oComment->grouptopiccomment_content));?></div>
								</td>
							</tr>
							<tr>
								<td class="floor_bottom" valign="bottom">
									<div class="signature"><?php echo(UserModel::getUsernameById($oComment['user_id'],'user_sign'));?></div>
								</td>
							</tr>
							<tr>
								<td class="floor_grouptopiccommentbottomtd1"></td>
								<td class="floor_grouptopiccommentbottomtd2"></td>
							</tr>
							<?php if(count($arrComment)-1==$key):?>
							<tr>
								<td colspan="2" class="floor_grouptopiccommentbottom"></td>
							</tr>
							<?php endif;?>
						</table>
					</div>
					
<?php $i++;?>
<?php endforeach;endif;?>
					<div class="floor floor_footerpost">
						<table width="100%" class="floor_footerposttable">
							<tr>
								<td width="200px">
									<div>
										<a rel="nofollow" href="<?php echo(Dyhb::U('group://grouptopic/add?gid='.$oGrouptopic->group_id));?>" class="btn btn-success" >发帖</a>&nbsp;
										<a rel="nofollow" href="<?php echo(Dyhb::U('group://grouptopic/reply?id='.$oGrouptopic->grouptopic_id));?>" class="btn btn-success">回复</a>
									</div>
								</td>
								<td style="text-align:right;"><?php echo($sPageNavbar);?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="floor">
					<table width="100%" class="floor_table floor_footerpostcontenttable">
						<tr>
							<td class="floor_left floor_footerpostcontenttd1" width="350px">
								<div class="avatar">
									<img src="<?php echo(Core_Extend::avatar($GLOBALS['___login___']['user_id'],'middle'));?>" width="120px" class="group_avatar">
								</div>
							</td>
							<td class="floor_right">
								<form method="post" name="grouptopiccomment_form" id="grouptopiccomment_form" class="grouptopiccomment_form">
									<textarea class="input-xlarge" name="grouptopiccomment_message" id="grouptopiccomment_message" rows="8" style="width:100%;"></textarea>
									<div id="grouptopiccomment-media-box" class="common-media-box none">
										<a href="javascript:void(0);" class="face-icon icon_add_face" >表情</a>
										<a href="javascript:void(0);" onclick="globalAddattachment('insertGrouptopicattachment');" class="icon_add_img">媒体</a>
										<a href="javascript:void(0);" onclick="addVideo('insertGrouptopicvideo');" class="icon_add_video" >视频</a>
										<a href="javascript:void(0);" onclick="addMusic('insertGrouptopicmusic');" class="icon_add_music">音乐</a>
									</div>
									<div class="form-actions">
										<input type="hidden" name="ajax" value="1">
										<input type="hidden" name="tid" value="<?php echo($oGrouptopic->grouptopic_id);?>">
										<input id="submit_button" onclick="addGrouptopiccomment();" type="button" class="btn btn-middle btn-success" style="margin-left:0px;" value="发布">&nbsp;
										<a href="javascript:void(0);" onclick="showMedia();">媒体</a>
										<span class="pipe">|</span>
										<a href="<?php echo(Dyhb::U('group://grouptopic/reply?id='.$oGrouptopic->grouptopic_id));?>" >进入高级模式&gt;&gt;</a>
									</div>
								</form>
							</td>
						</tr>
					</table>
				</div>
				<div class="space"></div>
			</div>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>