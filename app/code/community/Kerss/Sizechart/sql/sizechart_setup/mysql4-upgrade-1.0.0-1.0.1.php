<?php

$installer = $this;
$installer->startSetup();
$installer->addAttribute('catalog_product', 'sizechart', array(
    'type' => 'varchar', // can be int, varchar, decimal, text, datetime
    'backend' => '', // If you're making an image attribute you'll need to add : catalog/category_attribute_backend_image
    'label' => 'Sizechart',
    'input' => 'select', //text, textarea, select, file, image, multiselect
    'source' => 'sizechart/attribute_source_module', // Only needed if using select or multiselect
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false, // or true
    'position' => 10, // Number depends on where you want it to display in the grid.
));
$installer->endSetup();