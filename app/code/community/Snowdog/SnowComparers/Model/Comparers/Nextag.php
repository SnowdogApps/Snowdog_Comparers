<?php

class Snowdog_SnowComparers_Model_Comparers_Nextag extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return ",";
	}

	public function getFileExtension() {
		return '.csv';
	}

	public function getDefaultContent() {
		$content = <<<CSV
Click-Out URL:productUrl
Description:description
Image URL:smallImage
Manufacturer:manufacturer
Price:finalPrice
Product Name:name
CSV;
		return $content;
	}
}

