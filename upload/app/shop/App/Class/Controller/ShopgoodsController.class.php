<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商城商品控制器($)*/

!defined('DYHB_PATH') && exit;

class ShopgoodsController extends InitController{

	public function view(){
		$nId=intval(G::getGpc('id','G'));
		
		if(empty($nId)){
			$this->E('你没有指定查看商品的ID');
		}
		
		$oShopgoods=ShopgoodsModel::F('shopgoods_id=?',$nId)->getOne();
		if(empty($oShopgoods['shopgoods_id'])){
			$this->E('你查看的商品不存在或者已经下架');
		}
		
		// 取得商品相册
		$arrShopgoodsgallerysDatas=array();
		
		if($oShopgoods['shopgoods_originalimg']){
			$arrShopgoodsgallerysDatas[]=array(
				'name'=>'',
				'description'=>'',
				'imgoriginal'=>$oShopgoods['shopgoods_originalimg'],
				'thumburl'=>$oShopgoods['shopgoods_thumb'],
				'imageurl'=>$oShopgoods['shopgoods_img'],
				'create_dateline'=>'',
			);
		}
		
		$arrShopgoodsgallerys=ShopgoodsgalleryModel::F('shopgoods_id=?',$nId)->order('shopgoodsgallery_id DESC')->getAll();
		if(is_array($arrShopgoodsgallerys)){
			foreach($arrShopgoodsgallerys as $oShopgoodsgallery){
				$arrShopgoodsgallerysDatas[]=array(
					'name'=>$oShopgoodsgallery['shopgoodsgallery_name'],
					'description'=>$oShopgoodsgallery['shopgoodsgallery_description'],
					'imgoriginal'=>$oShopgoodsgallery['shopgoodsgallery_imgoriginal'],
					'thumburl'=>$oShopgoodsgallery['shopgoodsgallery_thumburl'],
					'imageurl'=>$oShopgoodsgallery['shopgoodsgallery_url'],
					'create_dateline'=>$oShopgoodsgallery['create_dateline'],
				);
			}
		}
		
		$this->assign('arrShopgoodsgallerysDatas',$arrShopgoodsgallerysDatas);

		// 商品属性及其值
		$arrShopattributevaluesData=Shopgoods_Extend::getShopattributevalue($oShopgoods);
		$this->assign('arrShopattributevaluesData',$arrShopattributevaluesData);

		// 读取商品评价
		$arrWhere=array(
			'shopgoodscomment_status'=>1,
			'shopgoods_id'=>$nId,
		);

		$nCommentpage=intval(G::getGpc('comment_page','G'));
		if($nCommentpage<1){
			$nCommentpage=1;
		}

		$nTotalRecord=ShopgoodscommentModel::F()->where($arrWhere)->all()->getCounts();
		$oPage=Page::RUN($nTotalRecord,10,$nCommentpage);
		$arrShopgoodscomments=ShopgoodscommentModel::F()->where($arrWhere)->order('create_dateline DESC')->limit($oPage->returnPageStart(),10)->getAll();

		$this->assign('arrShopgoodscomments',$arrShopgoodscomments);
		$this->assign('sPageNavbar',$oPage->P('paginationcomment'.'@pagenav','span','current','disabled','comment_page'));
		$this->assign('nTotalShopgoodscomment',$nTotalRecord);

		$this->assign('oShopgoods',$oShopgoods);

		$this->display('shopgoods+view');
	}

	public function add_comment(){
		$oShopgoodscomment=new ShopgoodscommentModel();
		$oShopgoodscomment->save(0);

		if($oShopgoodscomment->isError()){
			$this->E($oShopgoodscomment->getErrorMessage());
		}
	
		$this->S('发布商品评论成功');
	}

}
