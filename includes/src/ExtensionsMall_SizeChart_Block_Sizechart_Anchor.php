<?php

class ExtensionsMall_SizeChart_Block_Sizechart_Anchor extends Mage_Core_Block_Template {

    public function showAnchor() {
        $chartName = Mage::registry('current_product')->getData('size_chart');
        $model = Mage::getModel('extensionsmall_sizechart/sizechart');
        if ($model->chartExists($chartName)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
