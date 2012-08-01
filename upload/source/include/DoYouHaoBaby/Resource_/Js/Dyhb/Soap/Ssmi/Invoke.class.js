/**
 * 向DoYouHaoBaby Framework通信接口发送消息
 *
 * @param string sClassName DoYouHaoBaoBaby Framework 通信接口类
 * @param string sMethodName DoYouHaoBaoBaby Framework 通信接口方法
 * @param array arrParams 请求数组参数
 * @param bool bAsync 是否异步请求数据
 * @returns 文本结果
 */
Dyhb.Soap.Ssmi.Invoke=function(sClassName,sMethodName,arrParams,bAsync){
	/* 是否异步发送 */
	if(typeof(bAsync)=='undefined'){
		bAsync=false;
	};

	/* 获取DoYouHaoBaby Framework SOAP 请求API */
	$sUrl=this.GetRequestURL(sClassName,sMethodName,arrParams);

	/* 发送请求并返回 */
	var arrOptions=new Array();
	arrOptions['async']=bAsync;
	arrOptions['method']='GET';
	oXmlHttp=Dyhb.Ajax.Request(sUrl,arrOptions);

	if(!bAsync){
		return oXmlHttp.responseText;
	}
};
