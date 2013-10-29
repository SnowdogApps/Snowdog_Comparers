<?php

/*
 *  Snowdog_SnowComparers_Block_Adminhtml_Comparers_Edit_Form
 *
 * 	Class defining a custom edit form 
 *  @author Snowdog
 */

class Snowdog_SnowComparers_Block_Adminhtml_Comparers_Edit_Csv_Form extends Mage_Adminhtml_Block_Widget_Form {

    public function __construct() {
	parent::__construct();
	$this->setId('scheme_form');
	$this->setTitle(Mage::helper('snowcomparers')->__('CSV comparers feed'));
    }

    protected function _prepareForm() {
	$model = Mage::registry('snowcomparers_scheme');

	$form = new Varien_Data_Form(array(
		    'id' => 'edit_form',
				'action'    => $this->getUrl('*/*/save'),
		    'method' => 'post'
		));

	$fieldset = $form->addFieldset('add_maps_form', array('legend' => Mage::helper('snowcomparers')->__('Feed')));



	if ($model->getId()) {
	    $fieldset->addField('scheme_id', 'hidden', array(
		'name' => 'scheme_id',
	    ));
	}

	$fieldset->addField('name', 'text', array(
	    'label' => Mage::helper('snowcomparers')->__('Name'),
	    'name' => 'name',
	    'required' => true,
	    'note' => Mage::helper('snowcomparers')->__('eg. ComparerFeed'),
	    'value' => $model->getName()
	));


//	$fieldset->addField('header', 'editor', array(
//	    'label' => Mage::helper('snowcomparers')->__('Separator pól'),
//	    'name' => 'header',
//	    'required' => false,
//	    'value' => $model->getHeader(),
//	));
//
//	$fieldset->addField('footer', 'editor', array(
//	    'label' => Mage::helper('snowcomparers')->__('Stopka'),
//	    'name' => 'footer',
//	    'required' => false,
//	    'value' => $model->getFooter(),
//	));


	$note = Mage::helper('snowcomparers')->__("Each line should be in 'Field:Value' format where field is feed field name and value is attribute name or of following:\n");
	$note.=rtrim(implode(',', Mage::helper('snowcomparers/scheme_csv')->getFunctions()), ', ');


	$contentField = $fieldset->addField('content', 'textarea', array(
	    'label' => Mage::helper('snowcomparers')->__('Content'),
	    'name' => 'content',
	    'required' => false,
	    'note' => htmlspecialchars($note),
	    'value' => $model->getContent(),
		));

	$fieldset->addField('footer', 'select', array(
	    'label' => Mage::helper('snowcomparers')->__('Fields separator'),
	    'name' => 'footer',
	    'required' => false,
	    'value' => $model->getBase(),
	    'values' => array(
		"\t" => Mage::helper('snowcomparers')->__('Tab'),
		',' => Mage::helper('snowcomparers')->__('Comma')
	    )
	));

	$fieldset->addField('base', 'select', array(
	    'label' => Mage::helper('snowcomparers')->__('Base scheme'),
	    'name' => 'base',
	    'required' => true,
	    'value' => $model->getBase(),
	    'values' => Mage::getModel('snowcomparers/schemeList_Csv')->toOptionArray()
	));


	$fieldset->addField('path', 'text', array(
	    'label' => Mage::helper('snowcomparers')->__('Path'),
	    'name' => 'path',
	    'required' => false,
	    'note' => Mage::helper('snowcomparers')->__("eg: '/feeds' or '/' for main shop directory - path must be writable"),
	    'value' => $model->getPath()
	));

		$fieldset->addField('visibility', 'select', array(
            'label' => Mage::helper('snowcomparers')->__('Product visibility filter'),
            'name'  => 'visibility',
            'required' => true,            
            'value' => $model->getVisibility(),
				'values'   => Mage::getModel('snowcomparers/scheme_visibility')->toOptionArray()
        ));


	$fieldset->addField('sku_filter', 'text', array(
	    'label' => Mage::helper('snowcomparers')->__('Product filter'),
	    'name' => 'sku_filter',
	    'required' => false,
	    'note' => Mage::helper('snowcomparers')->__('Comma seperated list'),
	    'value' => $model->getSkuFilter()
	));

	$fieldset->addField('category_filter', 'text', array(
	    'label' => Mage::helper('snowcomparers')->__('Category filter'),
	    'name' => 'category_filter',
	    'required' => false,
	    'note' => Mage::helper('snowcomparers')->__('Comma seperated list'),
	    'value' => $model->getSkuFilter()
	));

	$fieldset->addField('store_id', 'select', array(
	    'label' => Mage::helper('snowcomparers')->__('Store'),
	    'name' => 'store_id',
	    'required' => false,
	    'value' => $model->getStoreId(),
	    'values' => Mage::getModel('core/store')->getCollection()->toOptionArray(),
	));
	
	// if (!Mage::app()->isSingleStoreMode()) {
	// $fieldset->addField('store_id', 'select', array(
	// 'label'    => Mage::helper('snowcomparers')->__('Sklep'),
	// 'title'    => Mage::helper('snowcomparers')->__('Sklep'),
	// 'name'     => 'store_id',
	// 'required' => true,
	// 'value'    => $model->getStoreId(),
	// 'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm()
	// ));
	// }
	// else {
	// $fieldset->addField('store_id', 'hidden', array(
	// 'name'     => 'store_id',
	// 'value'    => Mage::app()->getStore(true)->getId()
	// ));
	// $model->setStoreId(Mage::app()->getStore(true)->getId());
	// }

	$fieldset->addField('generate', 'hidden', array(
	    'name' => 'generate',
	    'value' => ''
	));

	$fieldset->addField('load', 'hidden', array(
	    'name' => 'load',
	    'value' => ''
	));

	$form->setValues($model->getData());
	$contentField->setValue(Mage::helper('snowcomparers')->toString($model->getContent()));
	$form->setUseContainer(true);

	$this->setForm($form);

	return parent::_prepareForm();
    }

}
