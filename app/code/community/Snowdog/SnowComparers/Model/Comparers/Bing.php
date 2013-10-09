<?php

class Snowdog_SnowComparers_Model_Comparers_Bing extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return "\t";
	}

	public function getFileExtension() {
		return '.txt';
	}

	public function getDefaultContent() {
		$content_array = array(
			'MPID' => 'sku',
			'Title' => 'name',
			'BrandorManufacturer' => 'producer',
			'MPN' => 'sku',
			'MerchantSKU' => 'sku',
			'ProductURL' => 'productUrl',
			'Price' => 'price',
			'Description' => 'description',
			'ImageURL' => 'smallImage',
			'MerchantCategory' => 'categories',
			//'BingCategory' => 'empty', // TODO
		);

		$content = '';
		foreach ($content_array as $key => $value) {
			$content .= $key . ':' . $value . "\n";
		}
		return $content;
	}
}

