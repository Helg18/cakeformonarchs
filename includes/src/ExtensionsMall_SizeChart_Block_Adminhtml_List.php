<?php

class ExtensionsMall_SizeChart_Block_Adminhtml_List extends Mage_Adminhtml_Block_Widget_Grid_Container {
    
    public function __construct()
    {
        $this->_blockGroup = 'extensionsmall_sizechart';
        $this->_controller = 'adminhtml_list';
        $this->_headerText = Mage::helper('extensionsmall_sizechart')->__('Sizechart List');
 
        parent::__construct();
       # $this->_removeButton('add');
    }
}
