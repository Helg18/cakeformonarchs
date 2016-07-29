<?php

class ExtensionsMall_SizeChart_Model_Resource_SizeChart extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('extensionsmall_sizechart/sizechart', 'sizechart_id');
    }

}
