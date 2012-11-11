<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商品控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入商城模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/shop/App/Class/Model');

class ShopgoodsController extends InitController{

	protected $_arrUploaddata=array();

	public function filter_(&$arrMap){
		//$arrMap['group_name']=array('like','%'.G::getGpc('group_name').'%');
		//$nUid=intval(G::getGpc('uid','G'));
		//if($nUid){
			//$arrMap['user_id']=$nUid;
		//}
	}

	public function index($sModel=null,$bDisplay=true){
		parent::index('shopgoods',false);

		$this->display(Admin_Extend::template('shop','shopgoods/index'));
	}

	public function add(){
		$this->bAdd_();

		$this->get_shopcategorytree_();
		
		$this->display(Admin_Extend::template('shop','shopgoods/add'));
	}

	public function bAdd_(){
		Core_Extend::loadCache("shop_option");
		
		$arrOptionData=$GLOBALS['_cache_']['shop_option'];
		$arrShopgoodsimgsizes=explode('|',$arrOptionData['shopgoods_imgsize']);
		$arrShopgoodsthumbimgsizes=explode('|',$arrOptionData['shopgoods_thumbimgsize']);

		$this->assign('arrOptionData',$arrOptionData);
		$this->assign('arrShopgoodsimgsizes',$arrShopgoodsimgsizes);
		$this->assign('arrShopgoodsthumbimgsizes',$arrShopgoodsthumbimgsizes);
		
		$this->shopgoodstype_();
	}

	public function get_shopcategorytree_(){
		$oShopcategory=Dyhb::instance('ShopcategoryModel');
		$oShopcategoryTree=$oShopcategory->getShopcategoryTree();
		
		$this->assign('oShopcategoryTree',$oShopcategoryTree);
	}

	public function insert($sModel=null,$nId=null){
		$nId=G::getGpc('value');

		$this->strtotime_();

		parent::insert('shopgoods',$nId);
	}

	public function bEdit_(){
		$this->bAdd_();

		// 读取商品相册图片
		$arrUploadgallerys=ShopgoodsgalleryModel::F('shopgoods_id=?',intval(G::getGpc('value','G')))->getAll();
		$this->assign('arrUploadgallerys',$arrUploadgallerys);
		
		$this->shopgoodstype_();
	}

	public function edit($sMode=null,$nId=null,$bDidplay=true){
		$nId=intval(G::getGpc('value','G'));

		$this->bEdit_();
		
		$this->get_shopcategorytree_();
		
		parent::edit('shopgoods',$nId,false);
		$this->display(Admin_Extend::template('shop','shopgoods/add'));
	}

	public function update($sModel=null,$nId=null){
		$nId=G::getGpc('value');

		$this->strtotime_();
	
		$arrUploaddata=array();

		// 商品图片上传
		$arrUploadgoodsimgdata=$this->shopgoodsimg_();

		// 商品相册图片上传
		$arrUploadgallerydata=$this->shopgoodsgallery_();
		
		if(!empty($arrUploadgoodsimgdata)){
			$arrUploaddata['shopgoodsimg']=$arrUploadgoodsimgdata;
		}

		if(!empty($arrUploadgallerydata)){
			$arrUploaddata['shopgalleryimg']=$arrUploadgallerydata;
		}
		
		$this->_arrUploaddata=$arrUploaddata;
		
		// 更新已经上传相册的信息
		$this->update_galleryinfo_();

		// 更新商品属性值
		$this->update_attributevalue_($nId);

		parent::update('shopgoods',$nId);
	}

