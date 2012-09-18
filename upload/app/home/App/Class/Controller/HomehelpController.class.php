<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   前台帮助信息($)*/

!defined('DYHB_PATH') && exit;

class HomehelpController extends InitController{

	public function index(){
		$arrWhere=array();
		
		$nId=intval(G::getGpc('cid','G'));
		if(empty($nId)){
			$nId=0;
		}else{
			$arrWhere['homehelpcategory_id']=$nId;
			$this->_oHomehelpcategory=HomehelpcategoryModel::F('homehelpcategory_id=?',$nId)->getOne();
		}

		Core_Extend::loadCache('home_option');
		$arrOptionData=$GLOBALS['_cache_']['home_option'];

		$arrWhere['homehelp_status']=1;
		$nTotalRecord=HomehelpModel::F()->where($arrWhere)->all()->getCounts();

		$oPage=Page::RUN($nTotalRecord,$arrOptionData['homehelp_list_num'],G::getGpc('page','G'));

		$arrHomehelps=HomehelpModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),$arrOptionData['homehelp_list_num'])->getAll();
		$this->assign('arrHomehelps',$arrHomehelps);
		$this->assign('sPageNavbar',$oPage->P('pagination','li','active'));
		$this->assign('nCid',$nId);

		$this->homehelpcategory_();

		$this->display('homehelp+list');
	}

	public $_oHomehelpcategory=null;

	public function index_title_(){
		return '帮助中心'.($this->_oHomehelpcategory?' - '.$this->_oHomehelpcategory['homehelpcategory_name']:'');
	}

	public function index_keywords_(){
		return $this->_oHomehelpcategory?$this->_oHomehelpcategory['homehelpcategory_name']:'帮助中心';
	}

	public function index_description_(){
		return $this->index_keywords_();
	}

	public function show(){
		$nId=intval(G::getGpc('id','G'));

		if(empty($nId)){
			$this->E(Dyhb::L('你没有指定帮助ID','Controller/Homehelp'));
		}

		$oHomehelp=HomehelpModel::F('homehelp_id=?',$nId)->getOne();
		if(!empty($oHomehelp['homehelp_id'])){
			$this->assign('oHomehelp',$oHomehelp);
			$this->assign('sContent',Core_Extend::replaceSiteVar($oHomehelp['homehelp_content']));

			$this->homehelpcategory_();

			// 更新点击量
			$oHomehelp->homehelp_viewnum=$oHomehelp->homehelp_viewnum+1;
			$oHomehelp->setAutofill(false);
			$oHomehelp->save(0,'update');

			$this->_oHomehelp=$oHomehelp;

			if($oHomehelp->isError()){
				$this->E($oHomehelp->getErrorMessage());
			}
			
			$this->display('homehelp+show');
		}else{
			$this->E(Dyhb::L('你指定的帮助不存在','Controller/Homehelp'));
		}
	}

	public $_oHomehelp=null;

	public function show_title_(){
		return $this->_oHomehelp['homehelp_title'].($this->_oHomehelp->homehelpcategory_id>0?' - '.$this->_oHomehelp->homehelpcategory->homehelpcategory_name:'');
	}

	public function show_description_(){
		return $this->_oHomehelp['homehelp_content'];
	}

	public function show_keywords_(){
		return $this->_oHomehelp['homehelp_title'];
	}

	public function homehelpcategory_(){
		$oHomehelpcategory=Dyhb::instance('HomehelpcategoryModel');

		$arrHomehelpcategorys=$oHomehelpcategory->getHomehelpcategory();
		$this->assign('arrHomehelpcategorys',$arrHomehelpcategorys);
	}

}
