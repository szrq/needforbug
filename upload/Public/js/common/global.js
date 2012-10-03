/* [NeedForBug!] (C)Dianniu From 2010.
   Needforbug 前后台公用($)*/

function isUndefined(variable){
	return typeof variable=='undefined'?true:false;
}

function in_array(needle, haystack){
	if(typeof needle=='string' || typeof needle=='number'){
		for(var i in haystack){
			if(haystack[i]==needle){
				return true;
			}
		}
	}

	return false;
}

function trim(str){
	return(str+'').replace(/(\s+)$/g,'').replace(/^\s+/g,'');
}

function strlen(str){
	return(Dyhb.Browser.Ie && str.indexOf('\n')!=-1)?str.replace(/\r?\n/g,'_').length:str.length;
}

function mb_strlen(str){
	var len=0;

	for(var i=0;i<str.length;i++){
		len+=str.charCodeAt(i)<0 || str.charCodeAt(i)>255?(charset=='utf-8'?3:2):1;
	}

	return len;
}

function subStr(str,len,elli){
	if(!str || !len){
		return '';
	} 

	var a=0;
	var i=0;
	var temp='';
	for(i=0;i<str.length;i++){
		if(str.charCodeAt(i)>255){
			a+=2;
		}else{
			a++;
		}
		if(a>len){
			return temp+elli;
		}
		temp+=str.charAt(i);
	}

	return str;
}

