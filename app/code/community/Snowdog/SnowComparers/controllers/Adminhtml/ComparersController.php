<?php

/*
 *  Snowdog_SnowComparers_Adminhtml_ComparersController
 *
 * 	Controller responsible for handling the grid actions
 *  @author Snowdog
 */

class Snowdog_SnowComparers_Adminhtml_ComparersController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
	$this->loadLayout()
		->_setActiveMenu('catalog/snowcomparers');
	return $this;
    }

    protected $_type;
    
    //
    //  Lists all of the defined compareres 
    //
    public function indexAction() {
	$this->_initAction()
		->_addContent($this->getLayout()->createBlock('snowcomparers/adminhtml_comparers'))
		->renderLayout();
    }

    public function newXMLAction() {
	$this->_forward('editXML');
    }

    public function newCSVAction() {
	$this->_forward('editCSV');
    }

    //
    // Also handles the creation of new comparer scheme
    //
    
    public function editAction() {
	$id = $this->getRequest()->getParam('scheme_id');


	$model = Mage::getModel('snowcomparers/scheme');
	if ($id) {
	    $model->load($id);
	    if (!$model->getId()) {
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('snowcomparers')->__('Feed not found'));
		$this->_redirect('*/*/');
		return;
	    }
		 if(!$this->_type) {
			$this->_type = $model->getRealModel()->getType();
		 }
	}

	$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
	if (!empty($data)) {
	    $model->setData($data);
	}

	Mage::register('snowcomparers_scheme', $model);
	$this->_initAction()
		->_addBreadcrumb($id ? Mage::helper('snowcomparers')->__('Edit feed') : Mage::helper('snowcomparers')->__('New feed'), $id ? Mage::helper('snowcomparers')->__('Edit feed') : Mage::helper('snowcomparers')->__('New feed'))
		->_addContent($this->getLayout()->createBlock('snowcomparers/adminhtml_comparers_edit_' . $this->_type))
		->renderLayout();
    }

    public function editXMLAction() {
	$this->_type = "xml";
	$this->editAction();
    }

    public function editCSVAction() {
	$this->_type = "csv";
	$this->editAction();
    }

    public function saveAction() {
	if ($data = $this->getRequest()->getPost()) {
	    $model = Mage::getModel('snowcomparers/scheme');

	    if ($this->getRequest()->getParam('scheme_id')) {
		$model->load($this->getRequest()->getParam('scheme_id'));
	    }

	    $model->setData($data);
	    //Prepare the data for storage (convert its format into an array)
	    $model->setContent($model->getContent());


	    if ($this->getRequest()->getParam('load')) {
		$this->getRequest()->setParam('scheme_id', $model->getId());
		$this->_forward('load');
		return;
	    }

	    try {
		$model->save();

		Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('snowcomparers')->__('Feed successfully saved'));
		Mage::getSingleton('adminhtml/session')->setFormData(false);

		if ($this->getRequest()->getParam('back')) {
		    $this->_redirect('*/*/edit', array('scheme_id' => $model->getId()));
		    return;
		}
		if ($this->getRequest()->getParam('generate')) {
		    $this->getRequest()->setParam('scheme_id', $model->getId());
		    $this->_forward('generate');
		    return;
		}
		$this->_redirect('*/*/');
		return;
	    } catch (Exception $e) {
		Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		Mage::getSingleton('adminhtml/session')->setFormData($data);
		$this->_redirectReferer('*/*/');
		return;
	    }
	}
	$this->_redirect('*/*/');
    }

    public function deleteAction() {
	if ($id = $this->getRequest()->getParam('scheme_id')) {
	    try {
		$model = Mage::getModel('snowcomparers/scheme');
		$model->setId($id);
		$model->load($id);
		$file = str_replace('//', '/', Mage::getBaseDir() . $model->getPath()) . $model->getFilename();
		if ($model->getFilename() && file_exists($file))
		    unlink($file);
		$model->delete();
		Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('snowcomparers')->__('Feed successfully deleted'));
		$this->_redirect('*/*/');
		return;
	    } catch (Exception $e) {
		Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		$this->_redirect('*/*/edit', array('scheme_id' => $id));
		return;
	    }
	}
	Mage::getSingleton('adminhtml/session')->addError(Mage::helper('snowcomparers')->__('Feed not found'));
	$this->_redirect('*/*/');
    }

    public function loadAction() {
	$id = $this->getRequest()->getParam('scheme_id');
	$data = $this->getRequest()->getPost();

	$model = Mage::getModel('snowcomparers/scheme');

	$model->load($id);
	$model->setData($data);
	$model->save();

	$model = $model->getRealModel();
	$model->setBase($this->getRequest()->getParam('base'));
	$model->loadDefaults();
	$model->save();

	$this->_getSession()->addSuccess(
		Mage::helper('snowcomparers')->__('Default scheme for %s loaded', $model->getBase())
	);


	$this->getRequest()->setParam('scheme_id', $model->getId());
	$this->_forward('edit');
    }

    //
    // Generate a new map
    //
    public function generateAction() {
	$id = $this->getRequest()->getParam('scheme_id');
	$map = Mage::getModel('snowcomparers/scheme');

	$map->load($id);
	$map = $map->getRealModel();
	if ($map->getId()) {
	    try {
		$map->write();

		$this->_getSession()->addSuccess(
			Mage::helper('snowcomparers')->__("Feed '%s' generation successfull", $map->getName())
		);
	    } catch (Mage_Core_Exception $e) {
		$this->_getSession()->addError($e->getMessage());
	    } catch (Exception $e) {
		$this->_getSession()->addException($e, Mage::helper('snowcomparers')->__('Could not generate feed') . ': ' . $e->getMessage());
	    }
	} else {
	    $this->_getSession()->addError(Mage::helper('snowcomparers')->__('Feed not found'));
	}

	$this->_redirect('*/*/');
    }

    protected function _isAllowed() {
	return true;
    }

}
