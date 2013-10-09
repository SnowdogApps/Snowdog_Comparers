<?php
/*
 *  Snowdog_SnowComparers_Block_Adminhtml_Comparers_Edit
 *
 *	Class defining the headers of a custom edit form 
 *  @author Snowdog
 */
class Snowdog_SnowComparers_Block_Adminhtml_Comparers_Edit_Xml extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        $this->_objectId = 'scheme_id';
        $this->_blockGroup = 'snowcomparers';
        $this->_controller = 'adminhtml_comparers';
	$this->_mode = 'edit_xml';

        parent::__construct();

        $this->_addButton('generate', array(
            'label'   => Mage::helper('snowcomparers')->__('Save and generate feed'),
            'onclick' => "$('generate').value=1; editForm.submit();",
            'class'   => 'add',
        ));
		
		$this->_addButton('load', array(
            'label'   => Mage::helper('snowcomparers')->__('Load default schema'),
            'onclick' => "$('load').value=1; editForm.submit();",
            'class'   => 'scalable',
        ));
    }

    public function getHeaderText()
    {
        if (Mage::registry('snowcomparers_scheme')->getId()) {
            return Mage::helper('snowcomparers')->__('Edit XML feed');
        }
        else {
            return Mage::helper('snowcomparers')->__('Add XML feed');
        }
    }
}
