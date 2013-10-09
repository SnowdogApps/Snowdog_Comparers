<?php

//Template list for the backend

class Snowdog_SnowComparers_Model_SchemeList_Csv extends Mage_Core_Model_Abstract {

	protected $_options = array(
		"google" => "Google",
		"bing" => "Bing",
		"thefind" => "The find",
		"sas" => "SAS",
		"sears" => "Sears",
	);

	public function toOptionArray($isMultiselect=true) {
		$list = array();
		foreach ($this->_options as $key => $option)
			$list[] = array('value' => $key, 'label' => $option);
		return $list;
	}

	public function getOptionArray() {
		return $_options;
	}

}
