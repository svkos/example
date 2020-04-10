<?php

class SubaccountFilter implements FilterInterface {
	
	private $_sub1,$_sub2,$_sub3,$_sub4;

	public function load($param){
		if(isset($param['sub1']))
			$this->_sub1 = $param['sub1'];
		if(isset($param['sub2']))
			$this->_sub2 = $param['sub2'];
		if(isset($param['sub3']))
			$this->_sub3 = $param['sub3'];
		if(isset($param['sub4']))
			$this->_sub4 = $param['sub4'];
	}	
	public function getSqlPart(){
		if ($this->_sub1!=''){ 
			if(strstr($this->_sub1, '*')){
				$this->_sub1 = str_replace('*','%',$this->_sub1);
				$filter.=" AND t.sub1 LIKE ".Yii::app()->db->quoteValue($this->_sub1)." ";
			}
			else
				$filter.=" AND t.sub1=".Yii::app()->db->quoteValue($this->_sub1)." ";
		} 
		if ($this->_sub2!=''){ 
			if(strstr($this->_sub2, '*')){
				$this->_sub2 = str_replace('*','%',$this->_sub2);
				$filter.=" AND t.sub2 LIKE ".Yii::app()->db->quoteValue($this->_sub2)." ";
			}
			else
				$filter.=" AND t.sub2=".Yii::app()->db->quoteValue($this->_sub2)." ";
		}
		if ($this->_sub3!=''){ 
			if(strstr($this->_sub3, '*')){
				$this->_sub3 = str_replace('*','%',$this->_sub3);
				$filter.=" AND t.sub3 LIKE ".Yii::app()->db->quoteValue($this->_sub3)." ";
			}
			else
				$filter.=" AND t.sub3=".Yii::app()->db->quoteValue($this->_sub3)." ";
		}
		if ($this->_sub4!=''){ 
			if(strstr($this->_sub4, '*')){
				$this->_sub4 = str_replace('*','%',$this->_sub4);
				$filter.=" AND t.sub4 LIKE ".Yii::app()->db->quoteValue($this->_sub4)." ";
			}
			else
				$filter.=" AND t.sub4=".Yii::app()->db->quoteValue($this->_sub4)." ";
		}
		return $filter;
	}
	
	public function getLinkPart(){
		if ($this->_sub1!='')
			$subfilterLink .= '&sub1='.$this->_sub1;
		if ($this->_sub2!='')
			$subfilterLink .= '&sub2='.$this->_sub2;
		if ($this->_sub3!='')
			$subfilterLink .= '&sub3='.$this->_sub3;
		if ($this->_sub4!='')
			$subfilterLink .= '&sub4='.$this->_sub4;
		
		return $subfilterLink;
	}
	public function render(){
		Yii::app()->controller->renderPartial('//statistics/filters/subaccount', array('sub1'=>$this->_sub1,'sub2'=>$this->_sub2,'sub3'=>$this->_sub3,'sub4'=>$this->_sub4));
	}
}