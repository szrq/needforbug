/* [NeedForBug!] (C)Dianniu From 2010.
   Needforbug 后台公用($)*/

// 选择表格行
var selectRowIndex=Array();

// 获取选择值
function getSelectValue(){
	var obj=document.getElementsByName('key');
	var result='';
	for(var i=0;i<obj.length;i++){
		if(obj[i].checked==true){
			return obj[i].value;
		}
	}

	return false;
}

function getSelectValues(){
	var obj=document.getElementsByName('key');
	var result='';
	var j=0;
	for(var i=0;i<obj.length;i++){
		if(obj[i].checked==true){
			selectRowIndex[j]=i+1;
			result+=obj[i].value+",";
			j++;
		}
	}

	return result.substring(0, result.length-1);
}

// 添加方法
function add(){
	window.location.href=D.U('add');
}

function addApp(appId,controller){
	window.location.href=D.U('app/config?id='+appId+'&action=add&controller='+controller);
}

// 编辑方法
function edit(id,controller,appId){
	var keyValue;
	if(id){
		keyValue=id;
	}else{
		keyValue=getSelectValue();
	}

	if(!keyValue){
		needforbugAlert(D.L('请选择操作项','__COMMON_LANG__@Admin/Common_Js'),'',3);
		return false;
	}

	if(controller){
		window.location.href=D.U('app/config?id='+appId+'&action=edit&controller='+controller+'&value='+keyValue);
	}else{
		window.location.href=D.U('edit?id='+keyValue);
	}
}

function editApp(appId,controller,id){
	edit(id,controller,appId);
}

// 删除操作
function foreverdel(id,appId,controller){
	var keyValue;
	if(id){
		keyValue=id;
	}else{
		keyValue=getSelectValues();
	}

	if(!keyValue){
		needforbugAlert(D.L('请选择操作项','__COMMON_LANG__@Admin/Common_Js'),'',3);
		return false;
	}

	needforbugConfirm(D.L('确实要永久删除选择项吗？','__COMMON_LANG__@Admin/Common_Js'),function(){
		if(controller){
			Dyhb.AjaxSend(D.U('app/config?action=foreverdelete'),'id='+appId+'&ajax=1'+'&value='+keyValue+'&controller='+controller,'',completeDelete);
		}else{
			Dyhb.AjaxSend(D.U('foreverdelete'),'id='+keyValue+'&ajax=1','',completeDelete);
		}
	});
}

function foreverdelApp(appId,controller,id){
	foreverdel(id,appId,controller);
}

function completeDelete(data,status){
	if(status==1){
		var Table=document.getElementById('checkList');
		var len=selectRowIndex.length;
		if(len==0){
			window.location.reload();
		}

		for(var i=len-1;i>=0;i--){
			Table.deleteRow(selectRowIndex[i]);
		}

		selectRowIndex=Array();
	}
}

// 排序
function sort(id){
	var keyValue;
	keyValue=getSelectValues();
	window.location.href=D.U('sort?sort_id='+keyValue);
}

function forbid(id,appId,controller){
	if(controller){
		window.location.href=D.U('app/config?action=forbid&'+'id='+appId+'&value='+id+'&controller='+controller);
	}else{
		window.location.href=D.U('forbid?id='+id);
	}
}

function forbidApp(appId,controller,id){
	forbid(id,appId,controller);
}

function resume(id,appId,controller){
	if(controller){
		window.location.href=D.U('app/config?action=resume&'+'id='+appId+'&value='+id+'&controller='+controller);
	}else{
		window.location.href=D.U('resume?id='+id);
	}
}

function resumeApp(appId,controller,id){
	resume(id,appId,controller);
}

function sortBy(field,sort){
	window.location.href=D.U('?order_='+field+'&sort_='+sort,SORTURL);
}

function clickToInput(field,id,appId,controller){
	var idObj=$('#'+field+'_'+id);

	if($('#'+field+'_input_'+id).attr("type")=="text"){
		return false;
	}

	var name=$.trim(idObj.html());
	var m=$.trim(idObj.text());

	idObj.html("<input type='text' value='"+name+"' id='"+field+"_input_"+id+"' title='"+D.L('点击修改值','__COMMON_LANG__@Admin/Common_Js')+"' >");

	$('#'+field+'_input_'+id).focus();

	$('#'+field+'_input_'+id).blur(function(){
		var n=$.trim($(this).val());
		if(n!=m && n!=""){
			if(!appId){
				Dyhb.AjaxSend(D.U('input_change_ajax'),'ajax=1&input_ajax_id='+id+'&input_ajax_val='+$('#'+field+'_input_'+id).val()+'&input_ajax_field='+field,'',clickToInputComplete);
			}else{
				Dyhb.AjaxSend(D.U('app/config?action=input_change_ajax&id='+appId),'ajax=1&input_ajax_id='+id+'&input_ajax_val='+$('#'+field+'_input_'+id).val()+'&input_ajax_field='+field+'&controller='+controller,'',clickToInputComplete);
			}
		}else{
			$(this).parent().html(name);
		}
	});
}

function clickToInputApp(field,value,id,controller){
	clickToInput(field,value,id,controller);
}

function clickToInputComplete(data,status){
	if(status==1){
		$('#'+data.id).html(data.value);
	}
}
