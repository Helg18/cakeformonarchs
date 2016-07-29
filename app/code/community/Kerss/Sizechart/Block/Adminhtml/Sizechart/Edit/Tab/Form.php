<?php

class Kerss_Sizechart_Block_Adminhtml_Sizechart_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("sizechart_form", array("legend" => Mage::helper("sizechart")->__("Item information")));


        $fieldset->addField("name", "text", array(
            "label" => Mage::helper("sizechart")->__("Sizechart Name"),
            "class" => "required-entry",
            "required" => true,
            "name" => "name",
        ));

        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('sizechart')->__('Sizechart Image'),
            'name' => 'image',
            'note' => '(*.jpg, *.png, *.gif)',
        ));

        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
                array('tab_id' => $this->getTabId())
        );
        $wysiwygConfig["files_browser_window_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index');
        $wysiwygConfig["directives_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive');
        $wysiwygConfig["directives_url_quoted"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive');
        $wysiwygConfig["add_images"] = false;
        $wysiwygConfig["add_widgets"] = false;
        $wysiwygConfig["add_variables"] = false;
        $wysiwygConfig["widget_plugin_src"] = false;
        $wysiwygConfig->setData("plugins", array());

        $style = 'height:20em; width:50em;';
        $config = $wysiwygConfig;
        $fieldset->addField('description', 'editor', array(
            'label' => Mage::helper('sizechart')->__('Description'),
            'required' => false,
            'name' => 'description',
            'style' => $style,
            'wysiwyg' => true,
            'config' => $config,
        ));
        
        $fieldset->addField('display', 'select', array(
            'label' => Mage::helper('sizechart')->__('Display Sizechart'),
            'values' => Mage::helper('sizechart')->getSizechartDisplayOption(),
            'name' => 'display',
        ));
        
        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('sizechart')->__('Status'),
            'values' => Kerss_Sizechart_Block_Adminhtml_Sizechart_Grid::getValueArray8(),
            'name' => 'status',
        ));
        
        if (Mage::getSingleton("adminhtml/session")->getSizechartData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getSizechartData());
            Mage::getSingleton("adminhtml/session")->setSizechartData(null);
        } elseif (Mage::registry("sizechart_data")) {
            $form->setValues(Mage::registry("sizechart_data")->getData());
        }
        return parent::_prepareForm();
    }

}
