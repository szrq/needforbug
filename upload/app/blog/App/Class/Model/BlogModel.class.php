<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   博客模型($)*/

!defined('DYHB_PATH') && exit;

class BlogModel extends CommonModel{

	static public function init__(){
		return array(
			'table_name'=>'blog',
			'props'=>array(
				'blog_id'=>array('readonly'=>true),
			),
			'attr_protected'=>'blog_id',
		);
	}

	static function F(){
		$arrArgs=func_get_args();
		return ModelMeta::instance(__CLASS__)->findByArgs($arrArgs);
	}

	static function M(){
		return ModelMeta::instance(__CLASS__);
	}

	public function getDateline(){
		$nId=intval(G::getGpc('value','P'));

		$nNewyear=intval(G::getGpc('newyear','P'));
		$nNewmonth=intval(G::getGpc('newmonth','P'));
		$nNewday=intval(G::getGpc('newday','P'));
		$nNewhour=intval(G::getGpc('newhour','P'));
		$nNewmin=intval(G::getGpc('newmin','P'));
		$nNewsec=intval(G::getGpc('newsec','P'));

		//if($nId){
			if(checkdate($nNewmonth,$nNewday,$nNewyear)){
				if(substr(PHP_OS,0,3)=='WIN' && $nNewyear<1970){
					return CURRENT_TIMESTAMP;
				}else{
					return mktime($nNewhour,$nNewmin,$nNewsec,$nNewmonth,$nNewday,$nNewyear);
				}
			}else{
				return CURRENT_TIMESTAMP;
			}
		//}else{
			//return CURRENT_TIMESTAMP;
		//}
	}

}
