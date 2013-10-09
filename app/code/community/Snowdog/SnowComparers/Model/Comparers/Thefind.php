<?php

class Snowdog_SnowComparers_Model_Comparers_Thefind extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return "\t";
	}

	public function getDefaultContent() {

		$content_array = array(
			'Title' => 'name',
			'Description' => 'description',
			'Image_Link' => 'smallImage',
			'Page_URL' => 'productUrl',
			'Price' => 'price',
			'SKU' => 'sku',
			'MPN' => 'sku',
			'Unique_ID' => 'sku',
			//	    'Shipping Cost' => '', // TODO
			//	    'Free Shipping' => '',
			//	    'Online_Only' => '',
			//	    'Brand' => '',
			'Categories' => 'categories',
			//	    'Condition' => '',
		);

		$content = '';
		foreach ($content_array as $key => $value) {
			$content .= $key . ':' . $value . "\n";
		}
		return $content;
	}

}

