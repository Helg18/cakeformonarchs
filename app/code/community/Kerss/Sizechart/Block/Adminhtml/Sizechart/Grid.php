<?php

class Kerss_Sizechart_Block_Adminhtml_Sizechart_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId("sizechartGrid");
        $this->setDefaultSort("sizechart_id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel("sizechart/sizechart")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn("sizechart_id", array(
            "header" => Mage::helper("sizechart")->__("ID"),
            "align" => "right",
            "width" => "50px",
            "type" => "number",
            "index" => "sizechart_id",
        ));

        /*$this->addColumn('image', array(
            'header' => Mage::helper('sizechart')->__('Image'),
            'width' => '100px',
            'type' => 'image',
            'index' => 'image',
            'renderer' => 'sizechart/adminhtml_sizechart_renderer_image',
            'style' => 'text-align:center'
        ));*/

        $this->addColumn("name", array(
            "header" => Mage::helper("sizechart")->__("Sizechart Name"),
            "index" => "name",
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('sizechart')->__('Status'),
            'index' => 'status',
            'type' => 'options',
            'options' => Kerss_Sizechart_Block_Adminhtml_Sizechart_Grid::getOptionArray8(),
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('sizechart_id');
        $this->getMassactionBlock()->setFormFieldName('sizechart_ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('remove_sizechart', array(
            'label' => Mage::helper('sizechart')->__('Remove Sizechart'),
            'url' => $this->getUrl('*/adminhtml_sizechart/massRemove'),
            'confirm' => Mage::helper('sizechart')->__('Are you sure?')
        ));
        
        $statuses = Mage::getSingleton('sizechart/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('sizechart')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('sizechart')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

    static public function getOptionArray8() {
        $data_array = array();
        $data_array[1] = 'Enable';
        $data_array[2] = 'Disable';
        return($data_array);
    }

    static public function getValueArray8() {
        $data_array = array();
        foreach (Kerss_Sizechart_Block_Adminhtml_Sizechart_Grid::getOptionArray8() as $k => $v) {
            $data_array[] = array('value' => $k, 'label' => $v);
        }
        return($data_array);
    }

}