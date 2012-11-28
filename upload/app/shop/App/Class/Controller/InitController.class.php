<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   公用控制器($)*/

!defined('DYHB_PATH') && exit;

class InitController extends GlobalinitController{

	public function init__(){
		parent::init__();

		Core_Extend::loadCache('shop_article');

	}

}
