<?php

class ExtensionsMall_SizeChart_Block_Sizechart extends Mage_Core_Block_Template {

    protected $config;
    #  protected $data = array();
    protected $columns = array();

    public function getConfig() {
        if (!isset($this->config)) {
            $config['sizechart_table_heading_color'] = Mage::getStoreConfig('sizechart_options/style/sizechart_table_heading_color');
            $this->config = $config;
        }
        return $this->config;
    }

    public function getTbody() {
        $data = $this->getColumns();
        if(!isset($data[0]['values'])){
            return null;
        }
        $rows = count($data[0]['values']);
        $colums = count($data);
        $html = '';
        for ($i = 0; $i < $rows; $i++) {
            $html .= '<tr>';
            for ($j = 0; $j < $colums; $j++) {
                if (isset($data[$j]['values'][$i])) {
                    $html .= '<td>' . $data[$j]['values'][$i] . '</td>';
                }else{
                    $html .= '<td></td>';
                }
            }
            $html .= '</tr>';
        }
        return $html;
    }

    public function getThead() {
        $columns = $this->getColumns();
        $html = '<tr>';
        foreach ($columns as $value) {
            $html .= '<th>' . $value['name'] . '</th>';
        }
        $html .= '</tr>';
        return $html;
    }

    public function getColumns() {
        if (empty($this->columns)) {
            $chartName = Mage::registry('current_product')->getData('size_chart');
            $model = Mage::getModel('extensionsmall_sizechart/sizechart');
            $chart = $model->getChart($chartName);
            if (empty($chart)) {
                $chart = $model->getChart('Default');
            }
            $columnNames = array(
                'sizes' => 'Size',
                'bust' => 'Bust',
                'waist' => 'Waist',
                'hip' => 'Hips',
            );
            $i = 0;
            foreach ($columnNames as $key => $value) {
                $string = trim($chart[$key]);
                if (!empty($string)) {
                    $this->columns[$i]['name'] = $value;
                    $this->columns[$i]['values'] = explode(',', $string);
                    $i++;
                }
            }
        }
        return $this->columns;
    }

    public function getLeftColumnWidth() {
        $columnsNo = count($this->getColumns());
        if ($columnsNo == 4) {
            return '375px';
        } else {
            return ($columnsNo * 80) . 'px';
        }
    }

}
