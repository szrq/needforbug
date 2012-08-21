<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-21 00:30:04  */ ?>
<?php $this->includeChildTemplate(TEMPLATE_PATH.'/Public/header.html');?><script type="text/javascript">var oEditAppconfig='';

function editGlobalconfig(){
	var sHtml = $.ajax({
		url: D.U('appconfigtool/edit_globalconfig'),
		async: false
	}).responseText;
	oEditGlobalconfig=needforbugAlert(sHtml,'<?php print Dyhb::L("编辑全局配置",'Template/Default/Appconfigtool',null);?>','',saveGlobalconfig,cancelGlobalconfig);
}

function saveGlobalconfig(){
	Dyhb.AjaxSubmit('globalconfigAdd','<?php echo(Dyhb::U('appconfigtool/save_globalconfig'));?>','',function(data,status,info){
		if(status==1){
			oEditGlobalconfig.close();
		}else{
			needforbugAlert(info);
		}
		return true;
	});
	return false;
}

function cancelGlobalconfig(){
	needforbugConfirm('<?php print Dyhb::L("你确定放弃修改配置文件？",'Template/Default/Appconfigtool',null);?>',function(){
		oEditGlobalconfig.close();
		return true;
	});
	return false;
}

function viewGlobaldefaultconfig(){
	$("#ajaxGlobaldefaultconfig").css('display','block');
	var sHtml = $.ajax({
		url: "<?php echo(Dyhb::U('appconfigtool/default_config'));?>",
		async: false
	}).responseText;
	$("#ajaxGlobaldefaultconfig").html(sHtml);
}

function closeGlobaldefaultconfig(){
	$("#ajaxGlobaldefaultconfig").css('display','none');
}

function viewAppconfig(sApp,type){
	var sHtml = $.ajax({
		url: D.U('appconfigtool/app_config?app='+sApp+(type==1?'&type=file':'')),
		async: false
	}).responseText;

	needforbugAlert(sHtml,sApp+'  '+(type==1?'<?php print Dyhb::L("配置文件",'Template/Default/Appconfigtool',null);?>':'<?php print Dyhb::L("缓存文件",'Template/Default/Appconfigtool',null);?>'));
}

function deleteAppconfig(sApp){
	window.location.href=D.U('appconfigtool/delete_appconfig?app='+sApp);
}

function deleteAppconfigs(){
	document.getElementById('configList').submit();
}

var oEditAppconfig='';

function editAppconfig(sApp){
	var sHtml = $.ajax({
		url: D.U('appconfigtool/edit_appconfig?app='+sApp),
		async: false
	}).responseText;
	oEditAppconfig=needforbugAlert(sHtml,'<?php print Dyhb::L("编辑应用配置",'Template/Default/Appconfigtool',null);?>'+'  '+sApp,'',saveAppconfig,cancelAppconfig);
}

function saveAppconfig(){
	Dyhb.AjaxSubmit('appconfigAdd','<?php echo(Dyhb::U('appconfigtool/save_appconfig'));?>','',function(data,status,info){
		if(status==1){
			oEditAppconfig.close();
		}else{
			needforbugAlert(info);
		}
		return true;
	});
	return false;
}

