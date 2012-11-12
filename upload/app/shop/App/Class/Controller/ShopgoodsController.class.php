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
		//G::dump($arrShopgoodsgallerysDatas);
		$this->assign('oShopgoods',$oShopgoods);
		$this->assign('arrShopgoodsgallerysDatas',$arrShopgoodsgallerysDatas);
		
		$this->display('shopgoods+view');
	}

}
