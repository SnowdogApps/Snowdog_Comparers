<?php

class Snowdog_SnowComparers_Model_Comparers_Sears extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return ",";
	}

	public function getDefaultContent() {
		$content_array = array(
			'Item ID' => 'sku',
			//   'Program Type' => '',
			'Title' => 'name',
			'Short Description' => 'description',
			'Long Description' => 'description',
			'Packing Slip Description' => 'name',
			'Category' => 'categories',
			'Manufacturer Model Num' => 'sku',
			'Standard Price' => 'price',
			//    'Low Inventory Alert' => '',
			'Brand Name' => 'producer',
			//	    'Shipping Length' => '',
			//	    'Shipping Width' => '',
			//	    'Shipping Height' => '',
			//	    'Shipping Weight' => '',
			//   'Web Exclusive' => '',
			'Image URL' => 'smallImage',
			// 'Mature Content' => '',
			//  'Created Date' => '',
		);

		$content = '';
		foreach ($content_array as $key => $value) {
			$content .= $key . ':' . $value . "\n";
		}
		return $content;
	}

}

