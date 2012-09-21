<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:06:41  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

<script src="<?php echo(__PUBLIC__);?>/js/jquery/jquery.insertcontent.js"></script>

<?php echo(Core_Extend::editorInclude());?>

<script type="text/javascript">
$(function(){
	editor=loadEditorThin('homefresh_message');
});

function addHomefresh(){
	$('#homefresh_message').val(editor.html());
	if($('#homefresh_message').val()==''){
		needforbugAlert('<?php print Dyhb::L("新鲜事内容不能为空",'Template/Homefresh',null);?>','',3);
		return false;
	}
	
	$("#submit_button").attr("disabled","disabled");
	$("#submit_button").val('add...');
	Dyhb.AjaxSubmit('homefreshAdd','<?php echo(Dyhb::U('ucenter/add_homefresh'));?>','',function(data,status){ 
		$("#submit_button").attr("disabled",false);
		$("#submit_button").val("<?php print Dyhb::L("发布",'__COMMON_LANG__@Template/Common',null);?>");
		
		if(status==1){
			$("#homefresh_count").text(data.homefresh_num);
			
			$("#homefreshlist_box").prepend(
				'<tr>'+
					'<td style="width:48px;">'+
						'<div style="text-align:center;">'+
							'<a href="'+data.space+'"><img src="'+data.avatar+'" class="thumbnail" /></a>'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<h4><a href="'+data.space+'">'+data.user_name+'</a>&nbsp;<?php print Dyhb::L("于",'Template/Homefresh',null);?>&nbsp;'+data.create_dateline+'&nbsp;<?php print Dyhb::L("发布",'Template/Homefresh',null);?>'+
						'</h4>'+
						'<div class="homefresh-content">'+data.homefresh_message+'</div>'+
						'<div class="homefresh-count">'+
							'<a href="javascript:void(0);" onclick="goodnum(\''+data.homefresh_id+'\');"><?php print Dyhb::L("赞",'__COMMON_LANG__@Template/Homefresh',null);?>(<span id="goodnum_'+data.homefresh_id+'">'+data.homefresh_goodnum+'</span>)</a>'+
							'<span class="pipe">|</span>'+
							'<a href="'+data.url+'#comments"><?php print Dyhb::L("评论",'__COMMON_LANG__@Template/Homefresh',null);?>(<span id="homefreshcomment_'+data.homefresh_id+'">'+data.homefresh_commentnum+'</span>)</a>'+
							'<span class="pipe">|</span>'+
							'<a href="'+data.url+'" title="<?php print Dyhb::L("阅读全文",'__COMMON_LANG__@Template/Homefresh',null);?>"><i class="icon-eye-open"></i></a>'+
						'</div>'+
						'<div id="homefreshcommentlist_'+data.homefresh_id+'" class="homefreshcommentlist_box">'+
						'</div>'+
						'<div id="homefreshcommentdiv_'+data.homefresh_id+'" onclick="commentForm(\''+data.homefresh_id+'\');" class="homefreshcomment_div" style="color:gray;"><?php print Dyhb::L("我也来说一句",'__COMMON_LANG__@Template/Homefresh',null);?></div>'+
						'<div id="homefreshcommentform_'+data.homefresh_id+'" class="homefreshcomment_form"></div>'+
					'</td>'+
				'</tr>'
			);
		}
	});
}

function showHomefreshtitle(){
	$('#homefresh-title-box').toggle('fast');
}
</script>

