<?php

class Snowdog_SnowComparers_Model_Comparers_Shoppingcom extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return ",";
	}

	public function getFileExtension() {
		return '.csv';
	}

	public function getDefaultContent() {
		$content = <<<CSV
mpn:sku
manufacturer:manufacturer
product name:name
product description:description
price:finalPrice
stock:#Yes
stock description:#New
product url:productUrl
image url:smallImage
category:categories
shipping rate:#
CSV;
		return $content;
	}
}

