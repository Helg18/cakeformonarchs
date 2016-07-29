<?php

class Kerss_Sizechart_Adminhtml_SizechartController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu("sizechart/sizechart")->_addBreadcrumb(Mage::helper("adminhtml")->__("Sizechart  Manager"), Mage::helper("adminhtml")->__("Sizechart Manager"));
        return $this;
    }

    public function indexAction() {
        $this->_title($this->__("Sizechart"));
        $this->_title($this->__("Manager Sizechart"));

        $this->_initAction();
        $this->renderLayout();
    }

    public function editAction() {
        $this->_title($this->__("Sizechart"));
        $this->_title($this->__("Sizechart"));
        $this->_title($this->__("Edit Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("sizechart/sizechart")->load($id);
        if ($model->getId()) {
            Mage::register("sizechart_data", $model);
            $this->loadLayout();
            $this->_setActiveMenu("sizechart/sizechart");
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Sizechart Manager"), Mage::helper("adminhtml")->__("Sizechart Manager"));
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Sizechart Description"), Mage::helper("adminhtml")->__("Sizechart Description"));
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("sizechart/adminhtml_sizechart_edit"))->_addLeft($this->getLayout()->createBlock("sizechart/adminhtml_sizechart_edit_tabs"));
            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("sizechart")->__("Item does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function newAction() {

        $this->_title($this->__("Sizechart"));
        $this->_title($this->__("Sizechart"));
        $this->_title($this->__("New Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("sizechart/sizechart")->load($id);

        $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register("sizechart_data", $model);

        $this->loadLayout();
        $this->_setActiveMenu("sizechart/sizechart");

        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Sizechart Manager"), Mage::helper("adminhtml")->__("Sizechart Manager"));
        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Sizechart Description"), Mage::helper("adminhtml")->__("Sizechart Description"));


        $this->_addContent($this->getLayout()->createBlock("sizechart/adminhtml_sizechart_edit"))->_addLeft($this->getLayout()->createBlock("sizechart/adminhtml_sizechart_edit_tabs"));

        $this->renderLayout();
    }

    public function saveAction() {

        $post_data = $this->getRequest()->getPost();


        if ($post_data) {

            try {


                //save image
                try {

                    if ((bool) $post_data['image']['delete'] == 1) {

                        $post_data['image'] = '';
                    } else {

                        unset($post_data['image']);

                        if (isset($_FILES)) {

                            if ($_FILES['image']['name']) {

                                if ($this->getRequest()->getParam("id")) {
                                    $model = Mage::getModel("sizechart/sizechart")->load($this->getRequest()->getParam("id"));
                                    if ($model->getData('image')) {
                                        $io = new Varien_Io_File();
                                        $io->rm(Mage::getBaseDir('media') . DS . implode(DS, explode('/', $model->getData('image'))));
                                    }
                                }
                                $path = Mage::getBaseDir('media') . DS . 'sizechart' . DS . 'sizechart' . DS;
                                $uploader = new Varien_File_Uploader('image');
                                $uploader->setAllowedExtensions(array('jpg', 'png', 'gif'));
                                $uploader->setAllowRenameFiles(false);
                                $uploader->setFilesDispersion(false);
                                $destFile = $path . $_FILES['image']['name'];
                                $filename = $uploader->getNewFileName($destFile);
                                $uploader->save($path, $filename);

                                $post_data['image'] = 'sizechart/sizechart/' . $filename;
                            }
                        }
                    }
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
//save image


                $model = Mage::getModel("sizechart/sizechart")
                        ->addData($post_data)
                        ->setId($this->getRequest()->getParam("id"))
                        ->save();

                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Sizechart was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setSizechartData(false);

                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $model->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setSizechartData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;
            }
        }
        $this->_redirect("*/*/");
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam("id") > 0) {
            try {
                $model = Mage::getModel("sizechart/sizechart");
                $model->setId($this->getRequest()->getParam("id"))->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
                $this->_redirect("*/*/");
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        $this->_redirect("*/*/");
    }

    public function massRemoveAction() {
        try {
            $ids = $this->getRequest()->getPost('sizechart_ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel("sizechart/sizechart");
                $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
        } catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function massStatusAction()
    {
        $ids = $this->getRequest()->getParam('sizechart_ids');
        if(!is_array($ids)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('sizechart/sizechart')
                        ->load($id)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($ids))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
    
    /**
     * Export order grid to CSV format
     */
    public function exportCsvAction() {
        $fileName = 'sizechart.csv';
        $grid = $this->getLayout()->createBlock('sizechart/adminhtml_sizechart_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    /**
     *  Export order grid to Excel XML format
     */
    public function exportExcelAction() {
        $fileName = 'sizechart.xml';
        $grid = $this->getLayout()->createBlock('sizechart/adminhtml_sizechart_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

}
