<?php
class Snowdog_SnowComparers_Model_Comparers_Ceneo extends Snowdog_SnowComparers_Model_Scheme_XML {
	public function getDefaultHeader() {
	$header = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$header .= '<offers xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1">' . "\n";
		return $header;
	}

	public function getDefaultFooter() {
		$footer = "</offers>\n";
		return $footer;
	}
	
	public function getDefaultContent()	{
		$content="o,id=sku,url=productUrl,price=finalPrice,avail=availabilityCeneo,stock=qty\n";
		$content.="@name:name\n";
		$content.="cat:categoriesPath\n";
		$content.="@desc:description\n";
		$content.="imgs:imageCeneo\n";
		$content.="attrs:attributesCeneo\n";
		return $content;
	}
}