<script type="text/javascript">
var nHomefreshviewcomment=0;
</script>
<script src="<?php echo(__PUBLIC__);?>/js/jquery/autoresize/jquery.autoresize.js"></script>
<script src="<?php echo(__APPPUB__);?>/Js/comment.js"></script>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><?php print Dyhb::L("个人中心",'Template/Homefresh',null);?></li>
		</ul>

		<div class="row">

			<?php $this->includeChildTemplate(TEMPLATE_PATH.'/ucenter_sidebar.html');?>

			<div class="span9">
				<em><?php print Dyhb::L("你正在想什么呢? 快来与朋友们分享吧!",'Template/Homefresh',null);?></em>
				<div class="homefresh-box" >
					<form class="well form-inline" method="post" id="homefreshAdd" name="homefreshAdd">
						<table width="100%" height="100%" border="0" valign="middle" cellpadding="5px" cellspacing="0">
							<tbody>
								<tr>
									<td colspan="2">
										<textarea class="input-xlarge" name="homefresh_message" id="homefresh_message" rows="5" style="width:100%;"></textarea>
										<div id="homefresh-title-box" class="none">
											<input type="text" class="span6" name="homefresh_title" id="homefresh_title" value="">&nbsp;<?php print Dyhb::L("新鲜事标题",'Template/Homefresh',null);?>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="synchronized-to-sign" value="1"/>&nbsp;<?php print Dyhb::L("同步到个人签名",'Template/Homefresh',null);?>
											<span class="pipe">|</span>
											<a href="javascript:void(0);" onclick="showHomefreshtitle();"><?php print Dyhb::L("标题",'Template/Homefresh',null);?></a>
										</label>
									</td>
									<td rowspan="2" style="width:70px;">
										<input type="hidden" name="ajax" value="1">
										<button id="submit_button" onclick="addHomefresh()" type="button" class="btn btn-large btn-success" style="height:63px;"><?php print Dyhb::L("发布",'__COMMON_LANG__@Template/Common',null);?></button>
									</td>
								</tr>
								<tr>
									<td><p class="help-block"><span class="max-limit-doing"><?php print Dyhb::L("新鲜事最大允许100000个字符，尽情表达吧",'Template/Homefresh',null);?></span></p>
									</td>
								</tr>
								<?php if($nDisplaySeccode==1):?>
								<tr>
									<td><hr />
										<label class="control-label" for="seccode"><?php print Dyhb::L("验证码",'__COMMON_LANG__@Template/Common',null);?></label>
										<p><input class="input-small" name="seccode" id="seccode" type="text" value=""></p>
										<p class="help-block"><span id="seccodeImage"><img style="cursor:pointer" onclick="updateSeccode()" src="<?php echo(Dyhb::U('home://public/seccode'));?>" /></span></p>
									</td>
								</tr>
								<?php endif;?>
							</tbody>
						</table>
					</form>
				</div>

				<div class="tabb-menu">
					<ul class="nav nav-tabs">
						<li <?php if(empty($sType)):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('ucenter/index'));?>"><?php print Dyhb::L("我关注的",'Template/Homefresh',null);?></a></li>
						<li <?php if($sType=='myself'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('ucenter/index?type=myself'));?>"><?php print Dyhb::L("我自己的",'Template/Homefresh',null);?></a></li>
						<li <?php if($sType=='friend'):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('ucenter/index?type=friend'));?>"><?php print Dyhb::L("好友的",'Template/Homefresh',null);?></a></li>
						<li <?php if($sType=='all'||isset($_GET['uid'])):?>class="active"<?php endif;?>><a href="<?php echo(Dyhb::U('ucenter/index?type=all'));?>"><?php print Dyhb::L("正在发生",'Template/Homefresh',null);?></a></li>
					</ul>
				</div>
				<div class="message-box">
					<?php if(is_array($arrHomefreshs)):?>
					<table class="table">
						<thead>
							<tr>
								<th colspan="2"><?php print Dyhb::L("大家正在说",'Template/Homefresh',null);?></th>
							</tr>
						</thead>
						<tbody id="homefreshlist_box">
							<?php $i=1;?>
<?php if(is_array($arrHomefreshs)):foreach($arrHomefreshs as $key=>$oHomefresh):?>

							<tr>
								<td style="width:48px;">
									<div style="text-align:center;">
										<a href="<?php echo(Dyhb::U('home://space@?id='.$oHomefresh['user_id']));?>"><img src="<?php echo(Core_Extend::avatar($oHomefresh['user_id'],'small'));?>" width="48px" height="48px" class="thumbnail" /></a>
									</div>
								</td>
								<td>
									<h4><a href="<?php echo(Dyhb::U('home://space@?id='.$oHomefresh['user_id']));?>"><?php echo($oHomefresh->user->user_name);?></a>&nbsp;<?php print Dyhb::L("于",'Template/Homefresh',null);?>&nbsp;<?php echo(Core_Extend::timeFormat($oHomefresh['create_dateline']));?>&nbsp;<?php print Dyhb::L("发布",'Template/Homefresh',null);?>
									</h4>
									<div class="homefresh-content">
										<?php echo(G::subString(strip_tags($oHomefresh['homefresh_message']),0,$GLOBALS['_cache_']['home_option']['homefresh_list_substring_num']));?>
									</div>
									<div class="homefresh-count">
										<a href="javascript:void(0);" onclick="goodnum('<?php echo($oHomefresh['homefresh_id']);?>');"><?php print Dyhb::L("赞",'__COMMON_LANG__@Template/Homefresh',null);?>(<span id="goodnum_<?php echo($oHomefresh['homefresh_id']);?>" <?php if(in_array($oHomefresh['homefresh_id'],$arrGoodCookie)):?>style="color:#4A4A4A;"<?php endif;?>><?php echo($oHomefresh['homefresh_goodnum']);?></span>)</a>
										<span class="pipe">|</span>
										<a href="<?php echo(Dyhb::U('home://fresh@?id='.$oHomefresh['homefresh_id']));?>#comments"><?php print Dyhb::L("评论",'__COMMON_LANG__@Template/Homefresh',null);?>(<span id="homefreshcomment_<?php echo($oHomefresh['homefresh_id']);?>"><?php echo($oHomefresh['homefresh_commentnum']);?></span>)</a>
										<span class="pipe">|</span>
										<a href="<?php echo(Dyhb::U('home://fresh@?id='.$oHomefresh['homefresh_id']));?>" title="<?php print Dyhb::L("阅读全文",'__COMMON_LANG__@Template/Homefresh',null);?>"><i class="icon-eye-open"></i></a>
									</div>
									<?php $arrHomefreshcomments=$TheController->get_newcomment($oHomefresh['homefresh_id'],$oHomefresh['user_id']);?>
									<?php if(is_array($arrHomefreshcomments)):?>
									<div class="homefreshcommentlist_headerarrow"></div>
									<?php endif;?>
									<div id="homefreshcommentlist_<?php echo($oHomefresh['homefresh_id']);?>" class="homefreshcommentlist_box">
										<?php $i=1;?>
