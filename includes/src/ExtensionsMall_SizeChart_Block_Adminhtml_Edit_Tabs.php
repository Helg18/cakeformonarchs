<?php

class ExtensionsMall_SizeChart_Block_Adminhtml_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('sizechart_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('extensionsmall_sizechart')->__('Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('extensionsmall_sizechart')->__('General Information'),
            'title' => Mage::helper('extensionsmall_sizechart')->__('General Information'),
            'content' => $this->getLayout()->createBlock('extensionsmall_sizechart/adminhtml_edit_tab_form')->toHtml(),
        ));

      //  $this->addTab('display_section', array(
      //     'label' => Mage::helper('sizechart')->__('Categories'),
      //      'url' => $this->getUrl('*/*/categories', array('_current' => true)),
      //      'class' => 'ajax',
      //  ));

        return parent::_beforeToHtml();
    }

}
