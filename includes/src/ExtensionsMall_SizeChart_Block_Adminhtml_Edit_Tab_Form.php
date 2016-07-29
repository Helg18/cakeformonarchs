<?php

class ExtensionsMall_SizeChart_Block_Adminhtml_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('sizechart_form', array('legend' => Mage::helper('extensionsmall_sizechart')->__('General information')));
        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('extensionsmall_sizechart')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));
        $fieldset->addField('sizes', 'text', array(
            'label' => Mage::helper('extensionsmall_sizechart')->__('Sizes'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'sizes',
        ));
        $fieldset->addField('bust', 'text', array(
            'label' => Mage::helper('extensionsmall_sizechart')->__('Bust'),
            'required' => FALSE,
            'name' => 'bust',
        ));

        $fieldset->addField('waist', 'text', array(
            'label' => Mage::helper('extensionsmall_sizechart')->__('Waist'),
            'required' => FALSE,
            'name' => 'waist',
        ));
        $fieldset->addField('hip', 'text', array(
            'label' => Mage::helper('extensionsmall_sizechart')->__('Hips'),
            'required' => FALSE,
            'name' => 'hip',
        ));
        /*
          $fieldset->addField('chest', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Chest'),
          'required' => FALSE,
          'name' => 'chest',
          ));
          $fieldset->addField('dress_size', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Dress Size'),
          'required' => FALSE,
          'name' => 'dress_size',
          ));

          $fieldset->addField('vest_size', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Vest Size'),
          'required' => FALSE,
          'name' => 'vest_size',
          ));
          $fieldset->addField('equivalent_to', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Equivalent To'),
          'required' => FALSE,
          'name' => 'equivalent_to',
          ));
          $fieldset->addField('chest_measurement_vest', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Chest Measurement (Vest)'),
          'required' => FALSE,
          'name' => 'chest_measurement_vest',
          ));
          $fieldset->addField('waist_measurement_vest', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Waist Measurement (Vest)'),
          'required' => FALSE,
          'name' => 'waist_measurement_vest',
          ));
          $fieldset->addField('length_shoulder_to_point', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Length (Shoulder to Point)'),
          'required' => FALSE,
          'name' => 'length_shoulder_to_point',
          ));

          $fieldset->addField('length', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Length'),
          'required' => FALSE,
          'name' => 'length',
          ));
          $fieldset->addField('h_waist', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Hollow to Waist'),
          'required' => FALSE,
          'name' => 'h_waist',
          ));
          $fieldset->addField('h_hem', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Hollow to Hem'),
          'required' => FALSE,
          'name' => 'h_hem',
          ));


          $fieldset->addField('tea_length', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Tea Length'),
          'required' => FALSE,
          'name' => 'tea_length',
          ));
          $fieldset->addField('knee_length', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Knee Length'),
          'required' => FALSE,
          'name' => 'knee_length',
          ));
          $fieldset->addField('ankle_length', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Ankle Length'),
          'required' => FALSE,
          'name' => 'ankle_length',
          ));
          $fieldset->addField('floor_length', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Floor Length'),
          'required' => FALSE,
          'name' => 'floor_length',
          ));
          $fieldset->addField('lower_back', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Lower Back'),
          'required' => FALSE,
          'name' => 'lower_back',
          ));
          $fieldset->addField('h_hem_floor', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Hollow to Hem: Floor'),
          'required' => FALSE,
          'name' => 'h_hem_floor',
          ));
          $fieldset->addField('h_hem_tea', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Hollow to Hem: Tea'),
          'required' => FALSE,
          'name' => 'h_hem_tea',
          ));
          $fieldset->addField('h_hem_knee', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Hollow to Hem: Knee'),
          'required' => FALSE,
          'name' => 'h_hem_knee',
          ));
          $fieldset->addField('h_hem_short', 'text', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Hollow to Hem: Short'),
          'required' => FALSE,
          'name' => 'h_hem_short',
          ));
          $fieldset->addField('image', 'image', array(
          'label' => Mage::helper('extensionsmall_sizechart')->__('Image File'),
          'required' => false,
          'name' => 'image',
          ));
         */
        if (Mage::getSingleton('adminhtml/session')->getSizeChartData()) {
            $data = Mage::getSingleton('adminhtml/session')->getSizeChartData();
            Mage::getSingleton('adminhtml/session')->setSizeChartData(null);
        } elseif (Mage::registry('sizechart_data')) {
            $data = Mage::registry('sizechart_data')->getData();
        }
        $form->setValues($data);
        return parent::_prepareForm();
    }

}
