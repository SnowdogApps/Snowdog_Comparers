<?php

class Snowdog_SnowComparers_Model_Comparers_Shopmania	extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return "|";
	}

	public function getFileExtension() {
		return '.csv';
	}

	public function getDefaultContent() {
		$content = <<<CSV
Category:categories
Manufacturer:manufacturer
Model:name
Merchant Code:sku
Product name:name
Product description:description
Product URL:productUrl
Image URL:smallImage
Product price:finalPrice
CSV;
		return $content;
	}
}

