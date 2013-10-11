<?php

class Snowdog_SnowComparers_Model_Comparers_Amazon extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return "\t";
	}

	public function getFileExtension() {
		return '.txt';
	}

	public function getDefaultContent() {
		$content = <<<CSV
Category:categories
Title:name
Link:productUrl
SKU:sku
Price:finalPrice
Brand:manufacturer
Image:smallImage
Description:description
Manufacturer:manufacturer
CSV;
		return $content;
	}
}

