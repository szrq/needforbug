<?php  /* DoYouHaoBaby Framework 模板缓存文件生成时间：2012-09-20 01:04:34  */ ?>
<?php $this->includeChildTemplate(Core_Extend::template('header'));?>

<script type="text/javascript">
function deleteMyPm(id){
	needforbugConfirm(D.L('确实要永久删除选择项吗？','__COMMON_LANG__@Admin/Common_Js'),function(){
		Dyhb.AjaxSend(D.U('home://pm/del_my_one_pm?id='+id),'','',completeDelete);
	});
}

function deletePm(id,userid){
	needforbugConfirm(D.L('确实要永久删除选择项吗？','__COMMON_LANG__@Admin/Common_Js'),function(){
		Dyhb.AjaxSend(D.U('home://pm/del_one_pm?id='+id+'&uid='+userid),'','',completeDelete);
	});
}

function completeDelete(data,status){
	if(status==1){
		window.location.reload();
	}
}

function deletePms(){
	needforbugConfirm(D.L('确实要永久删除选择项吗？','__COMMON_LANG__@Admin/Common_Js'),function(){
		document.getElementById('pmform').submit();
	});

	return false;
}

function readPms(){
	document.getElementById('pmform').submit();

	return false;
}

function deleteMyPms(){
	needforbugConfirm(D.L('确实要永久删除选择项吗？','__COMMON_LANG__@Admin/Common_Js'),function(){
		document.getElementById('pmform').submit();
	});

	return false;
}

function deleteSystemPms(){
	needforbugConfirm(D.L('确实要永久删除选择项吗？','__COMMON_LANG__@Admin/Common_Js'),function(){
		Dyhb.AjaxSubmit('pmform','<?php echo(Dyhb::U('home://pm/delete_systempm?ajax=1'));?>','',function(data,status){ 
			if(status==1){
				window.location.reload();
			}
		});
	});

	return false;
}
</script>

		<ul class="breadcrumb">
			<li><a href="<?php echo(__APP__);?>" title="<?php print Dyhb::L("主页",'__COMMON_LANG__@Template/Common',null);?>"><i class='icon-home'></i></a>&nbsp;<span class="divider">/</span>&nbsp;</li>
			<li><?php print Dyhb::L("短消息",'Template/Pm',null);?></li>
		</ul>

		<?php $this->includeChildTemplate(TEMPLATE_PATH.'/pm_menu.html');?>

		<div class="row">
			<div class="span12">
				<form method="post" name="pmform" id="pmform" action="<?php echo($sFormAction);?>" class="form-inline">
					<div id="checkList">
						<?php if(!in_array($sType,array('system','my','systemnew'))):?>
						<div style="margin: 5px 50px 0px 0px;">
							<span class="right">
								<label class="checkbox">
									<input type="checkbox" id="chkall" name="chkall" onclick="checkAll('checkList')"> <?php print Dyhb::L("全选",'__COMMON_LANG__@Template/Common',null);?>
								</label>
								<span class="pipe">|</span>
								<span class="label label-warning"><a href="javascript:void(0);" onclick="deletePms();return false;"><?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?></a></span>
							</span>
							
							<?php echo($sPageNavbar);?>
						</div>
						<?php endif;?>

						<?php if(in_array($sType,array('system','systemnew'))):?>
						<div style="margin: 5px 50px 0px 0px;">
							<span class="right">
								<label class="checkbox">
									<input type="checkbox" id="chkall" name="chkall" onclick="checkAll('checkList')"> <?php print Dyhb::L("全选",'__COMMON_LANG__@Template/Common',null);?>
								</label>
								<span class="pipe">|</span>
								<span class="label label-success"><a href="javascript:void(0);" onclick="readPms();return false;"><?php print Dyhb::L("标为已读",'Template/Pm',null);?></a></span>
								<span class="pipe">|</span>
								<span class="label label-warning"><a href="javascript:void(0);" onclick="deleteSystemPms();return false;"><?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?></a></span>
							</span>
						</div>
						<?php endif;?>

						<?php if($sType=='my'):?>
						<div style="margin: 5px 50px 0px 0px;">
							<span class="right">
								<label class="checkbox">
									<input type="checkbox" id="chkall" name="chkall" onclick="checkAll('checkList')"> <?php print Dyhb::L("全选",'__COMMON_LANG__@Template/Common',null);?>
								</label>
								<span class="pipe">|</span>
								<span class="label label-warning"><a href="javascript:void(0);" onclick="deleteMyPms();return false;"><?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?></a></span>
							</span>
						</div>
						<?php endif;?>
						
						<?php if(is_array($arrPmLists)):?>
						<table class="table table-striped">
							<thead>
								<tr>
									<th colspan="2"><i class="icon-envelope"></i>&nbsp;<?php print Dyhb::L("短消息",'Template/Pm',null);?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
