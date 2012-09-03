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

function commentCheckForm(comment_content,customContent){
	var comment_name=$.trim($('#homefreshcomment_name').val());
	var comment_email=$.trim($("#homefreshcomment_email").val());
	var comment_url=$.trim($("#homefreshcomment_url").val());
	if(customContent==1){
		comment_content=$.trim($("#homefreshcomment_content").val());
	}

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

/** 评论浏览页面&提交评论 */
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

/** 我也来说一句&提交评论 */
function goodnum(id){
	Dyhb.AjaxSend(D.U('home://ucenter/update_homefreshgoodnum'),'ajax=1&id='+id,'',function(data,status,info){
		if(status==1){
			$('#goodnum_'+id).text(data.num);
			$('#goodnum_'+id).css("color","#4A4A4A");
		}
	});
}

var nCurrentHomefreshid='';

function commentForm(id){
	if($("#homefreshcommentform_"+nCurrentHomefreshid+' .homefreshcommentform_area').val()){
		needforbugConfirm(D.L('你确定要放弃正在编辑的评论?','Js/Comment_Js'),function(){
			$("#homefreshcommentdiv_"+nCurrentHomefreshid).css("display","block");
			$("#homefreshcommentform_"+nCurrentHomefreshid).css("display","none");
			$("#homefreshcommentform_"+nCurrentHomefreshid+' .homefreshcommentform_area').val('');
			homefreshcommentSwitchform(id);
			return true;
		},function(){
			$(".homefreshcommentform_area").focus();
			return true;
		});

		return false;
	}

	$("#homefreshcommentdiv_"+nCurrentHomefreshid).css("display","block");
	$("#homefreshcommentform_"+nCurrentHomefreshid).css("display","none");
	homefreshcommentSwitchform(id);

	return true;
}

function homefreshcommentSwitchform(id){
	$("#homefreshcommentdiv_"+id).css("display","none");
	$("#homefreshcommentform_"+id).css("display","block");

	$("#homefreshcommentform_"+id).html($("#homefreshcommentform_box").html());
		
	$('.homefreshcommentform_area').autoResize({
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

	$(".homefreshcommentform_area").focus();

	nCurrentHomefreshid=id;
}

function homefreshcommentCancel(){
	if($("#homefreshcommentform_"+nCurrentHomefreshid+' .homefreshcommentform_area').val()){
		needforbugConfirm(D.L('你确定要放弃正在编辑的评论?','Js/Comment_Js'),function(){
			$("#homefreshcommentdiv_"+nCurrentHomefreshid).css("display","block");
			$("#homefreshcommentform_"+nCurrentHomefreshid).css("display","none");
			$("#homefreshcommentform_"+nCurrentHomefreshid+' .homefreshcommentform_area').val('');
			return true;
		},function(){
			$(".homefreshcommentform_area").focus();
			return true;
		});

		return false;
	}

	$("#homefreshcommentdiv_"+nCurrentHomefreshid).css("display","block");
	$("#homefreshcommentform_"+nCurrentHomefreshid).css("display","none");

	return true;
}

function homefreshcommentSubmit(){
	var value=$("#homefreshcommentform_"+nCurrentHomefreshid+' .homefreshcommentform_area').val();
	var comment_name=$.trim($('#homefreshcomment_name').val());
	var comment_email=$.trim($("#homefreshcomment_email").val());
	var comment_url=$.trim($("#homefreshcomment_url").val());
	
	var bResult=commentCheckForm(value);
	if(bResult===false){
		return false;
	}

	var sUrlParameter="ajax=1&quick=1&homefreshcomment_content="+encodeURIComponent(value)+
		"&homefresh_id="+nCurrentHomefreshid+'&homefreshcomment_name='+encodeURIComponent(comment_name)+
		'&homefreshcomment_email='+encodeURIComponent(comment_email)+'&homefreshcomment_url='+encodeURIComponent(comment_url);

	Dyhb.AjaxSend(D.U('home://ucenter/add_homefreshcomment'),sUrlParameter,'',function(data,status){
		if(status==1){
			$("#homefreshcommentdiv_"+nCurrentHomefreshid).css("display","block");
			$("#homefreshcommentform_"+nCurrentHomefreshid).css("display","none");
			$("#homefreshcommentform_"+nCurrentHomefreshid).html("");

			$("#homefreshcommentlist_"+nCurrentHomefreshid).append(
				'<div class="homefreshcomment_item">'+
					'<div class="homefreshcomment_avatar">'+
						'<img src="'+data.avatar+'" class="thumbnail"/>'+
					'</div>'+
					'<div class="homefreshcomment_content">'+
						'<a href="'+data.url+'">'+data.comment_name+'</a>:'+data.homefreshcomment_content+'<br/>'+
						'<em class="homefreshcomment_date">'+data.create_dateline+'</em>'+
					'</div>'+
				'</div>'+
				'<div class="clear"></div>'
			);

			$("#homefreshcomment_"+nCurrentHomefreshid).html(data.num);
		}
	});
}
