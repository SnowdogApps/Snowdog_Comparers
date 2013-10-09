<?php
/*
 *  Snowdog_SnowComparers_Block_Adminhtml_Comparers_Grid
 *
 * 	Class defining the grid columns
 *  @author Snowdog
 */

class Snowdog_SnowComparers_Block_Adminhtml_Comparers_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
	parent::__construct();
	$this->setId('comparersGrid');
	$this->setDefaultSort('scheme_id');
    }

    protected function _prepareCollection() {
	$collection = Mage::getModel('snowcomparers/scheme')->getCollection();
	//Zend_Debug::dump($collection);
	$this->setCollection($collection);
	return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
	$this->addColumn('scheme_id', array(
	    'header' => Mage::helper('snowcomparers')->__('ID'),
	    'width' => '50px',
	    'index' => 'scheme_id'
	));

	$this->addColumn('name', array(
	    'header' => Mage::helper('snowcomparers')->__('Name'),
	    'width' => '50px',
	    'index' => 'name'
	));

	$this->addColumn('link', array(
	    'header' => Mage::helper('snowcomparers')->__('Link to feed'),
	    'filter' => false,
	    'sortable' => false,
	    'width' => '100',
	    'renderer' => 'snowcomparers/adminhtml_comparers_grid_renderer_link'
	));

	$this->addColumn('action', array(
	    'header' => Mage::helper('snowcomparers')->__('Action'),
	    'filter' => false,
	    'sortable' => false,
	    'width' => '100',
	    'renderer' => 'snowcomparers/adminhtml_comparers_grid_renderer_action'
	));

	$this->addColumn('last_generated', array(
	    'header' => Mage::helper('snowcomparers')->__('Last generated'),
	    'filter' => false,
	    'sortable' => false,
	    'width' => '100',
	    'index' => 'last_generated',
	));
	
	$this->addColumn('store', array(
	    'header' => Mage::helper('snowcomparers')->__('Store'),
	    'filter' => false,
	    'sortable' => false,
	    'width' => '100',
	    'index' => 'store_id',
	    'renderer' => 'snowcomparers/adminhtml_comparers_grid_renderer_store'
	));

	return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
	//Zend_Debug::dump($row);
	$map = $row->getRealModel();
	return $this->getUrl('*/*/edit' . $map->getType(), array('scheme_id' => $row->getSchemeId()));
    }

}
