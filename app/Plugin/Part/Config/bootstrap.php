<?php

//Funções Auxiliares
function d($str) {
	if(empty($str) || $str == '0000-00-00' || $str == '0000-00-00 00:00')
		return ''; 
		
	return date('d/m/Y',strtotime($str));
}

function dm(&$str, $return = false) {
	list($d, $m ,$y) = explode("/", $str);
	$formatted = "$y-$m-$d";
	
	if($return)
		return $formatted;
	else 
		$str = $formatted;
}

function f($str) {
	return number_format($str, 2, ",", ".");
}

function fm(&$str){
	$str = str_replace(",", ".", $str);
}
