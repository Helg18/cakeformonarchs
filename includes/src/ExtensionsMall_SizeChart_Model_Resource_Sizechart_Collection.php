<?php

class ExtensionsMall_SizeChart_Model_Resource_SizeChart_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('extensionsmall_sizechart/sizechart');
    }

}