	protected function update_attributevalue_($nId){
		$arrShopattributeidlist=G::getGpc('shopattributeid_list','P');
		$arrShopattributevaluelist=G::getGpc('shopattributevalue_list','P');
		$nShopgoodsid=intval($nId);
		$nShopattributeid=intval(G::getGpc('shopattribute_id','P'));

		if(!empty($arrShopattributeidlist)){
			foreach($arrShopattributeidlist as $nKey=>$nShopattributeid){
				$oShopattributevalue=ShopattributevalueModel::F('shopattribute_id=? AND shopgoods_id=?',$nShopattributeid,$nShopgoodsid)->getOne();
				if(empty($oShopattributevalue['shopattributevalue_id'])){
					$oShopattributevalue=new ShopattributevalueModel();
				}

				$sShopattributevalue=isset($arrShopattributevaluelist[$nShopattributeid])?$arrShopattributevaluelist[$nShopattributeid]:'';
				
				if(is_array($sShopattributevalue)){
					$sShopattributevalue=serialize($sShopattributevalue);
				}

				$oShopattributevalue->shopattribute_value=trim($sShopattributevalue);
				$oShopattributevalue->shopgoods_id=$nShopgoodsid;
				$oShopattributevalue->shopattribute_id=$nShopattributeid;

				if(empty($oShopattributevalue['shopattributevalue_id'])){
					$oShopattributevalue->save(0);
				}else{
					$oShopattributevalue->save(0,'update');
				}

				if($oShopattributevalue->isError()){
					$this->E($oShopattributevalue->getErrorMessage());
				}
			}
		}
	}
	
	protected function update_galleryinfo_(){
		if(isset($_POST['gallerydescription'])){
			$arrGallerydescriptions=G::getGpc('gallerydescription','P');
			$arrGallerynames=G::getGpc('galleryname','P');
			
			if(is_array($arrGallerydescriptions)){
				foreach($arrGallerydescriptions as $nKey=>$sGallerydescription){
					$oShopgoodsgallery=ShopgoodsgalleryModel::F('shopgoodsgallery_id=?',$nKey)->getOne();
					if(!empty($oShopgoodsgallery['shopgoodsgallery_id'])){
						$oShopgoodsgallery->shopgoodsgallery_description=$sGallerydescription;
						$oShopgoodsgallery->shopgoodsgallery_name=$arrGallerynames[$nKey];
						$oShopgoodsgallery->save(0,'update');
						
						if($oShopgoodsgallery->isError()){
							$this->E($oShopgoodsgallery->getErrorMessage());
						}
					}
				}
			}
		}
	}

	protected function shopgoodsgallery_(){
		require_once(Core_Extend::includeFile('function/Upload_Extend'));
		
		Core_Extend::loadCache("shop_option");
		$arrOptionData=$GLOBALS['_cache_']['shop_option'];

		$arrUploadoption=array(
			'upload_single'=>0,
		);

		$bNeedupload=false;
		if(is_array($_FILES['shopgoodsgallery']['error'])){
			foreach($_FILES['shopgoodsgallery']['error'] as $nErrorno){
				if($nErrorno!=4){
					$bNeedupload=true;
					break;
				}
			}
		}

		$arrData=array();
		if($bNeedupload===true){
			$arrData=$this->uploadAFile_('',$arrUploadoption);
		}

		return $arrData;
	}

	protected function shopgoodsimg_(){
		require_once(Core_Extend::includeFile('function/Upload_Extend'));
		
		Core_Extend::loadCache("shop_option");
		$arrOptionData=$GLOBALS['_cache_']['shop_option'];

		$arrShopgoodsimgsizes=explode('|',$arrOptionData['shopgoods_imgsize']);
		
		$arrData=array();
		
		if(isset($_FILES['shopgoodsimg'])){
			if($_FILES['shopgoodsimg']['error']!=4){
				$arrUploadoption=array();
				if(isset($_FILES['shopgoodsthumbimg']) && $_FILES['shopgoodsthumbimg']['error']!=4){
					$arrUploadoption=array(
						'upload_thumb_size'=>$arrOptionData['shopgoods_imgsize'],
						'upload_thumb'=>'thumb'.$arrShopgoodsimgsizes[0].'_',
					);
				}
				
				$arrData=$this->uploadAFile_('shopgoodsimg',$arrUploadoption);
			}
		}
		
		if(isset($_FILES['shopgoodsthumbimg'])){
			if($_FILES['shopgoodsthumbimg']['error']!=4){
				$arrThumbdata=$this->uploadAFile_('shopgoodsthumbimg',array('upload_create_thumb'=>0,'flash_inputname'=>'shopgoodsthumbimg'));
				$arrData['shopgoods_thumb']=$arrThumbdata['shopgoods_originalimg'];
			}
		}

		if(isset($_FILES['shopgoodsimg'])){
			unset($_FILES['shopgoodsimg']);
		}
		
		if(isset($_FILES['shopgoodsthumbimg'])){
			unset($_FILES['shopgoodsthumbimg']);
		}
		
		return $arrData;
	}
	
