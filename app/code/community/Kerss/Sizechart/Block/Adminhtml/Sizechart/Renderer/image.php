<?php

class Kerss_Sizechart_Block_Adminhtml_Sizechart_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $imgName = $row->getData($this->getColumn()->getIndex());
        $mediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $html = '<img id="' . $this->getColumn()->getId() . '" style="width:100px;height:auto;" src="' . $mediaUrl . $imgName . '"';
        $html .= '/>';
        return $html;
    }

}