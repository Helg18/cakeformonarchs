<?php

class Kerss_Sizechart_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getSizechartCollection($sizechart_id) {
        $scCollection = Mage::getModel('sizechart/sizechart')->getCollection()
                ->addFieldToFilter('sizechart_id', $sizechart_id);
        return $scCollection;
    }

    public function getMediaUrl($scImage) {
        return Mage::getBaseUrl('media') . $scImage;
    }

    public function getConfigValue($field) {
        return Mage::getStoreConfig('scsection/kerssgroup/' . $field);
    }
	
	public function getPopupConfigValue($field) {
        return Mage::getStoreConfig('scsection/popupgroup/' . $field);
    }

    public function isEnableSizechart() {
        return $this->getConfigValue('scenable');
    }

    public function getSizechartIcon() {
        return $this->getConfigValue('scimage');
    }

    public function getSizechartLinkText() {
        return $this->getConfigValue('sclink');
    }

    public function getSizechartDisplayOption() {
        $data_array = array();
        $data_array[0] = 'In Popup';
        $data_array[1] = 'On Page';
        return($data_array);
    }

	public function getPopupwidth() {
        return $this->getPopupConfigValue('popupwidth');
    }
	
	public function getPopupheight() {
        return $this->getPopupConfigValue('popupheight');
    }
	
	public function getOverlayShow() {
        return $this->getPopupConfigValue('overlayShow');
    }
	
	public function getOverlayColor() {
        return $this->getPopupConfigValue('overlayColor');
    }
	
	public function getCenterOnScroll() {
        return $this->getPopupConfigValue('centerOnScroll');
    }
	
	public function getOpenEffect() {
        return $this->getPopupConfigValue('openEffect');
    }
	
	public function getCloseEffect() {
        return $this->getPopupConfigValue('closeEffect');
    }
	
	public function getSpeedIn() {
        return $this->getPopupConfigValue('speedIn');
    }
	
	public function getSpeedOut() {
        return $this->getPopupConfigValue('speedOut');
    }
	
	public function getShowCloseButton() {
        return $this->getPopupConfigValue('showCloseButton');
    }
	
	public function getTitleShow() {
        return $this->getPopupConfigValue('titleShow');
    }
	
	public function getEnableEscapeButton() {
        return $this->getPopupConfigValue('enableEscapeButton');
    }
	
}

