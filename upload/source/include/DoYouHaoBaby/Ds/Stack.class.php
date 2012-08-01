<?php
/* [DoYouHaoBaby!] (C)Dianniu From 2010.
   栈，实现后进先出的容器($)*/

!defined('DYHB_PATH') && exit;

class Stack extends StackQueue{

	public function in($Item){
		if(!$this->isValidType($Item)){
			Dyhb::E('Parameter $Item is invalid and can not add to stack!');
		}

		$this->_arrElements[]=&$Item;
	}

	public function out(){
		if(!$this->getLength()){
			return null;
		}

		return array_pop($this->_arrElements);
	}

	public function peek(){
		return reset($this->_arrElements);
	}

}
