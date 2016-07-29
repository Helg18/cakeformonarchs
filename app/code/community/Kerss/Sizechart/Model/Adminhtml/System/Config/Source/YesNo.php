<?php

class Kerss_Sizechart_Model_Adminhtml_System_Config_Source_YesNo
{
	const YES	= 'true';
    const NO	= 'false';
    
	static public function toOptionArray()
    {
        return array(
			self::YES    => Mage::helper('sizechart')->__('Yes'),
            self::NO    => Mage::helper('sizechart')->__('No')
        );
    }
}