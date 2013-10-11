<?php

/*
 *  Snowdog_SnowComparers_Model_Scheme
 *
 * 	Main processing class, covers most of the module functionality
 *  @author Snowdog
 */

class Snowdog_SnowComparers_Model_Scheme extends Mage_Core_Model_Abstract {

	protected function _construct() {
		$this->_init('snowcomparers/scheme');
	}

	 /*
		Processing functions

	  */

	protected function getHelper() {
		return Mage::helper('snowcomapres/scheme')->setStoreId($this->getStoreId());
	}

	protected function getFileExtension() {
		return ".txt";
	}

	protected function getItemHeader($data, $item) {
		return '';
	}

	protected function getItemFooter() {
		return "\n";
	}

	protected function processResult($key, $result) {
		return '';
	}

	protected function process($data, &$io) {
		$xml = '';
		$model = Mage::getModel('catalog/product');

		if (empty($data))
			return '';

		$attributes = array();
		foreach ($data['data'] as $key => $value) {
			if (!is_array($value))
				$attributes[] = ucfirst($value);
		}

		if (!isset($data['id'])) {
			$collection = $model->getCollection()->addAttributeToSelect("*");
			$collection->addCategoryIds();
			$collection->addStoreFilter($this->getStoreId());
			if ($this->getSkuFilter())
				$collection->addFieldToFilter('sku', array('in' => explode(',', $this->getSkuFilter())));
			$collection->addFieldToFilter('visibility', array('in' => array(
				Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG,
				Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
			)));
			$collection->addFieldToFilter('status', 1);

			$collection->setPageSize(500);

			$lastPage = $collection->getLastPageNumber();


			for ($curPage = 1; $curPage <= $lastPage; $curPage++) {
				$xml = '';
				$collection = $model->getCollection()->addAttributeToSelect("*");
				$collection->addStoreFilter($this->getStoreId());
				$collection->addCategoryIds();
				//Apply filter
				if ($this->getSkuFilter())
					$collection->addFieldToFilter('sku', array('in' => explode(',', $this->getSkuFilter())));
				$collection->addFieldToFilter('visibility', array('eq' => '4'));
				$collection->addFieldToFilter('status', 1);
				$collection->setPageSize(500);

				$collection->setCurPage($curPage);


				foreach ($collection as $item) {
					//Apply filter
					if (($this->getCategoryFilter() &&
						count(array_intersect(explode(',', $this->getCategoryFilter()), $this->getCategoriesArray($item))) > 0) || (!$this->getCategoryFilter())) {

							if(!$this->getHelper()->getIsInStock($item)) {
								continue;
							}

							$xml .= $this->getItemHeader($data, $item);

							foreach ($data['data'] as $key => $value) {

								if(strstr($value, '#')) {
									//Handle static values
									$result = substr($value, 1);
								} else if (in_array($value, $this->getHelper()->getFunctions())) {
									//Check if we need an user-defined or a built-in function
									if (!is_array($value)) {
										$result = call_user_func(array($this->getHelper(), "get" . ucfirst($value)), $item);
									}
									else {
										$result = $this->processAttributes($value, $item);
									}
								} else {
									if (!is_array($value)) {
										$result = call_user_func(array($item, "get" . ucfirst($value)));
									} else {
										$result = $this->processAttributes($value, $item);
									}
								}
								//Check if we need normal processing or attribute processing

								$xml .= $this->processResult($key, $result);
							}

							$xml .= $this->getItemFooter();
						}
				}
				$io->streamWrite($xml);
				unset($collection);
				unset($xml);
			}
		}
		//return $xml;
	}

	protected function _beforeSave() {
		$io = new Varien_Io_File();
		$realPath = $io->getCleanPath(Mage::getBaseDir() . '/' . $this->getPath());

		if (!$io->allowedPath($realPath, Mage::getBaseDir())) {
			Mage::throwException(Mage::helper('snowcomparers')->__('Invalid path'));
		}

		if (!$io->fileExists($realPath, false)) {
			Mage::throwException(Mage::helper('snowcomparers')->__('You must create directory before saving feed', file_exists($realPath)));
		}

		if (!$io->isWriteable($realPath)) {
			Mage::throwException(Mage::helper('snowcomparers')->__(
				"Make sure that directory '%s' is writable", $this->getSitemapPath()));
		}

		$this->setPath(rtrim(str_replace(str_replace('\\', '/', Mage::getBaseDir()), '', $realPath), '/') . '/');

		return parent::_beforeSave();
	}

	public function getXmlBody() {
		//$helper=Mage::helper('snowcomparers');
		//return $this->process($helper->toArray($this->getContent()));		
	}

	public function getFilename() {
		return $this->getName() . $this->getFileExtension();
	}

	public function write() {
		$io = new Varien_Io_File();
		$io->setAllowCreateFolders(true);

		$io->open(array('path' => str_replace('//', '/', Mage::getBaseDir() . $this->getPath())));

		if ($io->fileExists($this->getFilename()) && !$io->isWriteable($this->getFilename())) {
			Mage::throwException(Mage::helper('comparers')->__(
				"File '%s' is not writable. Please check that directory '%s' is writable", $this->getFilename(), $this->getPath2()
			));
		}

		$io->streamOpen($this->getFilename());
		$io->streamWrite($this->parseHeader($this->getHeader()));
		$helper = Mage::helper('snowcomparers');
		$this->process($helper->toArray($this->getContent()), $io);
		$io->streamWrite($this->getFooter());
		$io->streamClose();
		$this->setLastGenerated(date('Y-m-d h:i:s', time()));
		$this->save();
	}

	public function getRealModel() {
		return Mage::getModel('snowcomparers/comparers_' . $this->getBase())->load($this->getId());
	}

	public function getDefaultHeader() {
		return '';
	}

	public function getDefaultFooter() {
		return '';
	}

	public function getDefaultContent() {
		return '';
	}

	public function loadDefaults() {
		$this->setContent($this->getDefaultContent());
		$this->setFooter($this->getDefaultFooter());
		$this->setHeader($this->getDefaultHeader());
	}

	public function parseHeader($header) {
		return str_replace('[UPDATE]', date('Y-m-d'), $header);
	}

	public function updateAll() {
		foreach (Mage::getModel('snowcomparers/scheme')->getCollection() as $scheme) {
			$scheme->load($scheme->getId());
			$map = $scheme->getRealModel();
			try {
				$map->write();
			} catch (Exception $e) {
				Mage::log($e->getMessage());
			}
		}
	}

	public function updateOne() {	
		$collection = Mage::getModel('snowcomparers/scheme')->getCollection()->setOrder('last_generated', 'ASC');
		$sitemap=$collection->getFirstItem();
		$map = $sitemap->getRealModel();
		try {
			$map->write();
		} catch (Exception $e) {
			Mage::log($e->getMessage());
		}
	}
}

