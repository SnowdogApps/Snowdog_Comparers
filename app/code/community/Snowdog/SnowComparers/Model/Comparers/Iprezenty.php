<?php
class Snowdog_SnowComparers_Model_Comparers_Iprezenty extends Snowdog_SnowComparers_Model_Scheme_XML {
	public function getDefaultHeader() {
		$header = "<?xml version=\"1.0\"?>\n";
		$header .= "<products>\n";
		return $header;
	}

	public function getDefaultFooter() {
		$footer .= "</products>";
		return $footer;
	}
	
	public function getDefaultContent()	{
		$content="product\n";
		$content.="@customid:sku\n";
		$content.="@name:name\n";	
		$content.="@description:description\n";
		$content.="@price:sdPrice\n";
		$content.="@image:smallImage\n";
		$content.="@status:iprezentyStatus\n";
		$content.="@url:productUrl\n";
		return $content;
	}
}
