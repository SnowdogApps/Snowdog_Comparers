<?php
class Snowdog_SnowComparers_Model_Comparers_TradeTracker extends Snowdog_SnowComparers_Model_Scheme_XML {
	public function getDefaultHeader() {
		$header = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<productFeed version="1.0">
XML;
		return $header;
	}

	public function getDefaultFooter() {
		$footer = <<<XML
</productFeed>
XML;
		return $footer;
	}
	
	public function getDefaultContent()	{
		$content = <<<XML
product,id=sku
@name:name
@price:sdPrice
@description:description
@productUrl:productUrl
@imageURL:smallImage
additional:additionalTradeTracker
categories:categoriesTradeTracker
XML;
		return $content;
	}
}