function getObjectClass(obj) {
	if (typeof obj!="object" || obj===null){
		return false;
	}else{
		return /(\w+)\(/.exec(obj.constructor.toString())[1];
	}
}

function preg_replace(search,replace,str,regswitch){
	var regswitch=!regswitch?'ig':regswitch;
	var len=search.length;

	for(var i=0;i<len;i++){
		re=new RegExp(search[i],regswitch);
		str=str.replace(re,typeof replace=='string'?replace:(replace[i]?replace[i]:replace[0]));
	}

	return str;
}

function htmlspecialchars(str){
	return preg_replace(['&','<','>','"'],['&amp;','&lt;','&gt;','&quot;'],str);
}

function stripscript(s){
	return s.replace(/<script.*?>.*?<\/script>/ig,'');
}

function showDiv(id){
	try{
		var oDiv=document.getElementById(id);
		if(oDiv){
			if(oDiv.style.display=='none'){
				oDiv.style.display='block';
			}else{
				oDiv.style.display='none';
			}
		}
	}catch(e){}
}

function resizeUp(obj){
	var newheight=parseInt(document.getElementById(obj).style.height,10)+50;
	document.getElementById(obj).style.height=newheight+'px';
}

function resizeDown(obj){
	var newheight=parseInt(document.getElementById(obj).style.height,10)-50;
	if(newheight>0){
		document.getElementById(obj).style.height=newheight+'px';
	}
}

function updateSeccode(){
	if(document.getElementById("seccodeImage").innerHTML==''){
		document.getElementById('seccodeImage').style.display='block';
		document.getElementById("seccodeImage").innerHTML=D.L('验证码正在加载中','__COMMON_LANG__@Js/Global_Js');
	}

	var timenow=new Date().getTime();
	document.getElementById("seccodeImage").innerHTML='<img id="seccode" onclick="updateSeccode()" src="'+D.U('seccode?update='+timenow)+'" style="cursor:pointer" title="'+D.L('单击图片换个验证码','__COMMON_LANG__@Js/Global_Js')+'" alt="'+D.L('验证码正在加载中','__COMMON_LANG__@Js/Global_Js')+'" />';
}

function checkAll(str){
	var i;
	var inputs=document.getElementById(str).getElementsByTagName("input");

	for(i=1;i<inputs.length;i++){
		inputs[i].checked=inputs[0].checked;
	}
}

function showDistrict(sContainer,oElems,nTotallevel,nChangelevel,sContainertype){
	var getdid=function(oElem){
		var op=oElem.options[oElem.selectedIndex];
		return op['did'] || op.getAttribute('did') || '0';
	};

	var nPid=nChangelevel>=1 && oElems[0] && document.getElementById(oElems[0])?getdid(document.getElementById(oElems[0])):0;
	var nCid=nChangelevel>=2 && oElems[1] && document.getElementById(oElems[1])?getdid(document.getElementById(oElems[1])):0;
	var nDid=nChangelevel>=3 && oElems[2] && document.getElementById(oElems[2])?getdid(document.getElementById(oElems[2])):0;
	var nCoid=nChangelevel>=4 && oElems[3] && document.getElementById(oElems[3])?getdid(document.getElementById(oElems[3])):0;

	var sUrl=Dyhb.U('home://misc/district?container='+sContainer+'&containertype='+sContainertype+
			'&province='+oElems[0]+'&city='+oElems[1]+'&district='+oElems[2]+'&community='+oElems[3]+
			'&pid='+nPid+'&cid='+nCid+'&did='+nDid+'&coid='+nCoid+'&level='+nTotallevel+'&handlekey='+sContainer);
	
	Dyhb.Ajax.Get(sUrl,
		'',
		function(xhr,responseText){
			var sStr=xhr.responseText;
			var oContainer=document.getElementById(sContainer);
			oContainer.innerHTML=sStr;
		}
	);
}

function loadEditor(name){
	var editor=KindEditor.create('textarea[name="'+name+'"]',{
		langType:sEditorLang,
		resizeType:1,
		allowPreviewEmoticons:false,
		allowImageUpload:false,
		allowFlashUpload:false,
		allowMediaUpload:false,
		allowFileManager:false,
		items:['source','|','formatblock','fontname','fontsize','|','forecolor','hilitecolor','bold','italic','underline',
		'removeformat','|','justifyleft','justifycenter','justifyright','insertorderedlist',
		'insertunorderedlist','|','link','unlink','image','flash','code','|','fullscreen'],
		newlineTag:'<p>'
	});

	return editor;
}

function loadEditorThin(name){
	var editor=KindEditor.create('textarea[name="'+name+'"]',{
		langType:sEditorLang,
		resizeType:1,
		allowPreviewEmoticons:false,
		allowImageUpload:false,
		allowFlashUpload:false,
		allowMediaUpload:false,
		allowFileManager:false,
		items:['source','|','formatblock','fontname','fontsize','|','bold','forecolor','hilitecolor','italic','underline',
		'removeformat','|','link','unlink','image','|','fullscreen'],
		newlineTag:'<p>'
	});

	return editor;
}

/** 对话框 */
function needforbugAlert(sContent,sTitle,nTime,ok,cancel,width,height,lock){
	if(!sTitle){
		sTitle=D.L('提示信息','__COMMON_LANG__@Js/Common_Js');
	}

	if(!ok){
		ok=function(){
			return true;
		}
	}
	
	if(!cancel){
		cancel=function(){
			return true;
		}
	}

	var oDialog=$.dialog({
		fixed:true,
		title:sTitle,
		content: sContent,
		okValue: D.L('确定','__COMMON_LANG__@Js/Common_Js'),
		ok: ok,
		cancelValue: D.L('取消','__COMMON_LANG__@Js/Common_Js'),
		cancel: cancel
	});

	if(width && height){
		oDialog.size(width, height);
	}

	if(lock!=1){
		oDialog.lock();
	}

	if(nTime){
		oDialog.time(nTime*1000);
	}

	return oDialog;
}

function needforbugConfirm(sContent,ok,cancel,sTitle,nTime,width,height,lock){
	if(!sTitle){
		sTitle=D.L('提示信息','__COMMON_LANG__@Js/Common_Js');
	}

	if(!ok){
		ok=function(){
			return true;
		}
	}
	
	if(!cancel){
		cancel=function(){
			return true;
		}
	}

	var oDialog=$.dialog({
		id:'Confirm',
		fixed:true,
		title:sTitle,
		content:sContent,
		okValue: D.L('确定','__COMMON_LANG__@Js/Common_Js'),
		ok:ok,
		cancelValue: D.L('取消','__COMMON_LANG__@Js/Common_Js'),
		cancel: cancel
	});

	if(width && height){
		oDialog.size(width, height);
	}

	if(lock!=1){
		oDialog.lock();
	}

	if(nTime){
		oDialog.time(nTime*1000);
	}

	return oDialog;
}

/** 媒体对话框 */
var oEditNewattachmentcategory;
function globalAddattachment(sFunction){
	var sUrl=D.U('home://attachment/dialog_add?function='+sFunction);
	var sHtml='<iframe id="iframe_dialog" name="iframe_dialog" frameborder="0" style="margin: 0;width: 500px; height: 200px;overflow-x:hidden;margin:0;padding:0;" src="'+sUrl+'"></iframe>';

	oEditNewattachmentcategory=needforbugAlert(sHtml,'媒体管理器','','','',500,200,1);
}

function addEditorContent(oEditor,sContent){
	if(oEditor.designMode==false){
		needforbugAlert('请先切换到所见所得模式','',3);
	}else{
		oEditor.insertHtml(sContent);
	}
}

function insertAttachment(editor,nAttachmentid){
	addEditorContent(editor,'[attachment]'+nAttachmentid+'[/attachment]')
}

var oEditNewmusic='';
function addMusic(sFunction){
	var sHtml = $.ajax({
		url: D.U('home://misc/music?function='+sFunction),
		async: false
	}).responseText;

	oEditNewmusic=needforbugAlert(sHtml,'插入音乐','','','',500,100);
}

function insertMusic(editor,sContent){
	if(!sContent){
		needforbugAlert('音乐地址不能够为空','',3);
		return false;
	}

	sContent='[mp3]'+sContent+'[/mp3]';
	addEditorContent(editor,sContent);
	oEditNewmusic.close();
}

var oEditNewvideo='';
function addVideo(sFunction){
	var sHtml = $.ajax({
		url: D.U('home://misc/video?function='+sFunction),
		async: false
	}).responseText;

	oEditNewvideo=needforbugAlert(sHtml,'插入视频','','','',500,100);
}

function insertVideo(editor,sContent){
	if(!sContent){
		needforbugAlert('视频地址不能够为空','',3);
		return false;
	}

	sContent='[video]'+sContent+'[/video]';
	addEditorContent(editor,sContent);
	oEditNewvideo.close();
}
