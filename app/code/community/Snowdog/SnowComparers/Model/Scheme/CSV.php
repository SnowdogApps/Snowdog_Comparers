<?php

class Snowdog_SnowComparers_Model_Scheme_CSV extends Snowdog_SnowComparers_Model_Scheme {

	protected function getHelper() {
		return Mage::helper('snowcomparers/scheme_csv')->setStoreId($this->getStoreId());
	}

	public function getType() {
		return 'Csv';
	}

	protected function getFileExtension() {
		return ".csv";
	}

	protected function getFieldSeparator() {
		return $this->getFooter();
	}

	protected function getContent() {
		return "ignored\n".parent::getContent();
	}

	public function getDeafultFieldSeparator() {
		return '';
	}

	public function getDefaultHeader() {
		return '';
	}

	public function getDefaultFooter() {
		return $this->getDeafultFieldSeparator();
	}

	public function getDefaultContent() {
		return '';
	}

	/**
	 * @TODO analizowac dane wejsciowe i wypluc prawdziwy header xP
	 */
	protected function getHeader() {
		$helper = Mage::helper('snowcomparers');
		$data = $helper->toArray($this->getContent());
		return implode($this->getFieldSeparator(), array_keys($data['data']))."\n";
	}

	protected $_values;

	protected function getItemHeader($data, $item) {
		$this->_values = array();
		return '';
	}

	protected function getItemFooter() {
		return implode($this->getFieldSeparator(), $this->_values)."\n";
	}

	protected function processResult($key, $result) {
		if($result != '')
			$result = '"' . $result . '"';
		$this->_values[$key] = $result;
		return '';
	}

}
