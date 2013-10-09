<?php

/*
 *  Snowdog_SnowComparers_Block_Adminhtml_Comparers
 *
 * 	Block used to define the header of the Grid 
 *  @author Snowdog
 */

class Snowdog_SnowComparers_Block_Adminhtml_Comparers extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
	$this->_controller = 'adminhtml_comparers';
	$this->_blockGroup = 'snowcomparers';
	$this->_headerText = Mage::helper('snowcomparers')->__('Price comparers feeds');
	$this->addButton('add_xml', array('label' => Mage::helper('snowcomparers')->__('Add XML feed'), 'onclick' => 'setLocation(\'' . $this->getUrl('*/*/newXML') . '\')', 'class' => 'add'));
	$this->addButton('add_csv', array('label' => Mage::helper('snowcomparers')->__('Add CSV feed'), 'onclick' => 'setLocation(\'' . $this->getUrl('*/*/newCSV') . '\')', 'class' => 'add'));
	parent::__construct();
	$this->_removeButton('add');
    }

}
