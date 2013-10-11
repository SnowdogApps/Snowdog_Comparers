<?php
class Snowdog_SnowComparers_Model_Comparers_Tradedoubler extends Snowdog_SnowComparers_Model_Scheme_XML
{
	public function getDefaultHeader() {
		$header = "<?xml version=\"1.0\"?>\n";
		$header .= "<productFeed version='2.0'>\n";
		return $header;
	}

	public function getDefaultFooter() {
		$footer = "</productFeed>";
		return $footer;
	}

	public function getDefaultContent()
	{
		$content="product,id=sku\n";
		$content.="@name:name\n";
		$content.="@productURL:productUrl\n";
		$content.="@imageURL:smallImage\n";
		$content.="@price:finalPrice\n";
		$content.="@description:description\n";
		$content.="categories:tradedublerCategories\n";
		$content.="@availability:tradedublerAvailability\n";
		$content.="@deliveryTime:tradedublerDeliveryTime\n";
		$content.="@condition:tradedublerCondition\n";
		$content.="@brand:producer\n";
		return $content;
	}


}

