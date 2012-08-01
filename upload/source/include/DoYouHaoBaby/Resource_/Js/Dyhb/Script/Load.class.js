/**
 * DoYouHaoBaby 头部加入Javascript文件
 *
 * @param string sSrc JavaScript路径
 * @returns void
 */
Dyhb.Script.Load=function(sSrc){
	/* 获取头部 head节点 */
	var oElementCollection=document.getElementsByTagName('head');

	if(oElementCollection.length==0){
		throw new Error("Current Page Hasn't Head tag.");
	}else{
		var oHead=oElementCollection[0];
	}

	/* 创建一个javascript元素 */
	var oScript=document.createElement('script');
	oScript.type="text/javascript";
	oScript.src=sSrc;

	/* 将Javscript 文件载入头部 */
	oHead.appendChild(oScript);
};
