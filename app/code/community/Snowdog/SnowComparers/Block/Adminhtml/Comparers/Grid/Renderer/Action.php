<?php
//Action link rendering element
class Snowdog_SnowComparers_Block_Adminhtml_Comparers_Grid_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
    public function render(Varien_Object $row)
    {
        $this->getColumn()->setActions(array(array(
            'url'     => $this->getUrl('*/*/generate', array('scheme_id' => $row->getSchemeId())),
            'caption' => Mage::helper('snowcomparers')->__('Generate feed'),
        )));
        return parent::render($row);
    }
}
