<?php

interface FilterInterface{
	public function load($param);
	public function render();
	public function getSqlPart();
	public function getLinkPart();
}