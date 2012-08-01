<?php
/* [DoYouHaoBaby!] (C)Dianniu From 2010.
   PHP 队列和栈抽象类($)*/

!defined('DYHB_PATH') && exit;

abstract class StackQueue{

	protected $_arrElements=array();
	private $_arrTypes=array();

	public function __construct(){
		$this->_arrTypes=func_get_args();
	}

	public function remove($nIdx){
		unset($this->_arrElements[$nIdx]);
	}

	public function getLength(){
		return count($this->_arrElements);
	}

	public function isEmpty(){
		return ($this->getLength()==0);
	}

	public function isValidType($Item){
		if(!count($this->_arrTypes)){
			return true;
		}

		return call_user_func_array(array('G','isThese'),array($Item,$this->_arrTypes));
	}

	abstract public function in($Item);

	abstract public function out();

}
