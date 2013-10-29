<?php

class Snowdog_SnowComparers_Model_Scheme_Visibility {
	const VISIBILITY_ALL = 0;
	const VISIBILITY_VISIBILE = 1;

	public function toOptionArray() {
		return array(
			self::VISIBILITY_ALL => Mage::helper('snowcomparers')->__('All products (including not visible simple products)'),
			self::VISIBILITY_VISIBILE => Mage::helper('snowcomparers')->__('Only visible products'),
		);
	}
}
