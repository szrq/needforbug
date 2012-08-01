<?php
/* [DoYouHaoBaby!] (C)Dianniu From 2010.
   图片本地化实现类($)*/

!defined('DYHB_PATH') && exit;

class Image2Local extends UploadFile{

	protected $_sOriginalContent;
	protected $_sBackContent;

	public function __construct($sOriginalContent='',$nMaxSize=-1,$sSavePath='',$sSaveRule=''){
		parent::__construct($nMaxSize,'','',$sSavePath,$sSaveRule);
		
		$this->_sOriginalContent=$sOriginalContent;
	}

	public function local($sContent='',$sSavePath=''){
		// 数据处理量大的时候防止超时连接
		set_time_limit(300);

		// 如果不指定保存文件名，则由系统默认
		if(empty($sSavePath)){
			$sSavePath=$this->_sSavePath;
		}

		if(empty($sContent)){
			$sContent=$this->_sOriginalContent;
		}

		// 检查上传目录
		if(!is_dir($sSavePath)){
			if(is_dir(base64_decode($sSavePath))){
				$sSavePath=base64_decode($sSavePath);
			}else{// 尝试创建目录
				if(!$this->_bAutoCreateStoreDir){
					$this->_sError(Dyhb::L("存储目录不存在：“%s”",'__DYHB__@NetDyhb',null,$sSavePath));
					return false;
				}else if(!G::makeDir($sSavePath)){
					$this->_sError=Dyhb::L('上传目录%s不可写','__DYHB__@NetDyhb',null,$sSavePath);
					return false;
				}
			}
		}else{
			if(!is_writeable($sSavePath)){
				$this->_sError=Dyhb::L('上传目录%s不可写','__DYHB__@NetDyhb',null,$sSavePath);
				return false;
			}
		}

		if($this->_bWriteSafeFile){
			$this->writeSafeFile($sSavePath);// 写入目录安全文件
		}
		$this->_sSavePath=$sSavePath;
		$sContent=G::stripslashes($sContent);
		$this->_sBackContent=preg_replace_callback("/<img([^>]+)src=\"([^>\"]+)\"?([^>]*)>/i",array($this,'local2'),$sContent);

		return $this->_sBackContent;
	}

	protected function save($arrFile,$sImgData){
		$sFilename=$arrFile['savepath'].'/'.$arrFile['savename'];

		if(!$this->_bUploadReplace && is_file($sFilename)){// 不覆盖同名文件
			$this->_sError=Dyhb::L('文件%s已经存在！','__DYHB__@NetDyhb',null,$sFilename);
			return false;
		}

		if(($hFp=@fopen($sFilename,'w'))!==false){// 保存文件
			fwrite($hFp,$sImgData);
		}else{
			$this->_sError=Dyhb::L('写入文件%s失败！','__DYHB__@NetDyhb',null,$sFilename);
			return false;
		}
		@fclose($hFp);

		if($this->_bIsImagesWaterMark){// 创建水印
			$this->imageWaterMark($sFilename);
		}

		if($this->_bThumb){
			$arrImage=getimagesize($sFilename);
			if(false!==$arrImage){//是图像文件生成缩略图
				$arrThumbWidth=explode(',',$this->_nThumbMaxWidth);
				$arrThumbHeight=explode(',',$this->_nThumbMaxHeight);
				$arrThumbPrefix=explode(',',$this->_sThumbPrefix);
				$arrThumbSuffix=explode(',',$this->_sThumbSuffix);
				$arrThumbFile=explode(',',$this->_sThumbFile);
				$sThumbPath=$this->_sThumbPath?$this->_sThumbPath:$arrFile['savepath'];

				if(!is_dir($sThumbPath)){// 检查缩略图目录
					if(is_dir(base64_decode($sThumbPath))){// 检查目录是否编码后的
						$sThumbPath=base64_decode($sThumbPath);
					}else{// 尝试创建目录
						if(!$this->_bAutoCreateStoreDir){
							$this->_sError(Dyhb::L("存储目录不存在：“%s”",'__DYHB__@NetDyhb',null,$sThumbPath));
							return false;
						}else if(!mkdir($sThumbPath)){
							$this->_sError=Dyhb::L('上传目录%s不可写','__DYHB__@NetDyhb',null,$sThumbPath);
							return false;
						}
					}

					if($this->_bWriteSafeFile){
						$this->writeSafeFile($sThumbPath);// 写入目录安全文件
					}
				}

				$sRealFilename=$this->_bAutoSub?basename($arrFile['savename']):$arrFile['savename'];// 生成图像缩略图
				for($nI=0,$nLen=count($arrThumbWidth);$nI<$nLen;$nI++){
					$sThumbname=$sThumbPath.'/'.$arrThumbPrefix[$nI].$sRealFilename.$arrThumbSuffix[$nI].'.'.$arrFile['extension'];
					if($this->_bThumbFixed===true){
						Image::thumb($sFilename,$sThumbname,'',$arrThumbWidth[$nI],$arrThumbHeight[$nI],true,true);
					}else{
						Image::thumb($sFilename,$sThumbname,'',$arrThumbWidth[$nI],$arrThumbHeight[$nI],true);
					}
				}

				if($this->_bThumbRemoveOrigin){// 生成缩略图之后删除原图
					unlink($sFilename);
				}
			}
		}

		// 对图片压缩包在线解压
		if($this->_bZipImages){}

		return true;
	}