	protected function uploadAFile_($sFilename,$arrUploadoption=array()){
		$arrOptionData=$GLOBALS['_cache_']['shop_option'];
		$arrShopgoodsimgsizes=explode('|',$arrOptionData['shopgoods_imgsize']);
		$arrShopgoodsthumbimgsizes=explode('|',$arrOptionData['shopgoods_thumbimgsize']);
	
		if(empty($sFilename) || isset($_FILES[$sFilename])){
			try{
				$arrData=array();
				
				$arrDefaultUploadoption=array(
					'upload_allowed_type'=>'jpg|jpeg|gif|bmp|png',
					'upload_path'=>NEEDFORBUG_PATH.'/data/upload/app/shop/shopgoods',
					'upload_create_thumb'=>1,
					'flash_inputname'=>'shopgoodsimg',
					'upload_thumb_size'=>$arrShopgoodsthumbimgsizes[0].','.$arrShopgoodsthumbimgsizes[0].'|'.$arrShopgoodsthumbimgsizes[1].','.$arrShopgoodsthumbimgsizes[1],
					'upload_thumb'=>'thumb'.$arrShopgoodsthumbimgsizes[0].'_,thumb'.$arrShopgoodsimgsizes[0].'_',
					'upload_single'=>1,
				);
				
				$arrUploadoption=array_merge($arrDefaultUploadoption,$arrUploadoption);

				if($arrUploadoption['upload_single']==1){
					$arrUploadinfos=Upload_Extend::uploadFlash(true,true,false,$arrUploadoption);
				}else{
					$arrUploadinfos=Upload_Extend::uploadNormal(true,false,$arrUploadoption);
				}

				if(is_array($arrUploadinfos)){
					foreach($arrUploadinfos as $nKey=>$arrUploadinfo){
						$arrData[$nKey]['shopgoods_originalimg']=str_replace(G::tidyPath(NEEDFORBUG_PATH.'/data/upload/app/shop/shopgoods').'/','',G::tidyPath($arrUploadinfo['savepath'])).'/'.$arrUploadinfo['savename'];
			
						if($arrUploadoption['upload_create_thumb']==1){
							$arrData[$nKey]['shopgoods_img']=str_replace(G::tidyPath(NEEDFORBUG_PATH.'/data/upload/app/shop/shopgoods').'/','',G::tidyPath($arrUploadinfo['thumbpath'])).'/thumb'.$arrShopgoodsimgsizes[0].'_'.$arrUploadinfo['savename'];
							
							if(strpos($arrUploadoption['upload_thumb'],',')){
								$arrData[$nKey]['shopgoods_thumb']=str_replace(G::tidyPath(NEEDFORBUG_PATH.'/data/upload/app/shop/shopgoods').'/','',G::tidyPath($arrUploadinfo['thumbpath'])).'/thumb'.$arrShopgoodsthumbimgsizes[0].'_'.$arrUploadinfo['savename'];
							}
						}
						
						$arrData[$nKey]['shopgoods_name']=$arrUploadinfo['name'];
					}
				}
				
				if($arrUploadoption['upload_single']==1){
					$arrData=$arrData[0];
				}

				return $arrData;
			}catch(Exception $e){
				$this->E($e->getMessage());
			}
		}else{
			return false;
		}
	}

	public function AUpdateObject_($oModel){
		$arrUploaddata=$this->_arrUploaddata;
		
		if(isset($arrUploaddata['shopgoodsimg'])){
			$oModel->shopgoods_originalimg=$arrUploaddata['shopgoodsimg']['shopgoods_originalimg'];
			$oModel->shopgoods_thumb=$arrUploaddata['shopgoodsimg']['shopgoods_thumb'];
			$oModel->shopgoods_img=$arrUploaddata['shopgoodsimg']['shopgoods_img'];
		}

		if(isset($arrUploaddata['shopgalleryimg'])){
			if(is_array($arrUploaddata['shopgalleryimg'])){
				foreach($arrUploaddata['shopgalleryimg'] as $arrUploadgallerydata){
					$arrSavedata=array(
						'shopgoods_id'=>$oModel->shopgoods_id,
						'shopgoodsgallery_url'=>$arrUploadgallerydata['shopgoods_img'],
						'shopgoodsgallery_thumburl'=>$arrUploadgallerydata['shopgoods_thumb'],
						'shopgoodsgallery_imgoriginal'=>$arrUploadgallerydata['shopgoods_originalimg'],
						'shopgoodsgallery_name'=>$arrUploadgallerydata['shopgoods_name'],
					);

					$oShopgoodsgallery=new ShopgoodsgalleryModel($arrSavedata);
					$oShopgoodsgallery->save(0);

					if($oShopgoodsgallery->isError()){
						$this->E($oShopgoodsgallery->getErrorMessage());
					}
				}
			}
		}
	}

