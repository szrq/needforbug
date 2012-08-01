<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   短消息管理控制器($)*/

!defined('DYHB_PATH') && exit;

require_once(Core_Extend::includeFile('function/Pm_Extend'));

class PmController extends InitController{

	public function filter_(&$arrMap){
		$arrMap['pm_msgfrom']=array('like',"%".G::getGpc('pm_msgfrom')."%");

		$sType=trim(G::getGpc('type'));
		if(!empty($sType)){
			$arrMap['pm_type']=$sType;
		}

		$this->assign('sType',$sType);
	}

	public function bForeverdelete_(){
		$sId=G::getGpc('id','G');

		$arrIds=explode(',',$sId);
		foreach($arrIds as $nId){
			$arrPmSystems=SystempmModel::F()->all()->query();

			foreach($arrPmSystems as $oPmSystem){
				$arrReadIds=unserialize($oPmSystem['systempm_readids']);
				if(in_array($nId,$arrReadIds)){
					foreach($arrReadIds as $nKey=>$nReadIds){
						if($nReadIds==$nId){
							unset($arrReadIds[$nKey]);
						}
					}
				}

				if(empty($arrReadIds)){
					$oDb=Db::RUN();

					$sSql="DELETE FROM ".SystempmModel::F()->query()->getTablePrefix()."systempm WHERE `user_id`=".$oPmSystem['user_id'];
					$oDb->query($sSql);
				}else{
					$oPmSystem->systempm_readids=serialize($arrReadIds);

					$oPmSystem->save(0,'update');
					if($oPmSystem->isError()){
						$this->E($oPmSystem->getErrorMessage());
					}
				}
			}
		}
	}

	public function show(){
		$nId=G::getGpc('id','G');

		if(!empty($nId)){
			$oModel=PmModel::F('pm_id=?',$nId)->query();

			if(!empty($oModel->pm_id)){
				$this->assign('oValue',$oModel);
				$this->assign('nId',$nId);
				
				$this->display('pm+show');
			}else{
				$this->E(Dyhb::L('数据库中并不存在该项，或许它已经被删除','Controller/Common'));
			}
		}else{
			$this->E(Dyhb::L('操作项不存在','Controller/Common'));
		}
	}

}
