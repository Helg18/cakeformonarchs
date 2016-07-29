<?php

class ExtensionsMall_SizeChart_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'sizechart_id';
        $this->_blockGroup = 'extensionsmall_sizechart';
        $this->_controller = 'adminhtml';
        
        $this->_updateButton('save', 'label', Mage::helper('extensionsmall_sizechart')->__('Save sizechart'));
        $this->_updateButton('delete', 'label', Mage::helper('extensionsmall_sizechart')->__('Delete sizechart'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('bannerslider_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'bannerslider_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'bannerslider_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('sizechart_data') && Mage::registry('sizechart_data')->getId() ) {
            return Mage::helper('extensionsmall_sizechart')->__("Edit sizechart '%s'", $this->htmlEscape(Mage::registry('sizechart_data')->getTitle()));
        } else {
            return Mage::helper('extensionsmall_sizechart')->__('Add sizechart');
        }
    }
}