function cancelAppconfig(){
	needforbugConfirm('<?php print Dyhb::L("你确定放弃修改配置文件？",'Template/Default/Appconfigtool',null);?>',function(){
		oEditAppconfig.close();
		return true;
	});
	return false;
}
</script><section class="secondary_bar"><div class="breadcrumbs_container"><article class="breadcrumbs"><a href="<?php echo(Dyhb::U('public/fmain'));?>"><?php print Dyhb::L("主页",'Template/Default/Common',null);?></a><div class="breadcrumb_divider"></div><a class="current"><?php print Dyhb::L("应用配置",'Template/Default/Appconfigtool',null);?></a><div class="breadcrumb_divider"></div><a href="javascript:void(0);" onclick="adminctrlmenuAdd('<?php echo(__SELF__);?>','<?php print Dyhb::L("应用配置",'Template/Default/Appconfigtool',null);?>')" title="<?php print Dyhb::L("添加到快捷导航",'Template/Default/Common',null);?>">[+]</a></article></div></section><section id="main" class="column"><article class="module width_full"><header><h3><?php print Dyhb::L("操作提示",'Template/Default/Common',null);?></h3></header><div class="module_content"><ul><li><?php print Dyhb::L("Needforbug采用DoYouHaoBaby框架开发，通过改变框架的配置可以实现很多功能",'Template/Default/Appconfigtool',null);?></li><li><?php print Dyhb::L("这里将会向你展示完善的整个系统的配置数据，让你心中有数",'Template/Default/Appconfigtool',null);?></li></ul></div></article><article class="module width_full"><header><h3><?php print Dyhb::L("当前全局应用配置",'Template/Default/Appconfigtool',null);?></h3></header><div class="module_content"><a name="changeappconfig"></a><ul><li><?php print Dyhb::L("全局应用配置中存放着数据库连接等系统核心配置，所有应用中的配置都会加载它",'Template/Default/Appconfigtool',null);?>&nbsp;<?php echo($sAppGlobalconfigFile);?><br/><a href="javascript:void(0);" onclick="editGlobalconfig();"><?php print Dyhb::L("修改全局配置",'Template/Default/Appconfigtool',null);?></a></li><li><?php print Dyhb::L("全局配置数据最初由安装程序根据全局惯性配置加上一些初始化数据生成",'Template/Default/Appconfigtool',null);?><?php echo($sAppGlobaldefaultconfigFile);?><br/><a href="javascript:void(0);" onclick="viewGlobaldefaultconfig();"><?php print Dyhb::L("查看全局惯性配置",'Template/Default/Appconfigtool',null);?></a></li></ul><table class="tablesorter" cellspacing="0"><thead><tr><th width="50%"><?php print Dyhb::L("配置文件信息",'Template/Default/Appconfigtool',null);?></th><th width="50%"><?php print Dyhb::L("配置文件数据值",'Template/Default/Appconfigtool',null);?></th></tr></thead><tbody><tr style="background:none;" ><td><div style="height: 200px; width: 100%; overflow:auto;"><?php echo($sAppGlobalconfig);?></div></td><td><div style="height: 200px; width: 100%; overflow:auto;"><table class="tablesorter" cellspacing="0"><thead><tr><th><?php print Dyhb::L("配置项",'Template/Default/Appconfigtool',null);?></th><th><?php print Dyhb::L("配置值",'Template/Default/Appconfigtool',null);?></th></tr></thead><tbody><?php $i=1;?><?php if(is_array($arrAppGlobalconfigs)):foreach($arrAppGlobalconfigs as $key=>$value):?><tr style="background:none;"><td><?php echo($key);?></td><td><?php echo($TheController->filter_value($value));?></td></tr><?php $i++;?><?php endforeach;endif;?></tbody></table></div></td></tr></tbody></table><p class="none" id="ajaxGlobaldefaultconfig"><img src="<?php echo(__TMPLPUB__);?>/Images/ajaxloading.gif"></img><span><?php print Dyhb::L("全局惯性配置数据加载中",'Template/Default/Appconfigtool',null);?>...</span></p></div></article><article class="module width_full"><div class="module_content"><div class="operate" ><input type="button" name="delete" value="<?php print Dyhb::L("删除",'Template/Default/Common',null);?>" onclick="deleteAppconfigs()" class="alt_btn"></div></div></article><article class="module width_full"><header><h3><?php print Dyhb::L("系统所有应用配置值",'Template/Default/Appconfigtool',null);?></h3></header><div class="module_content"><ul><li><?php print Dyhb::L("注意配置缓存文件删除后，下次访问的时候将会重建",'Template/Default/Appconfigtool',null);?></li><li><?php print Dyhb::L("文件后面有一个删除图标的表示该文件已经不存在",'Template/Default/Appconfigtool',null);?></li><li><?php print Dyhb::L("注意admin应用配置在执行删除后，看起来没有删除是因为admin应用一直处于运行中会自动创建",'Template/Default/Appconfigtool',null);?></li></ul><a name="apps"></a><form action="<?php echo(Dyhb::U('appconfigtool/delete_appconfigs'));?>" method="post" id="configList" name="configList" ><table class="tablesorter" cellspacing="0" id="checkList"><thead><tr><th width="20px"><input type="checkbox" onclick="checkAll('checkList')"></th><th width="50px">&nbsp;</th><th><?php print Dyhb::L("应用名",'Template/Default/Appconfigtool',null);?></th><th><?php print Dyhb::L("应用配置文件",'Template/Default/Appconfigtool',null);?></th><th width="150px"><?php print Dyhb::L("应用配置数据值",'Template/Default/Appconfigtool',null);?></th><th><?php print Dyhb::L("操作",'Template/Default/Common',null);?></th></tr></thead><tbody><?php $i=1;?><?php if(is_array($arrLists)):foreach($arrLists as $key=>$oList):?><tr <?php if($oList['app_identifier']=='admin'):?>class="warning"<?php endif;?>><td><input type="checkbox" name="key[]" value="<?php echo($oList['app_identifier']);?>" <?php if($oList['config_cache_file_exist']===false):?>disabled="true"<?php endif;?>></td><td><img src="<?php echo($oList['logo']);?>" /></td><td><?php echo($oList['app_name']);?><br/><?php echo($oList['app_identifier']);?></td><td><p><?php print Dyhb::L("配置文件",'Template/Default/Appconfigtool',null);?><?php echo($oList['config_file']);?><?php if($oList['config_file_exist']===false):?><img src="<?php echo(__TMPLPUB__);?>/Images/no.gif"/><?php endif;?><br/><a href="javascript:void(0);" onclick="editAppconfig('<?php echo($oList['app_identifier']);?>')" title="<?php print Dyhb::L("编辑应用配置文件",'Template/Default/Appconfigtool',null);?>"><?php print Dyhb::L("编辑配置",'Template/Default/Appconfigtool',null);?></a></p><p><?php print Dyhb::L("缓存文件",'Template/Default/Appconfigtool',null);?><?php echo($oList['config_cache_file']);?><?php if($oList['config_cache_file_exist']===false):?><img src="<?php echo(__TMPLPUB__);?>/Images/no.gif"/><?php endif;?></p></td><td><a href="javascript:void(0);" onclick="viewAppconfig('<?php echo($oList['app_identifier']);?>','1')"><?php print Dyhb::L("查看文件",'Template/Default/Appconfigtool',null);?></a> | <a href="javascript:void(0);" onclick="viewAppconfig('<?php echo($oList['app_identifier']);?>')"><?php print Dyhb::L("查看结果",'Template/Default/Appconfigtool',null);?></a></td><td><?php if($oList['config_cache_file_exist']):?><a href="javascript:void(0);" onclick="deleteAppconfig('<?php echo($oList['app_identifier']);?>')"><?php print Dyhb::L("删除缓存",'Template/Default/Appconfigtool',null);?></a><?php else:?><?php print Dyhb::L("已删除",'Template/Default/Appconfigtool',null);?><?php endif;?></td></tr><?php $i++;?><?php endforeach;endif;?></tbody></table></form></div></article><article class="module width_full"><div class="module_content"><?php echo($sPageNavbar);?></div></article><article class="module width_full"><div class="module_content"><div class="operate" ><input type="button" name="delete" value="<?php print Dyhb::L("删除",'Template/Default/Common',null);?>" onclick="deleteAppconfigs()" class="alt_btn"></div></div></article><div class="spacer"></div></section><?php $this->includeChildTemplate(TEMPLATE_PATH.'/Public/footer.html');?>