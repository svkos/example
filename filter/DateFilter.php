<?php

class DateFilter implements FilterInterface {
	private $_date_from;
	private $_date_to;
	private static $_instance = null;
	
	function __construct(){
		$this->_date_from = date("Y-m-d");
		$this->_date_to   = date("Y-m-d");
	}
	
	public function load($param){
		if(isset($param['date_from']))
			$this->_date_from = $param['date_from'];
		if(isset($param['date_to']))
			$this->_date_to = $param['date_to'];
	}
	
	public function getSqlPart(){
		return '(created BETWEEN "'.$this->_date_from.'" AND "'.$this->_date_to.' 23:59:59")';
	}
	
	public function getLinkPart(){
		return $this->_date_from==$this->_date_to ? '&date_from='.$this->_date_from : '&date_from='.$this->_date_from.'&date_to='.$this->_date_to;
	}
	public function render(){
		Yii::app()->controller->renderPartial('//statistics/filters/date',array(
											  'date_from'=>$this->_date_from,
											  'date_to'=>$this->_date_to));
	}
}