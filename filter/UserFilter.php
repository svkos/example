<?php

class UserFilter implements FilterInterface {
	private $_iduser;

	public function load($param){
		if(isset($param['iduser']))
			$this->_iduser = $param['iduser'];
	}
	
	public function getSqlPart(){
		return $this->_iduser!=0 ? 'AND `t`.idusers='.$this->_iduser : '';
	}
	
	public function getLinkPart(){
		return $this->_iduser!=0 ? '&iduser='.$this->_iduser : '';
	}
	
	public function render(){
		Yii::app()->controller->renderPartial('//statistics/filters/user', array('iduser'=>$this->_iduser));
	}
}