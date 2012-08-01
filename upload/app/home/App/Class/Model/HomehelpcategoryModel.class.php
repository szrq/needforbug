<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   帮组分类模型($)*/

!defined('DYHB_PATH') && exit;

class HomehelpcategoryModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'homehelpcategory',
			'props'=>array(
				'homehelpcategory_id'=>array('readonly'=>true),
				'homehelp'=>array(Db::HAS_MANY=>'HomehelpModel','source_key'=>'homehelpcategory_id','target_key'=>'homehelp_id'),
			),
			'attr_protected'=>'homehelpcategory_id',
			'check'=>array(
				'homehelpcategory_name'=>array(
					array('require',Dyhb::L('帮助分类不能为空','__APP_ADMIN_LANG__@Model/Homehelpcategory')),
					array('max_length',32,Dyhb::L('帮助分类不能超过32个字符','__APP_ADMIN_LANG__@Model/Homehelpcategory')),
					array('homehelpcategoryName',Dyhb::L('帮助分类名字已经存在','__APP_ADMIN_LANG__@Model/Homehelpcategory'),'condition'=>'must','extend'=>'callback'),
				),
				'homehelpcategory_sort'=>array(
					array('number',Dyhb::L('序号只能是数字','__APP_ADMIN_LANG__@Model/Homehelpcategory'),'condition'=>'notempty','extend'=>'regex'),
				)
			),
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function homehelpcategoryName(){
		$nId=G::getGpc('value','P');
		$sHomehelpcategoryName=G::getGpc('homehelpcategory_name','P');
		$sHomehelpcategoryInfo='';

		if($nId){
			$arrHomehelpcategory=self::F('homehelpcategory_id=?',$nId)->asArray()->getOne();
			$sHomehelpcategoryInfo=trim($arrHomehelpcategory['homehelpcategory_name']);
		}

		if($sHomehelpcategoryName!=$sHomehelpcategoryInfo){
			$arrResult=self::F()->getByhomehelpcategory_name($sHomehelpcategoryName)->toArray();
			if(!empty($arrResult['homehelpcategory_id'])){
				return false;
			}else{
				return true;
			}
		}

		return true;
	}

	public function getHomehelpcategory(){
		return self::F()->order('homehelpcategory_id ASC,homehelpcategory_sort DESC')->all()->query();
	}
	
	public function safeInput(){
		$_POST['homehelpcategory_name']=G::html($_POST['homehelpcategory_name']);
	}

	public function homehelpcategoryCount($nHomehelpcategoryId){
		if(empty($nHomehelpcategoryId)){
			return;
		}

		// 更新站点帮组分类的数量
		$nHomehelpNums=HomehelpModel::F('homehelpcategory_id=?',$nHomehelpcategoryId)->all()->getCounts();
		$oHomehelpcategory=HomehelpcategoryModel::F('homehelpcategory_id=?',$nHomehelpcategoryId)->query();
		$oHomehelpcategory->homehelpcategory_count=$nHomehelpNums;
		$oHomehelpcategory->save(0,'update');
	}

}
