<?php

class Snowdog_SnowComparers_Model_Comparers_Getprice extends Snowdog_SnowComparers_Model_Scheme_CSV {

	public function getDeafultFieldSeparator() {
		return "\t";
	}

	public function getFileExtension() {
		return '.csv';
	}

	public function getDefaultContent() {
		$content = <<<CSV
SKU:sku
Product ID:entityId
Short Description:shortDescription
Category Name:categories
Brand:manufacturer
Model:name
Image Link:smallImage
Product URL:productUrl
price:finalPrice
Shipment Costs:#
CSV;
		return $content;
	}
}

