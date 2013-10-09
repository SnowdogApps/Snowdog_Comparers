<?php

class Snowdog_SnowComparers_Helper_Scheme_XML extends Snowdog_SnowComparers_Helper_Scheme {

    //Names of user defined functions 
    var $_XMLfunctions = array(
	'availabilityCeneo',
	'categoriesSkapiec',
	'categoriesXml',
	'categoriesTradeTracker',
	'additionalTradeTracker',
	'skapiecName',
	'attributesCeneo',
	'imageCeneo',
	'categoriesPath',
	'tradedublerCategories',
	'tradedublerAvailability',
	'tradedublerDeliveryTime',
	'tradedublerCondition',
		'iprezentyStatus',
		'imagesDomodi',
    );

    public function getTradedublerCategories($item) {
	$cats = $item->getCategoryCollection();
	$cat = '';
	foreach ($cats as $c) {
	    $model = Mage::getModel('catalog/category');
	    $ids = $c->getPathIds();
	    unset($ids[0]);
	    unset($ids[1]);
	    foreach ($ids as $categoryId) {
		$category = $model->load($categoryId);
		$cat .= '<category name="' . str_replace("&", "&amp;", $category->getName()) . '" /> ';
	    }
	}
	return $cat;
    }

    public function getTradedublerAvailability($item) {
	$stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($item->getId());

	$qty = $stock->getQty();
	$isInStock = $stock->getIsInStock();
	$availability = 'na zamówienie';

	if ($isInStock && ($qty > 0)) {
	    $availability = 'dostępny';
	} else if ($isInStock && ($qty == 0)) {
	    $availability = 'na zamówienie';
	}
	return $availability;
    }

    public function getTradedublerDeliveryTime($item) {
	return '3-7 dni';
    }

    public function getTradedublerCondition($item) {
	return 'Nowy';
    }

    public function getFunctions() {
	return array_merge($this->_XMLfunctions, parent::getFunctions());
    }

    public function getCategoriesPath($item) {
	$cats = $item->getCategoryCollection();
	foreach ($cats as $c) {
	    $model = Mage::getModel('catalog/category');
	    $path = '';
	    $ids = $c->getPathIds();
	    unset($ids[0]);
	    unset($ids[1]);
	    foreach ($ids as $categoryId) {
		$category = $model->load($categoryId);
		$path .= $category->getName() . '/';
	    }
	    $path = substr($path, 0, strlen($path) - 1);
	    return $path;
	}
	return '';
    }

    public function getAttributesCeneo($item) {
	$xml =
		.'<a name="Kod_producenta"><![CDATA[' . $item->getSku() . ']]></a>';
	return $xml;
    }

    public function getImageCeneo($item) {
	return '<main url="' . $this->getSmallImage($item) . '"/>';
    }

    public function getSkapiecName($item) {
	return '<![CDATA[' . $item->getName() . ']]>';
    }

    public function getAvailabilityCeneo($item) {
	$availability = '99';
	if ($this->getIsInStock($item)) {
	    $availability = '1';
	}
	return $availability;
    }

    public function getCategoriesSkapiec($item) {
	$catList = array();
	$categories = $item->getCategoryCollection()->addAttributeToSelect(array('name'));
	foreach ($categories as $cat) {
	    $catList[] = $cat->getId();
	}
//		return implode(',',$catList);
	return end($catList);
    }

    public function getCategoriesXml($item) {
	$catList = '';
	$categories = $item->getCategoryCollection()->addAttributeToSelect(array('name'));
	foreach ($categories as $cat) {
	    $catList .= "<category>" . $cat->getName() . "</category>";
	}

	return $catList;
    }

	 public function getCategoriesTradeTracker($item) {
		 $catList = '';
		 $categories = $item->getCategoryCollection()->addAttributeToSelect(array('name'));
		 foreach ($categories as $cat) {
			 $catList .= '<category name="' . $cat->getName() . '" />';
		 }
		 return $catList;
	 }

	 public function getAdditionalTradeTracker($item) {
		return '<field name="manufacturer" value="' . $item->getAttributeText('manufacturer') . '" />';
	 }
	
	public function getIprezentyStatus($item) {
		return ($item->getStatus() == 1) ? 'active' : 'inactive';
	}

	 public function getImagesDomodi($item) {
		 $imgs = '';
		 try{
			 $imgs .= '<main url="' . Mage::helper('catalog/image')->init($item, 'image')->resize(300)->__toString() . '"/>';
		 } catch (Exception $e) {};     
		 try{
			 $imgs .= '<i url="' . Mage::helper('catalog/image')->init($item, 'small_image')->resize(300)->__toString() . '" />';
		 } catch (Exception $e) {};     
		 return $imgs;

	 }

}