	protected function aInsert($nId=null){
		
		// 更新商品属性值
		$this->update_attributevalue_($nId);
	}

	protected function strtotime_(){
		$_POST['shopgoods_promotestartdate']=strtotime($_POST['shopgoods_promotestartdate']);
		$_POST['shopgoods_promoteenddate']=strtotime($_POST['shopgoods_promoteenddate']);
	}
	
	public function showimg(){
		$sImgurl=trim(G::getGpc('imgurl','G'));
		
		if(empty($sImgurl)){
			$this->E('没有指定传递的图片');
		}
		
		$this->assign('sImgurl',$sImgurl);
		
		$this->display(Admin_Extend::template('shop','shopgoods/showimg'));
	}
	
	public function delete_gallery(){
		$nGalleryid=intval(G::getGpc('value','G'));
		
		if(empty($nGalleryid)){
			$this->E('你没有指定待删除商品图片ID');
		}
		
		$oShopgoodsgallery=ShopgoodsgalleryModel::F('shopgoodsgallery_id=?',$nGalleryid)->getOne();
		if(empty($oShopgoodsgallery['shopgoodsgallery_id'])){
			$this->E('你要删除商品图片不存在');
		}
		
		$sShopgoodsgalleryUrl=NEEDFORBUG_PATH.'/data/upload/app/shop/shopgoods/';
		foreach(array('shopgoodsgallery_url','shopgoodsgallery_thumburl','shopgoodsgallery_imgoriginal') as $sValue){
			if(is_file($sShopgoodsgalleryUrl.$sValue)){
				@unlink($sShopgoodsgalleryUrl.$sValue);
			}
		}
		
		$oShopgoodsgallery->destroy();
		
		$this->A(array('id'=>$nGalleryid),'删除商品图片成功');
	}
	
	protected function shopgoodstype_(){
		$arrShopgoodstypes=ShopgoodstypeModel::F()->getAll();
		
		$this->assign('arrShopgoodstypes',$arrShopgoodstypes);
	}
	
	public function get_attribute(){
		$nShopgoodsid=intval(G::getGpc('shopgoods_id','G'));
		$nShopgoodstypeid=intval(G::getGpc('shopgoodstype_id','G'));
		$nReturnmessage=intval(G::getGpc('return_message','G'));
		
		// 判断商品是否存在
		//$oShopgoods=ShopgoodsModel::F('shopgoods_id=?',$nShopgoodsid)->getOne();
		//if(empty($oShopgoods['shopgoods_id'])){
			//$this->E('你请求的商品不存在');
		//}
		
		$arrData=array();
		if($nShopgoodstypeid<1){
			$arrData['content']='';
		}else{
			$oShopgoodstype=ShopgoodstypeModel::F('shopgoodstype_id=?',$nShopgoodstypeid)->getOne();
			if(empty($oShopgoodstype['shopgoodstype_id'])){
				$this->E('你请求的商品类型不存在');
			}
			
			$arrShopattributes=ShopattributeModel::F('shopgoodstype_id=?',$nShopgoodstypeid)->getAll();
			if(!is_array($arrShopattributes)){
				$arrData['content']='';
			}else{
				$this->assign('arrShopattributes',$arrShopattributes);

				// 读取属性值
				$arrShopattributevalueData=array();

				if($nShopgoodsid>0){
					$arrShopattributevalues=ShopattributevalueModel::F('shopgoods_id',$nShopgoodsid)->getAll();
					if(is_array($arrShopattributevalues)){
						foreach($arrShopattributevalues as $oShopattributevalue){
							$arrShopattributevalueData[$oShopattributevalue['shopattribute_id']]=$oShopattributevalue;
						}
					}
				}

				$this->assign('arrShopattributevalueData',$arrShopattributevalueData);

				$sAttributecontent=$this->display(Admin_Extend::template('shop','shopgoods/attribute'),'','text/html',true);
				$arrData['content']=$sAttributecontent;
			}
		}
	
		$this->A($arrData,'加载商品属性成功',1,$nReturnmessage==1?1:0);
	}
	
