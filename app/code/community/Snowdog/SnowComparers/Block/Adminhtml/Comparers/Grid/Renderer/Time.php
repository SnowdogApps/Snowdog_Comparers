<?php
//Time rendering element
class Snowdog_SnowComparers_Block_Adminhtml_Comparers_Grid_Renderer_Time extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $time =  date('Y-m-d H:i:s', strtotime($row->getTime()) + Mage::getSingleton('core/date')->getGmtOffset());

        return $time;
    }

}
