<?php

class Snowdog_SnowComparers_Model_Comparers_Myshopping extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return ",";
	}

	public function getFileExtension() {
		return '.csv';
	}

	public function getDefaultContent() {
		$content = <<<CSV
CODE:sku
Name:name
Description:shortDescription
Category:categories
Price:finalPrice
Product_URL:productUrl
Image_URL:smallImage
Brand:manufacturer
CSV;
		return $content;
	}
}