<?php if(is_array($arrPmLists)):foreach($arrPmLists as $key=>$oPm):?>

								<?php $sEven=$key%2==0?'pmlist-even':'pmlist-odd';?>
								<?php if($oPm['pm_type']=='user'):?>
								<tr id="pm_<?php echo($oPm->pm_id);?>" class="<?php echo($sEven);?>">
									<td width="60px">
										<a href="<?php echo(Dyhb::U('home://space@?id='.$oPm->pm_msgfromid));?>" target="_blank">
											<img src="<?php echo(Core_Extend::avatar($oPm->pm_msgfromid,'small'));?>" width="48px" height="48px" class="thumbnail" />
										</a>
									</td>
									<td>
										<?php if($oPm['pm_subject']):?>
										<a href="<?php echo(Dyhb::U('home://pm/show?id='.$oPm->pm_id.($sType=='my'?'&muid':'&uid=').$oPm->pm_msgfromid));?>"><h5><?php echo($oPm['pm_subject']);?></h5></a>
										<?php endif;?>
										<p class="pm-cite"><a href="<?php echo(Dyhb::U('home://space@?id='.$oPm->pm_msgfromid));?>" target="_blank"><?php echo($oPm->pm_msgfrom);?></a>
										<?php if($sType=='my'):?>
										&nbsp;<i class="icon-arrow-right"></i>&nbsp;<a href="<?php echo(Dyhb::U('home://space@?id='.$oPm->pm_msgtoid));?>" target="_blank"><?php echo(UserModel::getUsernameById($oPm->pm_msgtoid));?></a>
										<?php endif;?>
										&nbsp;<em><?php echo(Core_Extend::timeFormat($oPm->create_dateline));?></em>
										<?php if($sType!='my' && $oPm->pm_isread==0):?>
										&nbsp;<img src="<?php echo(__PUBLIC__);?>/images/common/notice_newpm.gif" title="<?php print Dyhb::L("未读短消息",'Template/Pm',null);?>"/>
										<?php endif;?>
										<?php if($sType=='my' && $oPm['pm_status']==0):?>
										&nbsp;<i class="icon-remove-circle"></i>&nbsp;<?php print Dyhb::L("已删",'Template/Pm',null);?>
										<?php endif;?>
										</p>
										<p class="pm-summary">
											<?php echo(Pm_Extend::ubb(G::subString($oPm->pm_message,0,$GLOBALS['_cache_']['home_option']['pm_list_substring_num'])));?>
										</p>
										<p class="pm-more"><a href="<?php echo(Dyhb::U('home://pm/show?id='.$oPm->pm_id.($sType=='my'?'&muid=':'&uid=').$oPm->pm_msgfromid));?>"><?php print Dyhb::L("查看消息",'Template/Pm',null);?></a>
											<?php if($sType!='my'):?>
											<span class="pipe">|</span><a href="<?php echo(Dyhb::U('home://pm/pmnew?pmid='.$oPm->pm_id.'&uid='.$oPm->pm_msgfromid));?>"><?php print Dyhb::L("回复",'Template/Pm',null);?></a><?php endif;?>
										</p>
									</td>
									<td><?php if($sType!='my'):?><p><a href="javascript:void(0);" id="pmd_<?php echo($oPm->pm_id);?>" onclick="deletePm('<?php echo($oPm['pm_id']);?>','<?php echo($oPm['pm_msgfromid']);?>');return false;" title="<?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?>"><?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?></a></p><?php else:?><p><a href="javascript:void(0);" id="pmd_<?php echo($oPm->pm_id);?>" onclick="deleteMyPm('<?php echo($oPm['pm_id']);?>');return false;" title="<?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?>"><?php print Dyhb::L("删除",'__COMMON_LANG__@Template/Common',null);?></a></p>
										<?php endif;?>
										<p><input name="pmid[]" type="checkbox" value="<?php echo($oPm->pm_id);?>" /></p>
									</td>
								</tr>
								<?php else:?>
								<tr id="pm_<?php echo($oPm->pm_id);?>" class="<?php echo($sEven);?>">
									<td width="10px"><img src="<?php echo(__PUBLIC__);?>/images/common/pm.gif" /></td>
									<td>
										<?php if($oPm['pm_subject']):?><a href="<?php echo(Dyhb::U('home://pm/show?id='.$oPm->pm_id));?>"><h5><?php echo($oPm['pm_subject']);?></h5></a><?php endif;?>
										<p class="pm-cite"><a href="<?php echo(Dyhb::U('home://space@?id='.$oPm->pm_msgfromid));?>" target="_blank"><?php echo($oPm->pm_msgfrom);?></a> <?php print Dyhb::L("发布",'Template/Pm',null);?>&nbsp;<em><?php echo(Core_Extend::timeFormat($oPm->create_dateline));?></em><?php if(!in_array($oPm['pm_id'],$arrReadPms)):?>&nbsp;<img src="<?php echo(__PUBLIC__);?>/images/common/notice_newpm.gif" title="<?php print Dyhb::L("未读短消息",'Template/Pm',null);?>"/><?php endif;?></p>
										<p class="pm-summary">
										<?php echo(Pm_Extend::ubb(G::subString($oPm->pm_message,0,$GLOBALS['_cache_']['home_option']['pm_list_substring_num'])));?>
										</p>
										<p class="pm-more"><a href="<?php echo(Dyhb::U('home://pm/show?id='.$oPm->pm_id));?>"><?php print Dyhb::L("查看消息",'Template/Pm',null);?></a></p>
									</td>
									<?php if(in_array($sType,array('system','systemnew'))):?><td>
										<p><input name="pmid[]" type="checkbox" value="<?php echo($oPm->pm_id);?>" /></p>
									</td>
									<?php else:?>
									<td></td>
									<?php endif;?>
								</tr>
								<?php endif;?>
								
<?php $i++;?>
<?php endforeach;endif;?>
							</tbody>
						</table>
						<?php else:?>
						<?php print Dyhb::L("没有发现短消息",'Template/Pm',null);?>
						<?php endif;?>
					</div>
				</form>

				<?php echo($sPageNavbar);?>
			</div>
		</div><!--/row-->

<?php $this->includeChildTemplate(Core_Extend::template('footer'));?>