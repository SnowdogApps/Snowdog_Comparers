<?php 

//Template list for the backend

class Snowdog_SnowComparers_Model_SchemeList_Xml extends Mage_Core_Model_Abstract
{
	protected $_options=array(
		"ceneo"=>"Ceneo",
		"nokaut"=>"Nokaut",
		"skapiec"=>"Skapiec",
		"tradedoubler"=>"Tradedoubler",
		"iprezenty"=>"IPrezenty",
		"tradeTracker" => "Trade Tracker",
	);  

	public function toOptionArray($isMultiselect=true)
	{
		$list =array();
		foreach($this->_options as $key=>$option)
			$list[] = array( 'value' => $key, 'label' => $option);
		return $list;
	}

	public function getOptionArray()
	{
		return $_options;	
	}


}
