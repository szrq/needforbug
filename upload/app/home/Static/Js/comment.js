/* [NeedForBug!] (C)Dianniu From 2010.
   Needforbug 新鲜事评论AJAX提交($)*/

/** 前端验证 */
function checkUrl(sUrl){
	var strRegex="^((https|http|ftp|rtsp|mms)?://)"
		+ "?(([0-9a-z_!~*'().&=+$%-]+:)?[0-9a-zA-Z_!~*'().&=+$%-]+@)?"
		+ "(([0-9]{1,3}\.){3}[0-9]{1,3}"
		+ "|"
		+ "([0-9a-zA-Z_!~*'()-]+\.)*"
		+ "([0-9a-zA-Z][0-9a-zA-Z-]{0,61})?[0-9a-z]\."
		+ "[a-zA-Z]{2,6})"
		+ "(:[0-9]{1,4})?"
		+ "((/?)|"
		+ "(/[0-9a-zA-Z_!~*'().;?:@&=+$,%#-]+)+/?)$";

	var re=new RegExp(strRegex);

	if(re.test(sUrl)){
		return true;
	}else{
		return false;
	}
}

function checkEmail(sEmail){
	var emailRegExp=new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
	
	if(!emailRegExp.test(sEmail)||sEmail.indexOf('.')==-1){
		return false;
	}else{
		return true;
	}
}

function commentCheckForm(){
	var comment_name=$.trim($('#homefreshcomment_name').val());
	var comment_email=$.trim($("#homefreshcomment_email").val());
	var comment_url=$.trim($("#homefreshcomment_url").val());
	var comment_content=$.trim($("#homefreshcomment_content").val());

	if(comment_name==""){
		needforbugAlert(D.L('评论名字不能为空','Js/Comment_Js'),D.L('评论发生错误','Js/Comment_Js'),3);
		return false;
	}

	if(comment_name.length>25){
		needforbugAlert(D.L('评论名字长度只能小于等于25个字符串','Js/Comment_Js'),D.L('评论发生错误','Js/Comment_Js'),3);
		return false;
	}

	if(comment_email!='' && !checkEmail(comment_email)){
		needforbugAlert(D.L('评论E-mail 格式错误','Js/Comment_Js'),D.L('评论发生错误','Js/Comment_Js'),3);
		return false;
	}

	if(comment_url!='' && !checkUrl(comment_url)){
		needforbugAlert(D.L('评论Url 格式错误','Js/Comment_Js'),D.L('评论发生错误','Js/Comment_Js'),3);
		return false;
	}

	if(comment_content == ""){
		needforbugAlert(D.L('评论内容不能为空','Js/Comment_Js'),D.L('评论发生错误','Js/Comment_Js'),3);
		return false;
	}

	return true;
}

/** 提交评论 */
function commentSubmit(){
	var bResult=commentCheckForm();
	if(bResult===false){
		return false;
	}

	$("#comment-submit").val(D.L('正在提交评论','Js/Comment_Js'));
	$("#comment-submit").attr("disabled", "disabled");
	Dyhb.AjaxSubmit('homefresh-commentform',D.U('home://ucenter/add_homefreshcomment'),'',commentComplete);
}

function commentComplete(data,status){
	$("#comment-submit").attr("disabled", false);
	$("#comment-submit").val(D.L('提交评论','Js/Comment_Js'));
	if(status==1){
		window.location.href=data.jumpurl;
	}
}
