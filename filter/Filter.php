<?php

class Filter{
	private $_classes=array();
	private $_instances=array();
	private $_excludeClass;
	
	function __construct($params){
		if($params == null)
			throw new Exception('Параметры обязательны.');
		if(array_search('Date',$params))
			throw new Exception('Date обязательный');
	
		foreach($params as $class){
			$this->_classes[] = $class;
			$className = $class.'Filter';	
			$c = new $className();
			$this->_instances[$className] = $c;
		}
	}
	
	public function getSql(){
		foreach($this->_classes as $class){
			$className = $class.'Filter';	
			$c = $this->_instances[$className];
			$c->load(Yii::app()->request->getPost($class));
			$sql .= $c->getSqlPart().' ';
		}
		return $sql;
	}
	
	public function getSqlPart($class){
		$className = $class.'Filter';
		$c = $this->_instances[$className];
		$c->load(Yii::app()->request->getPost($class));
		$sql .= $c->getSqlPart().' ';
		return $sql;
	}
	
	public function getLink(){
		foreach($this->_classes as $class){
			if($this->_excludeClass == $class)
				continue;
			$className = $class.'Filter';	
			$c = $this->_instances[$className];
			$c->load(Yii::app()->request->getPost($class));
			$link .= $c->getLinkPart().' ';
		}
		return str_replace(' ', '', $link);
	}
	
	public function excludeLink($class){
		$this->_excludeClass = $class;
	}
		
	public function render(){
		foreach($this->_classes as $class){
			$className = $class.'Filter';	
			$c = $this->_instances[$className];
			$c->render();
		}
	}
}