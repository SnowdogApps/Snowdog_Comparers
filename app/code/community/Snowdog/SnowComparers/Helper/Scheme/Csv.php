<?php

class Snowdog_SnowComparers_Helper_Scheme_CSV extends Snowdog_SnowComparers_Helper_Scheme {
    //Names of user defined functions 
    var $_CSVfunctions = array(
	'description',
	'short_description',
	'empty',
    );

    public function getFunctions() {
	return array_merge($this->_CSVfunctions, parent::getFunctions());
    }
    
    public function getDescription($item) {
	$desc = $item->getDescription();
	$badWhitespace = array("\t", "\n", "\r");
	return '"' . str_replace($badWhitespace, " ", $desc) . '"';
    }
    
    public function getShort_description($item) {
	$desc = $item->getShort_description();
	$badWhitespace = array("\t", "\n", "\r");
	return '"' . str_replace($badWhitespace, " ", $desc) . '"';
    }
    
    public function getEmpty($item) {
	return '';
    }
}