<?php
class Snowdog_SnowComparers_Model_Mysql4_Scheme extends Mage_Core_Model_Mysql4_Abstract{
    protected function _construct()
    {
        $this->_init('snowcomparers/scheme', 'scheme_id');
    }   
}
