/* [NeedForBug!] (C)Dianniu From 2010.
   Group应用帖子操作($)*/

/** 操作 */
function modTopics(nOptgroup,sOperation){
	var sOperation=!sOperation?'':sOperation;
	
	$("#modActions").attr("action",D.U('group://grouptopicadmin/moderate?groupid='+nGroupid+'&moderate[]='+nGrouptopicid+(nOptgroup!=3 && nOptgroup!=2?'&from='+nGrouptopicid:'')));
	document.getElementById('modActions').optgroup.value=nOptgroup;
	document.getElementById('modActions').operation.value=sOperation;

	var sHtml = $.ajax({
		url: D.U('group://grouptopicadmin/moderate?groupid='+nGroupid+'&moderate[]='+nGrouptopicid+(nOptgroup!=3 && nOptgroup!=2?'&from='+nGrouptopicid:'')),
		async: false
	}).responseText;

	oEditNewmodtopics=needforbugAlert(sHtml,'你选择了一篇帖子','','','',400,100);
}