	protected function local2($arrMatches){
		$arrUrl=parse_url($arrMatches[2]);

		$sHost=$_SERVER['HTTP_HOST'];
		if(isset($arrUrl['host']) && $arrUrl['host']!=$sHost){
			$sPath=$arrUrl['path'];
			if(!empty($arrUrl['query'])){
				$sPath.='?'.$arrUrl['query'];
			}

			$sHttpRequest="GET {$sPath} HTTP/1.0\r\n";
			$sHttpRequest.="ACCEPT: */*\r\n";
			$sHttpRequest.="ACCEPT-LANGUAGE: zh-cn\r\n";
			$sHttpRequest.="USER_AGENT: ".$_SERVER['HTTP_USER_AGENT']."\r\n";
			$sHttpRequest.="HOST: ".$arrUrl['host']."\r\n";
			$sHttpRequest.="CONNECTION: close\r\n";
			$sHttpRequest.="COOKIE: {$_COOKIE}\r\n\r\n";
			$sResponse='';

			if(FALSE!=($hFs=@fsockopen($arrUrl['host'],empty($arrUrl['port'])?80:$arrUrl['port'],$nErrNum,$sErrStr,10))){
				fwrite($hFs,$sHttpRequest);
				while(!feof($hFs)){
					$sResponse.=fgets($hFs,1160);
				}
				@fclose($hFs);

				$arrResponse=explode("\r\n\r\n",$sResponse,2);// 处理扩展信息
				unset($sResponse);

				$sImgData=$arrResponse[1];// 文件数据
				preg_match("/Content-Type: (.*)/i",$arrResponse[0],$arrImgType);// 取得文件类型
				$sImgType=$arrImgType[1];
				unset($arrImgType);

				preg_match("/Content-Length: (.*)\r\n/i",$arrResponse[0],$arrImgLength);// 取得文件长度
				$nImgLength=$arrImgLength[1];
				unset($arrImgLength);

				$sImgExt=strtolower(substr(strrchr($arrMatches[2],"."),1));// 处理图片扩展信息
				if(empty($sImgExt)||!in_array($sImgExt,array('jpeg','jpg','png','gif','bmp','jpg'))){
					if($sImgType=='image/pjpeg'){
						$sImgExt='jpeg';
					}elseif($sImgType=='image/jpeg'){
						$sImgExt='jpg';
					}elseif($sImgType=='image/x-png' || $sImgType=='image/png'){
						$sImgExt='png';
					}elseif($sImgType=='image/gif'){
						$sImgExt='gif';
					}elseif($sImgType=='image/bmp'){
						$sImgExt='bmp';
					}else{
						$sImgExt='jpg';
					}
					$sImgName='image2local_'.gmdate('YmdHis').'.'.$sImgExt;
				}else{
					$sImgName=basename($arrMatches[2]);// 文件名字
				}

				$arrFile=array();// 写入远程文件信息
				$arrFile["name"]=$sImgName;
				$arrFile["type"]=$sImgType;
				$arrFile["size"]=$nImgLength;
				$arrFile['key']=$this->_nKey;// 登记远程文件的扩展信息
				$arrFile['extension']=$sImgExt;
				$arrFile['savepath']=$this->_sSavePath;
				$arrFile['savename']=$this->getSaveName($arrFile);
				$arrFile['isthumb']=$this->_bThumb?1:0;
				$arrFile['thumbprefix']=$this->_sThumbPrefix;
				$arrFile['thumbpath']=$this->_sThumbPath;
				$arrFile['module']=MODULE_NAME;

				if($this->_bAutoCheck){// 自动检查附件
					if(!$this->check($arrFile)){return "<img{$arrMatches[1]}src=\"{$arrMatches[2]}\"{$arrMatches[3]}>";}// 验证错误直接返回原图
				}

				if(!$this->save($arrFile,$sImgData)){// 保存远程文件
					return "<img{$arrMatches[1]}src=\"{$arrMatches[2]}\"{$arrMatches[3]}>";
				}

				if(function_exists($this->_sHashType)){
					$sFun= $this->_sHashType;
					$arrFile['hash'] =$sFun(G::gbkToUtf8($arrFile['savepath'].'/'.$arrFile['savename'],'utf-8','gb2312'));
				}

				$this->_nKey++;
				$this->_arrUploadFileInfo[]=$arrFile;// 保存文件的信息
				return "[upload]".$arrFile['savename']."[/upload]";
			}else{
				return "<img{$arrMatches[1]}src=\"{$arrMatches[2]}\"{$arrMatches[3]}>";
			}
		}else{
			return "<img{$arrMatches[1]}src=\"{$arrMatches[2]}\"{$arrMatches[3]}>";
		}
	}

	public function getBackContent(){
		return $this->_sBackContent;
	}

	public function getOriginalContent(){
		return $this->_sOriginalContent;
	}

	public function setBackContent($sBackContent=''){
		$sOldValue=$this->_sBackContent;
		$this->_sBackContent=$sBackContent;

		return $sOldValue;
	}

	public function setOriginalContent($sOriginalContent=''){
		$sOldValue=$this->_sOriginalContent;
		$this->_sOriginalContent=$sOriginalContent;

		return $sOriginalContent;
	}

}
