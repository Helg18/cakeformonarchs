<?php

class ExtensionsMall_SizeChart_Adminhtml_ExtensionsmallsizechartController extends Mage_Adminhtml_Controller_Action {

    public function indexAction() {
        $this->_title($this->__('Catalog'))->_title($this->__('Sizecharts'));
        $this->loadLayout();
        $this->_setActiveMenu('catalog');
        $this->_addContent($this->getLayout()->createBlock('extensionsmall_sizechart/adminhtml_list'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        $sizechart_id = $this->getRequest()->getParam('sizechart_id');
        $model = Mage::getModel('extensionsmall_sizechart/sizechart')->load($sizechart_id);

        if ($model->getSizechartId() || $sizechart_id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('sizechart_data', $model);
            $this->_title($this->__('Sizechart'))->_title($this->__('Manage sizechart'));
            if ($model->getSizechartId()) {
                $this->_title($model->getTitle());
            } else {
                $this->_title($this->__('New sizechart'));
            }
            $this->loadLayout();
            $this->_setActiveMenu('sizechart/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('extensionsmall_sizechart/adminhtml_edit'))
                    ->_addLeft($this->getLayout()->createBlock('extensionsmall_sizechart/adminhtml_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('extensionsmall_sizechart')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction() {
        $data = $this->getRequest()->getPost();
        if ($data) {
            $model = Mage::getModel('extensionsmall_sizechart/sizechart');
            if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {
                $data['image'] = '';
            } elseif (isset($data['image']) && is_array($data['image'])) {
                $data['image'] = $data['image']['value'];
            }
            $data['image'] = $model->saveImage();
            
            $model->setData($data)->setSizechartId($this->getRequest()->getParam('sizechart_id'));
      /*      print_r($model->getData());
            die();*/
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('extensionsmall_sizechart')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('sizechart_id' => $model->getSizechartId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('sizechart_id' => $this->getRequest()->getParam('sizechart_id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sizechart')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

}
