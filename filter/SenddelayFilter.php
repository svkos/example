<?php

class SenddelayFilter implements FilterInterface {
	private $_senddelay;
	
	public function load($param){
		if(isset($param['senddelay']))
			$this->_senddelay = $param['senddelay'];
	}
	public function getSqlPart(){
		return $this->_senddelay ? "AND senddelay is not null" : '';
	}
	
	public function getLinkPart(){
		return $this->_senddelay ? "&senddelay=1" : '';
	}
	public function render(){
		Yii::app()->controller->renderPartial('//statistics/filters/senddelay',array('senddelay'=>$this->_senddelay));
	}
}