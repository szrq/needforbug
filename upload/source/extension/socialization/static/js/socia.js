/* [NeedForBug!] (C)Dianniu From 2010.
   社会化帐号登录窗口($)*/

function sociaWinopen(url,id,iWidth,iHeight){
	var iTop=(screen.height-30-iHeight)/2; // 获得窗口的垂直位置;
	var iLeft=(screen.width-10-iWidth)/2; // 获得窗口的水平位置;
	sociaWin=window.showModalDialog(url,null,"dialogWidth="+iWidth+"px;dialogHeight="+iHeight+"px;dialogTop="+iTop+"px;dialogLeft="+iLeft+"px");
}

function iFrameHeight(frame){
	var ifm=document.getElementById(frame);
	var subWeb=document.frames?document.frames[frame].document:ifm.contentDocument;
	if(ifm!=null && subWeb!=null){
		ifm.height=subWeb.body.scrollHeight;
	}
}
