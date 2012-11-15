<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   商品支付方式控制器($)*/

!defined('DYHB_PATH') && exit;

/** 导入商城模型 */
Dyhb::import(NEEDFORBUG_PATH.'/app/shop/App/Class/Model');

class ShoppaymentController extends InitController{

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
	}

	public function index($sModel=null,$bDisplay=true){
		//parent::index('shoppayment',false);

		// 数据库中记录数量
		$arrPaylist=array();

		$arrPayments=ShoppaymentModel::F('shoppayment_status=?',1)->order('shoppayment_order DESC')->getAll();
		if(is_array($arrPayments)){
			foreach($arrPayments as $oPayment){
				$arrPlaylist[$oPayment['shoppayment_code']]=$oPayment;
			}
		}

		$arrWarningmessage=array();

		// 读取支付方式中的配置数据
		$arrPaymentlistData=array();

		$sParmentpath=NEEDFORBUG_PATH.'/app/shop/App/Class/Extension/Payment';
		
		$arrPaymentdir=G::listDir($sParmentpath);
		if(is_array($arrPaymentdir)){
			foreach($arrPaymentdir as $sPaymentdir){
				$sConfigfile=$sParmentpath.'/'.$sPaymentdir.'/Config.php';

				if(!is_file($sConfigfile)){
					$arrWarningmessage[]=sprintf('支付方式 %s 配置文件不存在',$sPaymentdir);
					continue;
				}else{
					$sPaymentcode=$sPaymentdir;

					$arrPaymentlistData[$sPaymentcode]=(array)(include $sConfigfile);

					if(isset($arrPlaylist[$sPaymentcode])){
						$arrPaymentlistData[$sPaymentcode]=array_merge($arrPaymentlistData[$sPaymentcode],$arrPlaylist[$sPaymentcode]->toArray());
						$arrPaymentlistData[$sPaymentcode]['install']='1';
					}else{
						if(!isset($arrPaymentlistData[$sPaymentcode]['shoppayment_fee'])){
							$arrPaymentlistData[$sPaymentcode]['shoppayment_fee']=0;
						}
						$arrPaymentlistData[$sPaymentcode]['install']='0';
					}
				}
			}
		}

		$this->assign('arrPaymentlistData',$arrPaymentlistData);

		$this->display(Admin_Extend::template('shop','shoppayment/index'));
	}

	public function install(){
		$sCode=trim(G::getGpc('code','G'));

		if(empty($sCode)){
			$this->E('你没有指定要安装支付方式');
		}

		// 查询是否已经安装了支付方式
		$oTryshoppayment=ShoppaymentModel::F('shoppayment_code=?',$sCode)->getOne();
		if(!empty($oTryshoppayment['shoppayment_id'])){
			$this->E(sprintf('你安装的支付方式 %s 已经存在或者支付方式代码和已经有的重复',$sCode));
		}

		// 保存支付方式数据
		$sParmentpath=NEEDFORBUG_PATH.'/app/shop/App/Class/Extension/Payment';

		$sConfigfile=$sParmentpath.'/'.$sCode.'/Config.php';
		if(!is_file($sConfigfile)){
			$this->E(sprintf('支付方式 %s 配置文件不存在',$sPaymentdir));
		}else{
			$arrPaymentData=(array)(include $sConfigfile);
			if(!isset($arrPaymentData['shoppayment_fee'])){
				$arrPaymentData['shoppayment_fee']=0;
			}

			$this->assign('arrPaymentData',$arrPaymentData);

			$this->display(Admin_Extend::template('shop','shoppayment/install'));
		}
	}

}
