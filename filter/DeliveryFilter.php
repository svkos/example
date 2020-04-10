<?php

class DeliveryFilter implements FilterInterface {
	private $_idcarrier;
	
	function __construct(){
		$this->_idcarrier = 0;
	}
	private function _ARtoSql($models){
		foreach($models as $model){
			$sql .= 'idcarriers='.$model->idcarriers;
			if($model != end($models))
				$sql .= ' OR ';
		}
		return $sql;
	}
	
	public function load($param){
		if(isset($param['idcarrier']))
			$this->_idcarrier = $param['idcarrier'];
	}
	
	public function getSqlPart(){
		if ($this->_idcarrier!='all') {
			if(!is_numeric($this->_idcarrier))
				return 'AND ('.$this->_ARtoSql(Carriers::getARByName($this->_idcarrier)).')';
			else
				return 'AND idcarriers='.$this->_idcarrier;
		}
	}
	
	public function getLinkPart(){
		return $this->_idcarrier!='all' ? '&idcarrier='.$this->_idcarrier : '';
	}
	public function render(){
		Yii::app()->controller->renderPartial('//statistics/filters/delivery', array('idcarrier'=>$this->_idcarrier));
	}
}