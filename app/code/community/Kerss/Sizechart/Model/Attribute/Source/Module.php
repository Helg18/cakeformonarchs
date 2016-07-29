<?php

class Kerss_Sizechart_Model_Attribute_Source_Module extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

    public function getAllOptions($withEmpty = false) {
        if (is_null($this->_options)) {
            $this->_options = array();
            $inCol = Mage::getModel('sizechart/sizechart')->getCollection()
                    ->addFieldToFilter('status',1);
            foreach ($inCol as $val) {
                $this->_options[] = array('label' => $val['name'], value => $val['sizechart_id']);
            }
        }
        $options = $this->_options;
        if ($withEmpty) {
            array_unshift($options, array('value' => '', 'label' => ''));
        }
        return $options;
    }

    public function getOptionText($value) {
        $options = $this->getAllOptions(false);

        foreach ($options as $item) {
            if ($item['value'] == $value) {
                return $item['label'];
            }
        }
        return false;
    }

}

?>