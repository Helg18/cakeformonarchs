<?php

class ExtensionsMall_SizeChart_Model_Resource_Setup extends Mage_Core_Model_Resource_Setup {

    public function getCatalogSetup() {
        return new Mage_Catalog_Model_Resource_Setup('extensionsmall_sizechart_setup');
    }

    public function getCustomerSetup() {
        return new Mage_Customer_Model_Resource_Setup('extensionsmall_sizechart_setup');
    }

}
