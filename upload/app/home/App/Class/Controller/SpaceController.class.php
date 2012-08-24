<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   个人空间显示($)*/

!defined('DYHB_PATH') && exit;

class SpaceController extends InitController{

	public function index(){
		Core_Extend::doControllerAction('Space@Base','index');
	}

	public function rating(){
		Core_Extend::doControllerAction('Space@Rating','index');
	}

	public function avatar(){
		Core_Extend::doControllerAction('Space@Avatar','index');
	}

}
