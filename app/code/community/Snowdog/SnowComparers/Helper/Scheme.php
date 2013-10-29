<?php

class Snowdog_SnowComparers_Helper_Scheme extends Mage_Core_Helper_Abstract {

    //Names of user defined functions 
    var $_functions = array(
	'qty',
	'isInStock',
	'attributes',
	'categories',
	'sdPrice',
	'smallImage',
	'producer',
	'nettoPrice',
	'vat',
	'productUrl',
	'oldPrice',
	'parentSku',
	'relationshipType'
    );

    public function getFunctions() {
	return $this->_functions;
    }

    /*
      User defined functions
     */

	 public function getSmallImage($item) {
		 try {
			 return Mage::helper('catalog/image')->init($item, 'small_image')->resize(300);
		 } catch(Exception $e) {
			 return;
		 }
    }

    public function getProductUrl($item) {
	return Mage::app()->getStore($this->getStoreId())->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB) . $item->getUrlPath();
    }

    public function getProducer($item) {
	return htmlspecialchars($item->getAttributeText('manufacturer'));
    }

    public function getQty($item) {
	$stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($item->getId());
	$qty = $stock->getQty();
	if($qty < 0) $qty = 0;
	return number_format($qty,0);
    }

    public function getIsInStock($item) {
	$stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($item->getId());
	return $stock->getIsInStock();
    }

    public function getCategories($item) {
	$catList = array();
	$categories = $item->getCategoryCollection()->addAttributeToSelect(array('name'));
	foreach ($categories as $cat) {
	    $catList[] = $cat->getName();
	}
	return implode(',', $catList);
    }

    //Filtering function!
    public function getCategoriesArray($item) {
	$catList = array();
	$categories = $item->getCategoryCollection()->addAttributeToSelect(array('name'));
	foreach ($categories as $cat) {
	    $catList[] = $cat->getName();
	}
	return $catList;
    }

    public function getSdPrice($item) {
	$price = $item->getPrice();

	$specialPrice = $item->getSpecialPrice();

	if ($specialPrice && $specialPrice < $price) {
	    $price = $specialPrice;
	}
	$netto = $price / 1.23;
	$price = number_format($price, 2, '.', '');
	$netto = number_format($netto, 2, '.', '');

	return $price;
    }

    public function getNettoPrice($item) {
	$price = $item->getPrice();

	$specialPrice = $item->getSpecialPrice();

	if ($specialPrice && $specialPrice < $price) {
	    $price = $specialPrice;
	}
	$netto = $price / 1.23;
	$price = number_format($price, 2, '.', '');
	$netto = number_format($netto, 2, '.', '');

	return $netto;
    }

    public function getVat($item) {
	return '23';
	 }
    
    
    private $_storeId;
    public function setStoreId($store_id) {
	$this->_storeId = $store_id;
	return $this;
    }
    public function getStoreId() {
	return $this->_storeId;
    }


	 public function getIsNews($item) {
		 $ids = $item->getCategoryIds();
		 return (int)in_array(self::PME_NOWOSCI, $ids);
	 }

	 public function getIsSale($item) {
		 $ids = $item->getCategoryIds();
		 return (int)in_array(self::PME_WYPRZEDAZ, $ids);
	 }

	 public function getOldPrice($item) {
		return number_format($item->getPrice(), 2, '.', '');
	 }

	 public function getParentSku($item) {
			$link = Mage::getModel('catalog/product_type_configurable');
			$parents = $link->getParentIdsByChild($item->getId());
			$result = array();
			foreach($parents as $id) {
				$parent = Mage::getModel('catalog/product')->load($id);
				$result[] = $parent->getSku();
			}
			return implode(';', $result);
	 }

	 public function getRelationshipType($item) {
		if($item->getTypeId() == 'simple') {
			$link = Mage::getModel('catalog/product_type_configurable');
			$parents = $link->getParentIdsByChild($item->getId());
			if(!empty($parents)) {
				return 'child';
			} else {
				return;
			}
		} else if($item->getTypeId() == 'configurable') {
			return 'parent';
		}
	 }

}
