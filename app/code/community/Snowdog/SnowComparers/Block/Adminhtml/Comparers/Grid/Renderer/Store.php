<?php

class Snowdog_SnowComparers_Block_Adminhtml_Comparers_Grid_Renderer_Store extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
	$map = $row->getRealModel();
	return Mage::getModel('core/store')->load($map->getStoreId())->getName();
    }

}