	public function get_attributevalue($arrShopattributevalueData,$nShopattributeid,$nShopattributeinputtype){
		$sShopattributevalue='';

		if(isset($arrShopattributevalueData[$nShopattributeid])){
			$oShopattributevalue=$arrShopattributevalueData[$nShopattributeid];
			$sShopattributevalue=$oShopattributevalue->shopattribute_value;
		}
		
		if($nShopattributeinputtype=='number'){
			$sShopattributevalue=intval($sShopattributevalue);
		}
		
		if($nShopattributeinputtype=='selects'){
			$sShopattributevalue=unserialize($sShopattributevalue);
		}

		return $sShopattributevalue;
	}
	
	public function parser_select($sValue){
		$arrData=array();
		
		$arrValue=explode("\n",$sValue);
		if(is_array($arrValue)){
			foreach($arrValue as $sKey=>$sOption){
				$sOption=trim($sOption);
			
				if(strpos($sOption,'=')===FALSE){
					$sKey=$sOption;
				}else{
					$arrTemp=explode('=',$sOption);
					$sKey=trim($arrTemp[0]);
					$sOption=trim($arrTemp[1]);
				}
				
				$sKey=htmlspecialchars($sKey);
				
				$arrData[$sKey]=$sOption;
			}
		}
		
		return $arrData;
	}

