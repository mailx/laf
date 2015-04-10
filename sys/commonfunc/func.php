<?php

function &loadclass($classname,$arg=''){
	if($classname !='' && class_exists($classname)){
		if($arg!=''){
			$obj= new $classname($arg);
		}else{
			$obj= new $classname();
		}
		return $obj;
	}else{
		return false;
	}
}

function loadmethod(&$obj,$methodname){
	if($methodname!='' &&  method_exists($obj,$methodname)){
		$obj->$methodname();
	}else{
		exit();
	}
}