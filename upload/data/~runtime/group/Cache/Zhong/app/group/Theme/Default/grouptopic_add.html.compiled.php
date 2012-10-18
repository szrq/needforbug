<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-10-17 08:42:30  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

<?php echo(Core_Extend::editorInclude());?>

<script type="text/javascript">
$(function(){
	editor=loadEditor('grouptopic_content');
});

function grouptopicSubmit(){
	$("#submit_button").attr("disabled", "disabled");
	$("#submit_button").val( 'add...' );
	$("#grouptopic_content").val(editor.html());

	Dyhb.AjaxSubmit('grouptopic_form','<?php echo(Dyhb::U('group://grouptopic/add_topic'));?>','',function(data,status){
		$("#submit_button").attr("disabled", false);
		$("#submit_button").val( '发布帖子' );
		if(status==1){
			window.location.href=data.url;
		}
	});
}

function showMedia(){
	$('#homefresh-media-box').toggle('fast');
}

function insertGrouptopicattachment(nAttachmentid){
	insertAttachment(editor,nAttachmentid);
}

function reloadCategory(){
	var nGid=$('#group_id').val();
	var sUrl="<?php echo(Dyhb::U('group://group/getcategory'));?>";
	$.post(sUrl,{gid:nGid},function(data, textStatus){
		$("#grouptopiccategory_id").html(data);
	});
}
</script>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><a href="<?php echo(Dyhb::U('group://public/index'));?>">群组</a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li>发布帖子</li>
		</ul>

		<div class="row">
			<div class="span12">
				<ul id="myTab" class="nav nav-tabs">
					<li class="active"><a href="javascript:void(0);">发布帖子</a></li>
				</ul>
			</div>
			<form method='post' name="grouptopic_form" id="grouptopic_form" enctype="multipart/form-data">
				<div class="span10">
					<?php if(empty($nGroupid)):?>
					<label>我的小组</label>
					<select name="group_id" id="group_id" onchange="reloadCategory();">
						
						<?php $i=1;?>
<?php if(is_array($arrGroups)):foreach($arrGroups as $key=>$oGroup):?>

						<option value="<?php echo($oGroup['group_id']);?>"><?php echo($oGroup['group_nikename']);?></option>
						
<?php $i++;?>
<?php endforeach;endif;?>
					</select>
					<?php endif;?>
					<label>帖子标题</label>
					<input type="text" name="grouptopic_title" id="grouptopic_title" class="span8" placeholder="请输入标题">
					<span></span>
					<label>帖子内容&nbsp;(<a href="javascript:void(0);" onclick="showMedia();">媒体</a>)</label>
					<div id="homefresh-media-box" class="homefresh-media-box none">
						<a href="javascript:void(0);" class="face-icon icon_add_face" >表情</a>
						<a href="javascript:void(0);" onclick="globalAddattachment('insertGrouptopicattachment');" class="icon_add_img">媒体</a>
						<a href="javascript:void(0);" onclick="addHomefreshvideo();" class="icon_add_video" >视频</a>
						<a href="javascript:void(0);" onclick="addHomefreshmusic();" class="icon_add_music">音乐</a>
					</div>
					<textarea name="grouptopic_content" id="grouptopic_content" style="height:350px;width:100%;padding:0;margin:0;"></textarea>
					<div class="grouptopic_tabs">
						<ul id="grouptopic_tabcontent" class="nav nav-tabs">
							<li class="active"><a href="#grouptopiccategory" data-toggle="tab">帖子分类</a></li>
							<!--<li><a href="#readperm" data-toggle="tab">阅读权限</a></li>-->
							<li><a href="#price" data-toggle="tab">售价</a></li>
							<!--<li><a href="#tags" data-toggle="tab">帖子标签</a></li></li>-->
						</ul>
						<div id="grouptopic_tabcontent" class="tab-content">
							<div class="tab-pane fade in active alert alert-success" id="grouptopiccategory">
								<table cellspacing="0" cellpadding="0">
									<tr>
										<td class="grouptopictabs_title">帖子分类&nbsp;</td>
										<td><select name="grouptopiccategory_id" id="grouptopiccategory_id">
												<option value="0">默认未分类</option>
												<?php $i=1;?>
<?php if(is_array($arrGrouptopiccategorys)):foreach($arrGrouptopiccategorys as $key=>$oGrouptopiccategory):?>

												<option value="<?php echo($oGrouptopiccategory['grouptopiccategory_id']);?>"><?php echo($oGrouptopiccategory['grouptopiccategory_name']);?></option>
												
