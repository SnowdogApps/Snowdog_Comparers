<?php

class Snowdog_SnowComparers_Model_Comparers_Sas extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return ',';
	}

	public function getDefaultContent() {

		$content_array = array(
			'SKU' => 'sku',
			'Name' => 'name',
			'URL' => 'productUrl',
			'Price' => 'price',
			'Full Image' => 'smallImage',
			'Thumbnail Image' => 'smallImage',
			'Category' => 'categories',
			'Subcategory' => 'empty',
			'Description' => 'description',
			//  'Search Terms' => 'categories',
			//  'MerchantID' => '',
			'PartNumber' => 'sku',
			'MerchantCategory' => 'categories',
			'ShortDescription' => 'short_description',
		);

		$content = '';
		foreach ($content_array as $key => $value) {
			$content .= $key . ':' . $value . "\n";
		}
		return $content;
	}

}

