<?php

class Snowdog_SnowComparers_Model_Scheme_XML extends Snowdog_SnowComparers_Model_Scheme {

	protected function getHelper() {
		return Mage::helper('snowcomparers/scheme_xml')->setStoreId($this->getStoreId());
	}

	protected function getFileExtension() {
		return ".xml";
	}

	public function getType() {
		return 'Xml';
	}

	protected $_isOgrody;
	protected $_shortHeader;

	protected function getItemHeader($data, $item) {
		$xml = '';
		$this->_isOgrody = false;
		//Special tag-header attributes
		if (!is_array($data['header'])) {
			$header = $data['header'];
			$this->_shortHeader = $header;
		} else {
			$this->_shortHeader = $data['header'][0];
			$header = $data['header'][0] . ' ';

			foreach ($data['header'][1] as $headerKey => $headerValue) {
				if ($headerKey != 'ogrody') {
					$value = trim($headerValue);
					if (in_array($value, $this->getHelper()->getFunctions()))
						$attribute = call_user_func(array($this->getHelper(), "get" . ucfirst($value)), $item);
					else
						$attribute = call_user_func(array($item, "get" . ucfirst($value)));
					$header.= $headerKey . '="' . htmlspecialchars($attribute) . '" ';
				}
				else
					$this->_isOgrody = $headerValue;
			}
			$header = rtrim($header);
		}


		$xml.='<' . trim($header) . '>';
		if ($this->_isOgrody)
			$xml.= '<' . $this->_isOgrody . '>';
		return $xml;
	}

	protected function getItemFooter() {
		$xml = '';
		if ($this->_isOgrody)
			$xml.= '</' . $this->_isOgrody . '>';
		$xml.='</' . trim($this->_shortHeader) . '>';
		return $xml;
	}

	protected function processAttributes($data, $item) {
		$result = '';
		foreach ($data as $name => $attribute) {
			$result.="<attribute>";
			$result.="<name>$name</name>";
			$result.="<value>" . htmlspecialchars($item->getAttributeText($attribute)) . "</value>";
			$result.="</attribute>";
		}

		return $result;
	}

	protected function processResult($key, $result) {
		if($key[0]=='@') {
			$key=trim($key, '@');
			$result = '<![CDATA[' . $result . ']]>';
		}
		if($key[0]=='#') {
			$key=trim($key, '#');
			$result = htmlspecialchars($result);
		}
		return "\t<$key>" . ($result) . "</$key>";
	}

}
