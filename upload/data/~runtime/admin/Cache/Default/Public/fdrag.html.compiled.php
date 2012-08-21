<?php  /* DoYouHaoBaby Framework 模板缓存文件 生成时间：2012-08-21 00:10:30  */ ?>
<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php echo($GLOBALS['_option_']['needforbug_program_name']);?>! <?php print Dyhb::L("管理平台",'Template/Default/Common',null);?></title><link rel="stylesheet" type="text/css" href="<?php echo(__TMPLPUB__);?>/Css/style.css"/><script type="text/javascript">	var pic = new Image();
	pic.src="<?php echo(__TMPLPUB__);?>/Images/arrow_right.gif";

	function toggleMenu(){
		frmBody = parent.document.getElementById('body');
		imgArrow = document.getElementById('img');

		if (frmBody.cols == "0, 5, *"){
			frmBody.cols="120, 5, *";
			imgArrow.src = "<?php echo(__TMPLPUB__);?>/Images/arrow_left.gif";
		}else{
			frmBody.cols="0, 5, *";
			imgArrow.src = "<?php echo(__TMPLPUB__);?>/Images/arrow_right.gif";
		}
	}

	var orgX = 0;
	document.onmousedown = function(e){
		var evt = Utils.fixEvent(e);
		orgX = evt.clientX;
		if (Browser.isIE){
			document.getElementById('tbl').setCapture();
		}
	}

	document.onmouseup = function(e){
		var evt = Utils.fixEvent(e);

		frmBody = parent.document.getElementById('body');
		frmWidth = frmBody.cols.substr(0, frmBody.cols.indexOf(','));
		frmWidth = (parseInt(frmWidth) + (evt.clientX - orgX));
		frmBody.cols = frmWidth + ", 5, *";

		if (Browser.isIE){ 
			document.releaseCapture();
		}
	}

	var Browser = new Object();

	Browser.isMozilla = (typeof document.implementation != 'undefined') && (typeof document.implementation.createDocument != 'undefined') && (typeof HTMLDocument != 'undefined');
	Browser.isIE = window.ActiveXObject ? true : false;
	Browser.isFirefox = (navigator.userAgent.toLowerCase().indexOf("firefox") != - 1);
	Browser.isSafari = (navigator.userAgent.toLowerCase().indexOf("safari") != - 1);
	Browser.isOpera = (navigator.userAgent.toLowerCase().indexOf("opera") != - 1);

	var Utils = new Object();

	Utils.fixEvent = function(e){
		var evt = (typeof e == "undefined") ? window.event : e;
		return evt;
	}
	</script></head><body onselect="return false;" class="fdrag-body"><table height="100%" cellspacing="0" cellpadding="0" id="tbl"><tr><td><a href="javascript:toggleMenu();"><img src="<?php echo(__TMPLPUB__);?>/Images/arrow_left.gif" id="img" border="0" /></a></td></tr></table></body></html>