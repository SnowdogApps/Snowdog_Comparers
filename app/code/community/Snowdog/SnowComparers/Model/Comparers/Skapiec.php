<?php
class Snowdog_SnowComparers_Model_Comparers_Skapiec extends Snowdog_SnowComparers_Model_Scheme_XML
{
	public function getDefaultHeader() {
		$header="<?xml version=\"1.0\"?>\n".'<xmldata><version>10</version>';
		$header.="\n<header>\n";		
		$header.="<name>".Mage::app()->getStore($this->getStoreId())->getWebsite()->getName()."</name>\n";
		$header.="<shopid></shopid>\n";
		$header.="<www>".Mage::app()->getStore($this->getStoreId())->getBaseUrl()."</www>\n";
		$header.="<time>[UPDATE]</time>\n";
		$header.="</header>\n";
		$header.="<category>\n";

		$category_collection = Mage::getModel('catalog/category')->getCollection($this->getStoreId())
			->addAttributeToSelect('name')
			->addFieldToFilter('entity_id', array('neq' => 1));


		foreach ($category_collection as $c) {
			$xml = sprintf('<catitem><catid>%s</catid><catname><![CDATA[%s]]></catname></catitem>',
				$c->getId(),
				Mage::helper('snowcomparers')->htmlEscape($c->getName())
			);
			$header.=$xml;
		}
		$header.="</category>\n<data>\n";
		return $header;
	}

	public function getDefaultFooter() {

		return '</data></xmldata>';//return $footer;
	}



	public function getDefaultContent()
	{
		$content="item\n";
		$content.="compid:sku\n";
		$content.="vendor:producer\n";		
		$content.="desc:skapiecName\n";
		$content.="price:sdPrice\n";
		$content.="catid:categoriesSkapiec\n";
		$content.="image:smallImage\n";
		$content.="url:productUrl\n";	
		return $content;
	}

}

