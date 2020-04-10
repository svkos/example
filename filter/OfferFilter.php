<?php

class OfferFilter implements FilterInterface {
	private $_idcompanie;
	private $_idplatform;
	private $_idspacer;
	private $_countproduct;
	
	public function load($param){
		if(isset($param['idcompanie']))
			$this->_idcompanie = $param['idcompanie'];
		if(isset($param['idplatform']))
			$this->_idplatform = $param['idplatform'];
		if(isset($param['idspacer']))
			$this->_idspacer = $param['idspacer'];
		if(isset($param['countproduct']))
			$this->_countproduct = $param['countproduct'];
	}
	
	public function getSqlPart(){
		if ($this->_idcompanie != 0)
			$filter .= 'AND `t`.idcompanies='.$this->_idcompanie.' '; 
		if ($this->_idplatform != 0)
			$filter .= 'AND `t`.idplatforms='.$this->_idplatform.' '; 
		if ($this->_idspacer != 0)
			$filter .= 'AND `t`.idspacers='.$this->_idspacer.' '; 
		if ($this->_countproduct != 0)
			$filter .= 'AND senokos.products.count='.$this->_countproduct.' '; 
		return $filter;
	}
	
	public function getLinkPart(){
		if ($this->_idcompanie != 0)
			$filterLink .= '&idcompanie='.$this->_idcompanie;
		if ($this->_idplatform != 0)
			$filterLink .= '&idplatform='.$this->_idplatform;
		if ($this->_idspacer != 0)
			$filterLink .= '&idspacer='.$this->_idspacer;
		if ($this->_countproduct != 0)
			$filterLink .= '&countproduct='.$this->_countproduct;
			
		return $filterLink;
	}
	
	public function render(){
		Yii::app()->controller->renderPartial('//statistics/filters/offer',array(
										  'idcompanie'  =>$this->_idcompanie,
										  'idplatform'  =>$this->_idplatform,
										  'idspacer'    =>$this->_idspacer,
										  'countproduct'=>$this->_countproduct));
	}
}