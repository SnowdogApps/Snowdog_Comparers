<?php
//Link rendering element
class Snowdog_SnowComparers_Block_Adminhtml_Comparers_Grid_Renderer_Link extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
	$map = $row->getRealModel();
        $fileName = preg_replace('/^\//', '', $map->getPath() . $map->getFileName());
        $url = $this->htmlEscape(Mage::getBaseUrl('web') . $fileName);

        if (file_exists(BP . DS . $fileName)) {
            return sprintf('<a href="%1$s">%1$s</a>', $url);
        }
        return $url;
    }

}