	/*public function dateline($sType='Y',$oValue=false){
		$sDate='';
		if($oValue===false){
			$sDate=CURRENT_TIMESTAMP;
		}else{
			$sDate=$oValue->blog_dateline;
		}

		return date($sType,$sDate);
	}

	public function bAdd_(){
		//$oGroupcategory=Dyhb::instance('GroupcategoryModel');
		//$oGroupcategoryTree=$oGroupcategory->getGroupcategoryTree();

		//$this->assign('oGroupcategoryTree',$oGroupcategoryTree);
	}

	public function edit($sMode=null,$nId=null,$bDidplay=true){
		$nId=intval(G::getGpc('value','G'));

		$this->bAdd_();
		
		parent::edit('blog',$nId,false);
		$this->display(Admin_Extend::template('blog','blog/add'));
	}
	
	public function bEdit_(){
		$this->bAdd_();
	}
	
	public function add(){
		$this->bAdd_();
		
		$this->display(Admin_Extend::template('blog','blog/add'));
	}

	public function AInsertObject_($oModel){
		//$oModel->safeInput();

		$oModel->blog_dateline=$oModel->getDateline();
	}
	
	public function update($sModel=null,$nId=null){
		$nId=G::getGpc('value');
		
		parent::update('blog',$nId);
	}

	public function AUpdateObject_($oModel){
		//$oModel->safeInput();
	}
	
	public function insert($sModel=null,$nId=null){
		$nId=G::getGpc('value');
		
		parent::insert('blog',$nId);
	}

	protected function aInsert($nId=null){
		//$oGroup=Dyhb::instance('GroupModel');
		//$oGroup->afterInsert($nId,intval(G::getGpc('group_categoryid','P')));
	}

	public function bForeverdelete_(){
		$sId=G::getGpc('value','G');

		$arrIds=explode(',',$sId);
		foreach($arrIds as $nId){
			// 小组有帖子不能删除
			// wait to do

			// 删除小组的帖子分类
			GrouptopiccategoryModel::M()->deleteWhere(array('group_id'=>$nId));
		}
	}
	
	public function foreverdelete($sModel=null,$sId=null){
		$sId=G::getGpc('value');
		
		$this->bForeverdelete_();
		
		parent::foreverdelete('group',$sId);
	}
	
	public function input_change_ajax($sName=null){
		parent::input_change_ajax('group');
	}

	public function recommend(){
		$nId=intval(G::getGpc('value','G'));

		$oGroup=Dyhb::instance('GroupModel');
		$oGroup->recommend($nId,1);
		if($oGroup->isError()){
			$this->E($oGroup->getErrorMessage());
		}else{
			$this->S(Dyhb::L('推荐成功','__APP_ADMIN_LANG__@Controller/Group'));
		}
	}

	public function unrecommend(){
		$nId=intval(G::getGpc('value','G'));

		$oGroup=Dyhb::instance('GroupModel');
		$oGroup->recommend($nId,0);
		if($oGroup->isError()){
			$this->E($oGroup->getErrorMessage());
		}else{
			$this->S(Dyhb::L('取消推荐成功','__APP_ADMIN_LANG__@Controller/Group'));
		}
	}

	public function upuser(){
		$nId=intval(G::getGpc('value','G'));

		if(!empty($nId)){
			$oGroup=Dyhb::instance('GroupuserModel');
			$oGroup->userToGroup($nId);
			$this->S(Dyhb::L('用户推送成功','__APP_ADMIN_LANG__@Controller/Group'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function icon(){
		$nId=intval(G::getGpc('value','G'));
		
		$oGroup=GroupModel::F('group_id=?',$nId)->query();
		if(!empty($oGroup['group_id'])){
			$this->assign('oGroup',$oGroup);
			
			// 取得ICON
			$sGroupIcon=Group_Extend::getGroupIcon($oGroup['group_icon']);
			$this->assign('sGroupIcon',$sGroupIcon);
			
			Core_Extend::loadCache('group_option');
			$arrOptionData=$GLOBALS['_cache_']['group_option'];
			$this->assign('nUploadSize',Core_Extend::getUploadSize($arrOptionData['group_icon_uploadfile_maxsize']));
			
			$this->display(Admin_Extend::template('group','group/icon'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function icon_add(){
		$nId=intval(G::getGpc('value','P'));
		
		$oGroup=GroupModel::F('group_id=?',$nId)->query();
		if(!empty($oGroup['group_id'])){
			require_once(Core_Extend::includeFile('function/Upload_Extend'));
			try{
				$sPhotoDir=Upload_Extend::uploadIcon('group');
			
				$oGroup->group_icon=$sPhotoDir;
				$oGroup->save(0,'update');
				if($oGroup->isError()){
					$this->E($oGroup->getErrorMessage());
				}
			
				$this->S(Dyhb::L('图标设置成功','__APP_ADMIN_LANG__@Controller/Group'));
			}catch(Exception $e){
				$this->E($e->getMessage());
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function delete_icon(){
		$nId=intval(G::getGpc('value','G'));

		$oGroup=GroupModel::F('group_id=?',$nId)->query();
		if(!empty($oGroup['group_id'])){
			if(!empty($oGroup['group_icon'])){
				require_once(Core_Extend::includeFile('function/Upload_Extend'));
				Upload_Extend::deleteIcon('group',$oGroup['group_icon']);
			
				$oGroup->group_icon='';
				$oGroup->save(0,'update');
				if($oGroup->isError()){
					$this->E($oGroup->getErrorMessage());
				}
				
				$this->S(Dyhb::L('图标删除成功','__APP_ADMIN_LANG__@Controller/Group'));
			}else{
				$this->E(Dyhb::L('图标不存在','__APP_ADMIN_LANG__@Controller/Group'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function groupcategory(){
		$nId=intval(G::getGpc('value','G'));
		
		$oGroup=GroupModel::F('group_id=?',$nId)->query();
		if(!empty($oGroup['group_id'])){
			$this->assign('oGroup',$oGroup);
			
			$this->display(Admin_Extend::template('group','group/groupcategory'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function delete_category(){
		$nId=intval(G::getGpc('value','G'));
		$nCategoryId=intval(G::getGpc('category_id','G'));
		
		$oGroupcategory=GroupcategoryModel::F('groupcategory_id=?',$nCategoryId)->query();
		if(!empty($oGroupcategory['groupcategory_id']) || $nCategoryId){
			$oGroup=Dyhb::instance('GroupModel');
			$oGroup->afterDelete($nId,$nCategoryId);
			
			$this->S(Dyhb::L('删除群组分类成功','__APP_ADMIN_LANG__@Controller/Group'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function add_category(){
		$nId=intval(G::getGpc('value','G'));
		
		$oGroup=GroupModel::F('group_id=?',$nId)->query();
		if(!empty($oGroup['group_id'])){
			$this->bAdd_();
			
			$this->assign('nValue',$nId);
			
			// 获取当前分类
			$arrCategorys=array();
			$arrTemps=$oGroup->groupcategory;
			if(is_array($arrTemps)){
				foreach($arrTemps as $oTemp){
					$arrCategorys[]=$oTemp['groupcategory_id'];
				}
				unset($arrTemps);
			}
			$this->assign('arrCategorys',$arrCategorys);
			
			$this->display(Admin_Extend::template('group','group/add_category'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function add_category_id(){
		$nId=intval(G::getGpc('value'));
		$nCategoryId=intval(G::getGpc('category_id'));
		
		$oGroupcategory=GroupcategoryModel::F('groupcategory_id=?',$nCategoryId)->query();
		if(!empty($oGroupcategory['groupcategory_id']) || $nCategoryId){
			$oExistGroupcategoryindex=GroupcategoryindexModel::F('group_id=? AND groupcategory_id=?',$nId,$nCategoryId)->query();
			if(!empty($oExistGroupcategoryindex['group_id'])){
				$this->E(Dyhb::L('群组分类已经存在','__APP_ADMIN_LANG__@Controller/Group'));
			}
			
			$oGroup=Dyhb::instance('GroupModel');
			$oGroup->afterInsert($nId,$nCategoryId);
				
			$this->S(Dyhb::L('添加群组分类成功','__APP_ADMIN_LANG__@Controller/Group'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function topiccategory(){
		$nId=intval(G::getGpc('value'));
		
		$oGroup=GroupModel::F('group_id=?',$nId)->query();
		if(!empty($oGroup['group_id'])){
			$arrGrouptopiccategorys=GrouptopiccategoryModel::F('group_id=?',$nId)->getAll();
			$this->assign('arrGrouptopiccategorys',$arrGrouptopiccategorys);
			
			$this->assign('nValue',$nId);
			
			$this->display(Admin_Extend::template('group','group/topiccategory'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function add_topiccategory(){
		$nId=intval(G::getGpc('value'));
		
		$oGroup=GroupModel::F('group_id=?',$nId)->query();
		if(!empty($oGroup['group_id'])){
			$oGrouptopiccategory=Dyhb::instance('GrouptopiccategoryModel');
			$oGrouptopiccategory->insertGroupcategory($nId);

			if($oGrouptopiccategory->isError()){
				$this->E($oGrouptopiccategory->getErrorMessage());
			}else{
				$this->S(Dyhb::L('添加帖子分类成功','__APP_ADMIN_LANG__@Controller/Group'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function delete_topic_category(){
		$nId=intval(G::getGpc('value'));
		$nGroupId=intval(G::getGpc('group_id'));
		
		$oGroupcategory=GrouptopiccategoryModel::F('grouptopiccategory_id=? AND group_id=?',$nId,$nGroupId)->query();
		if(!empty($oGroupcategory['grouptopiccategory_id'])){
			GrouptopiccategoryModel::M()->deleteWhere(array('grouptopiccategory_id'=>$nId));
			
			$this->S(Dyhb::L('删除帖子分类成功','__APP_ADMIN_LANG__@Controller/Group'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function update_topic_category(){
		$nId=intval(G::getGpc('value'));
		$nGroupId=intval(G::getGpc('group_id'));
		
		$oGroupcategory=GrouptopiccategoryModel::F('grouptopiccategory_id=? AND group_id=?',$nId,$nGroupId)->query();
		if(!empty($oGroupcategory['grouptopiccategory_id'])){
			$this->assign('oGroupcategory',$oGroupcategory);
			$this->assign('nValue',$nGroupId);
			$this->assign('nCategoryId',$nId);
			
			$this->display(Admin_Extend::template('group','group/update_topic_category'));
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}
	
	public function update_topiccategory(){
		$nId=intval(G::getGpc('value'));
		
		$oGroupcategory=GrouptopiccategoryModel::F('grouptopiccategory_id=?',$nId)->order('grouptopiccategory_sort DESC')->query();
		if(!empty($oGroupcategory['grouptopiccategory_id'])){
			$oGroupcategory->save(0,'update');
			
			if($oGroupcategory->isError()){
				$this->E($oGroupcategory->getErrorMessage());
			}else{
				$this->S(Dyhb::L('更新帖子分类成功','__APP_ADMIN_LANG__@Controller/Group'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}*/

}
