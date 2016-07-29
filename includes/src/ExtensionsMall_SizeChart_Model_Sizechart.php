<?php

class ExtensionsMall_SizeChart_Model_SizeChart extends Mage_Core_Model_Abstract {

    const IMAGEDIR = 'sizechart/';

    public function _construct() {
        parent::_construct();
        $this->_init('extensionsmall_sizechart/sizechart');
    }

    public function saveImage() {
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader('image');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                // We set media as the upload dir
                $path = Mage::getBaseDir('media') . DS . 'sizechart' . DS;
                $result = $uploader->save($path, $_FILES['image']['name']);
                return self::IMAGEDIR . $result['file'];
            } catch (Exception $e) {
                return $_FILES['image']['name'];
            }
        }
    }

    public function getChart($chartTitle) {
        $collection = $this->getCollection();
        $collection->addFieldToFilter('title', $chartTitle);
        $data = $collection->getFirstItem()->getData();
        return $data;
    }
    public function chartExists($chartName) {
        $data = $this->getChart($chartName);
        if (empty($data)) {
            return FALSE;
        }else {
            return TRUE;
        }
    }

}
