<?php
class Kerss_Sizechart_Model_Mysql4_Sizechart extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("sizechart/sizechart", "sizechart_id");
    }
}