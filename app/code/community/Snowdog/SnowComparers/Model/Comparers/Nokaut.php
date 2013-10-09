<?php
class Snowdog_SnowComparers_Model_Comparers_Nokaut extends Snowdog_SnowComparers_Model_Scheme_XML {
	public function getDefaultHeader() {
		$header = "<?xml version=\"1.0\"?>\n";
		$header .= "<!DOCTYPE nokaut SYSTEM \"http://www.nokaut.pl/integracja/nokaut.dtd\">\n";
		$header .= "<nokaut>\n";
		$header .= "<offers>\n";
		return $header;
	}

	public function getDefaultFooter() {
		$footer = "</offers>\n";
		$footer .= "</nokaut>";
		return $footer;
	}

	public function getDefaultContent()	{
		$content="offer\n";
		$content.="@id:sku\n";
		$content.="@name:name\n";		
		$content.="@price:sdPrice\n";
		$content.="@url:productUrl\n";
		$content.="category:categoriesPath\n";
		$content.="@description:description\n";
		$content.="@image:smallImage\n";
		$content.="@producer:marka\n";
		return $content;
	}


}

