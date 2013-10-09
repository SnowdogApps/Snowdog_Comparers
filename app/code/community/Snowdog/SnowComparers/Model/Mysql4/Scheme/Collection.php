<?php
class Snowdog_SnowComparers_Model_Mysql4_Scheme_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('snowcomparers/scheme');
    }
}
