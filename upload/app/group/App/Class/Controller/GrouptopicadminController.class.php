<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   群组操作控制器($)*/

!defined('DYHB_PATH') && exit;

class GrouptopicadminController extends InitController{

	public function moderate(){
		$nGroupid=trim(G::getGpc('groupid','G'));
		$arrGrouptopics=G::getGpc('moderate','G');
		$nGrouptopicid=intval(G::getGpc('from','G'));
		
		$this->display('grouptopicadmin+deletetopic');
	}

}
