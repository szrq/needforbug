<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商品类型属性控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入商城模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/shop/App/Class/Model');

class ShopattributeController extends InitController{

	public function filter_(&$arrMap){
		//$arrMap['group_name']=array('like','%'.G::getGpc('group_name').'%');
		
		// 取得分类父亲ID
		/*$nPid=intval(G::getGpc('pid','G'));
		if(empty($nPid)){
			$nPid=0;
		}
		$arrMap['shopcategory_parentid']=$nPid;
		
		if($nPid>0){
			$oParentShopcategory=ShopcategoryModel::F('shopcategory_id=?',$nPid)->getOne();
			if(!empty($oParentShopcategory['shopcategory_id'])){
				$this->assign('oParentShopcategory',$oParentShopcategory);
			}
		}*/
		
		//$nUid=intval(G::getGpc('uid','G'));
		//if($nUid){
			//$arrMap['user_id']=$nUid;
		//}
		
		$nShopgoodstype=intval(G::getGpc('tid','G'));
		if(empty($nShopgoodstype)){
			$this->E('商品类型不能为空');
		}
		
		$oShopgoodstype=ShopgoodstypeModel::F('shopgoodstype_id=?',$nShopgoodstype)->getOne();
		if(empty($oShopgoodstype['shopgoodstype_id'])){
			$this->E('商品类型不存在');
		}
		
		$this->assign('nShopgoodstype',$nShopgoodstype);
		$this->assign('oShopgoodstype',$oShopgoodstype);
		
		$arrMap['shopgoodstype_id']=$nShopgoodstype;
	}

	public function index($sModel=null,$bDisplay=true){
		parent::index('shopattribute',false);

		$this->display(Admin_Extend::template('shop','shopattribute/index'));
	}

	public function add(){
		$nShopgoodstype=intval(G::getGpc('tid','G'));
		if(empty($nShopgoodstype)){
			$this->E('商品类型不能为空');
		}
		
		$this->assign('nShopgoodstype',$nShopgoodstype);
		
		$this->display(Admin_Extend::template('shop','shopattribute/add'));
	}
	
	public function insert($sModel=null,$nId=null){
		$nId=G::getGpc('value');
	
		parent::insert('shopattribute',$nId);
	}
	
	public function bAdd_(){
		$this->get_shopcategorytree_();
	}
	
	public function get_shopcategorytree_(){
		$oShopcategory=Dyhb::instance('ShopcategoryModel');
		$oShopcategoryTree=$oShopcategory->getShopcategoryTree();
		
		$this->assign('oShopcategoryTree',$oShopcategoryTree);
	}
	
	public function edit($sMode=null,$nId=null,$bDidplay=true){
		$nId=intval(G::getGpc('value','G'));
	
		$this->bAdd_();
	
		parent::edit('shopattribute',$nId,false);
		$this->display(Admin_Extend::template('shop','shopattribute/add'));
	}
	
	public function update($sModel=null,$nId=null){
		$nId=G::getGpc('value');
	
		parent::update('shopattribute',$nId);
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