<?php if(is_array($arrHomefreshcomments)):foreach($arrHomefreshcomments as $key=>$oHomefreshcomment):?>

										<div class="homefreshcomment_item" id="homefreshcommentitem_<?php echo($oHomefreshcomment['homefreshcomment_id']);?>">
											<div class="homefreshcomment_avatar"><img src="<?php echo(Core_Extend::avatar($oHomefreshcomment['user_id'],'small'));?>" width="48px" height="48px" class="thumbnail" />
											</div>
											<div class="homefreshcomment_content">
												<a href="<?php echo(Dyhb::U('home://space@?id='.$oHomefreshcomment['user_id']));?>"><?php echo(UserModel::getUsernameById($oHomefreshcomment->user_id));?></a>:
												<?php echo(G::subString($oHomefreshcomment->homefreshcomment_content,0,$GLOBALS['_cache_']['home_option']['homefreshcomment_substring_num']));?><br/><em class="homefreshcomment_date"><?php echo(Core_Extend::timeFormat($oHomefreshcomment->create_dateline));?></em>
												<span class="pipe">|</span>
												<a href="<?php echo(Dyhb::U('home://fresh@?id='.$oHomefreshcomment->homefresh_id.'&isolation_commentid='.$oHomefreshcomment->homefreshcomment_id));?>"><?php print Dyhb::L("查看",'__COMMON_LANG__@Template/Homefresh',null);?></a>&nbsp;
												<a href="javascript:void(0);" onclick="childcommentForm('<?php echo($oHomefresh['homefresh_id']);?>','<?php echo($oHomefreshcomment['homefreshcomment_id']);?>');"><?php print Dyhb::L("回复",'__COMMON_LANG__@Template/Homefresh',null);?></a>
												<?php $arrHomefreshchildcomments=$TheController->get_newchildcomment($oHomefresh['homefresh_id'],$oHomefreshcomment['homefreshcomment_id'],$oHomefresh['user_id']);?>
												<div id="homefreshchildcommentlist_<?php echo($oHomefreshcomment['homefreshcomment_id']);?>" class="homefreshchildcommentlist_box">
													<?php $i=1;?>
<?php if(is_array($arrHomefreshchildcomments)):foreach($arrHomefreshchildcomments as $key=>$oHomefreshchildcomment):?>

													<div class="homefreshcomment_item homefreshcomment_itemchild" id="homefreshcommentitem_<?php echo($oHomefreshchildcomment['homefreshcomment_id']);?>">
														<div class="homefreshcomment_avatar">
															<img src="<?php echo(Core_Extend::avatar($oHomefreshchildcomment['user_id'],'small'));?>" width="48px" height="48px" class="thumbnail" />
														</div>
														<div class="homefreshcomment_content">
															<a href="<?php echo(Dyhb::U('home://space@?id='.$oHomefreshchildcomment['user_id']));?>"><?php echo(UserModel::getUsernameById($oHomefreshchildcomment->user_id));?></a>:
															<?php echo(G::subString($oHomefreshchildcomment->homefreshcomment_content,0,$GLOBALS['_cache_']['home_option']['homefreshcomment_substring_num']));?><br/><em class="homefreshcomment_date"><?php echo(Core_Extend::timeFormat($oHomefreshchildcomment->create_dateline));?></em>
															<span class="pipe">|</span>
															<a href="<?php echo(Dyhb::U('home://fresh@?id='.$oHomefreshchildcomment->homefresh_id.'&isolation_commentid='.$oHomefreshchildcomment->homefreshcomment_id));?>"><?php print Dyhb::L("查看",'__COMMON_LANG__@Template/Homefresh',null);?></a>&nbsp;
															<a href="javascript:void(0);" onclick="childcommentForm('<?php echo($oHomefresh['homefresh_id']);?>','<?php echo($oHomefreshchildcomment['homefreshcomment_parentid']);?>',1,'<?php echo($oHomefreshchildcomment->user->user_name);?>','<?php echo($oHomefreshchildcomment['homefreshcomment_id']);?>');"><?php print Dyhb::L("回复",'__COMMON_LANG__@Template/Homefresh',null);?></a>
														</div>
													</div>
													<div class="clear"></div>
													
