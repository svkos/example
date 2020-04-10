<?php

class StreamFilter implements FilterInterface {
	private $_idstream;
	
	public function load($param){
		if(isset($param['idstream']))
			$this->_idstream = $param['idstream'];
	}
	
	public function getSqlPart(){
		return $this->_idstream ? 'AND stream="'.$this->_idstream.'"' : '';
	}
	
	public function getLinkPart(){
		return $this->_idstream ? '&stream='.$this->_idstream : '';
	}
	
	public function render(){
		if(Yii::app()->user->id == 1)
			Yii::app()->controller->renderPartial('//statistics/filters/stream',array('idstream'  =>$this->_idstream));
		else
			Yii::app()->controller->renderPartial('//statistics/filters/streamUsers',array('idstream'  =>$this->_idstream));
	}
}