<?php $i++;?>
<?php endforeach;endif;?>
											</select>&nbsp;
											<span class="grouptopictabs_description">不选择为默认未分类</span>
										</td>
									</tr>
								</table>
							</div>
							<!--<div class="tab-pane fade alert alert-success" id="readperm">
								<table cellspacing="0" cellpadding="0">
									<tr>
										<td class="grouptopictabs_title">阅读权限&nbsp;</td>
										<td><select name="grouptopic_readperm" id="grouptopic_readperm" style="width:90px">
												<option value="">不限</option>
												<option value="1" title="阅读权限: 1">游客</option>
												<option value="10" title="阅读权限: 10">新手上路</option>
												<option value="20" title="阅读权限: 20">注册会员</option>
											</select>&nbsp;
											<span class="grouptopictabs_description">阅读权限按由高到低排列，高于或等于选中组的用户才可以阅读</span>
										</td>
									</tr>
								</table>
							</div>-->
							<div class="tab-pane fade alert alert-success" id="price">
								<table cellspacing="0" cellpadding="0">
									<tr>
										<td class="grouptopictabs_title">售价&nbsp;</td>
										<td><input type="text" id="grouptopic_price" name="grouptopic_price" value=""/>&nbsp;金钱
											<span class="grouptopictabs_description">(最高 30 )</span>
										</td>
									</tr>
								</table>
							</div>
							<!--<div class="tab-pane fade alert alert-success" id="tags">
								<table cellspacing="0" cellpadding="0">
									<tr>
										<td class="grouptopictabs_title">标签&nbsp;</td>
										<td><input type="text" size="60" id="tags" name="tags" value=""/>&nbsp;
											<a href="javascript:void(0);" id="clickbutton[]">自动获取</a>
											<span class="pipe">|</span>
											<a href="javascript:void(0);" id="choosetag">选择标签</a>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<p class="grouptopictabs_description">用逗号或空格隔开多个标签，最多可填写 5 个</p>
											<p class="mtn">最近使用标签:&nbsp;<a href="javascript:void(0);" class="grouptopictabs_description" onclick="$('tags').value == '' ? $('tags').value += '福鼎市' : $('tags').value += ',福鼎市';extraCheck(4);doane();">福鼎市</a></p>
										</td>
									</tr>
								</table>
							</div></li>-->
						</div>
					</div>
				</div>
				<div class="span2">
					<div id="grouptopic_more" class="grouptopic_more">
						<h3 class="grouptopicmore_title">附加选项</h3>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_parseurloff" id="grouptopic_parseurloff" value="1">禁用链接识别
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_smileoff" id="grouptopic_smileoff" value="1">禁用表情
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_usesig" id="grouptopic_usesig" value="1" checked="checked">使用个人签名
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_isanonymous" id="grouptopic_isanonymous" value="1">使用匿名发帖
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_hiddenreplies" id="grouptopic_hiddenreplies" value="1">回帖仅作者可见
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_ordertype" id="grouptopic_ordertype" value="1">回帖倒序排列
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_allownoticeauthor" id="grouptopic_allownoticeauthor" value="1" checked="checked">接收回复通知
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_iscomment" id="grouptopic_iscomment" value="1" checked="checked">允许回复
						</label>
						<hr/>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_sticktopic" id="grouptopic_sticktopic" value="1">主题置顶
						</label>
						<label class="checkbox">
							<input type="checkbox" name="grouptopic_addtodigest" id="grouptopic_addtodigest" value="1">精华帖子
						</label>
					</div>
				</div>
				<div class="span12" style="margin-top:-20px;">
					<div class="form-actions">
						<?php if(!empty($nGroupid)):?>
						<input type="hidden" name="group_id" id="group_id" value="<?php echo($nGroupid);?>">
						<?php endif;?>
						<input type="hidden" name="ajax" value="1">
						<button type="button" name="submit_button" id="submit_button" class="btn btn-success" onClick="grouptopicSubmit();">发表帖子</button>&nbsp;
						<a href="<?php echo(Dyhb::U('group://public/index'));?>" class="btn"><?php print Dyhb::L("取消",'__COMMON_LANG__@Template/Common',null);?></a>
					</div>
				</div>
			</form>
		</div>

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>