<?php $i++;?>
<?php endforeach;endif;?>
												</div>
												<div id="homefreshchildcommentform_<?php echo($oHomefreshcomment['homefreshcomment_id']);?>" class="homefreshcomment_form">
												</div>
											</div>
										</div>
										<div class="clear homefreshcommentitem_separator"></div>
										
<?php $i++;?>
<?php endforeach;endif;?>
									</div>
									<?php if(is_array($arrHomefreshcomments)):?>
									<div class="homefreshcomment_view">
										<a href="<?php echo(Dyhb::U('home://fresh@?id='.$oHomefresh['homefresh_id']));?>#comments"><?php print Dyhb::L("查看全部评论",'__COMMON_LANG__@Template/Homefresh',null);?>&raquo;</a>
									</div>
									<?php endif;?>
									<div id="homefreshcommentdiv_<?php echo($oHomefresh['homefresh_id']);?>" onclick="commentForm('<?php echo($oHomefresh['homefresh_id']);?>');" class="homefreshcomment_div" style="color:gray"><?php print Dyhb::L("我也来说一句",'__COMMON_LANG__@Template/Homefresh',null);?>
									</div>
									<div id="homefreshcommentform_<?php echo($oHomefresh['homefresh_id']);?>" class="homefreshcomment_form">
									</div>
								</td>
							</tr>
							
<?php $i++;?>
<?php endforeach;endif;?>
						</tbody>
					</table>
					<div id="homefreshcommentform_box" class="none">
						<?php if($GLOBALS['_cache_']['home_option']['audit_comment']==1):?>
						<div class="alert"><?php print Dyhb::L("系统开启了评论审核功能，你发表的评论只有新鲜事的作者审核通过了才能够显示",'Template/Homefresh',null);?></div>
						<?php endif;?>
						<textarea class="homefreshcommentform_area"></textarea><br />
						<input type="hidden" name="homefreshcomment_name" id="homefreshcomment_name" value="<?php echo($GLOBALS['___login___']['user_name']);?>">
						<input type="hidden" name="homefreshcomment_email" id="homefreshcomment_email" value="<?php echo($GLOBALS['___login___']['user_email']);?>">
						<input type="hidden" name="homefreshcomment_url" id="homefreshcomment_url" value="<?php echo(UserprofileModel::getUserprofileById($GLOBALS['___login___']['user_id']));?>">
						<input type="hidden" name="homefreshcomment_parentid" id="homefreshcomment_parentid" value="0">
						<div class="homefreshcommentform_btn">
							<div class="left">
								<label class="checkbox">
									<input type="checkbox" name="homefreshcomment_isreplymail" id="homefreshcomment_isreplymail" value="1">&nbsp;回复时邮件通知
								</label>
							</div>
							<div class="right">
								<input class="btn" type="button" value="<?php print Dyhb::L("取消",'Template/Homefresh',null);?>" onclick="homefreshcommentCancel();"/>&nbsp;
								<input class="btn btn-success" type="button" value="<?php print Dyhb::L("提交",'Template/Homefresh',null);?>" onclick="homefreshcommentSubmit();"/>
							</div>
						</div>
						<div class="clear"></div>
						<?php if($nDisplayCommentSeccode==1):?>
						<hr/>
						<label class="control-label" for="seccode"><?php print Dyhb::L("验证码",'__COMMON_LANG__@Template/Common',null);?></label>
						<p><input class="input-small" name="seccode" id="homefreshcomment_seccode" type="text" value="" onblur="setSeccode(this.value);"></p>
						<p class="help-block"><span id="seccodeImage"><img style="cursor:pointer" onclick="updateSeccode()" src="<?php echo(Dyhb::U('home://ucenter/seccode'));?>" /></span></p>
						<?php endif;?>
					</div>
					<?php else:?>
					<p><?php print Dyhb::L("暂时没有发现任何新鲜事",'Template/Homefresh',null);?></p>
					<?php endif;?>

					<?php echo($sPageNavbar);?>
				</div>
			</div>
		</div><!--/row-->

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>