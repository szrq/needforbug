/* [NeedForBug!] (C)Dianniu From 2010.
   Home应用基础Javascript($)*/

/** 登陆相关 */
function login_handle(data,status){
	if(status==1){
		setTimeout("window.location=data.url;",1000);
	}
}

function rememberme(close){
	var sStyle='block';
	if(close==1){
		sStyle='none';
	}

	document.getElementById('remember_time').style.display=sStyle;
}
