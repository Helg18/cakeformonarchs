<?php

class Kerss_Sizechart_Model_Adminhtml_System_Config_Source_Effect
{
	const EFFECT_NONE	= 'none';
    const EFFECT_FADE	= 'fade';
    const EFFECT_ELASTIC	= 'elastic';

    static public function toOptionArray()
    {
        return array(
			self::EFFECT_NONE    => Mage::helper('sizechart')->__('None'),
            self::EFFECT_FADE    => Mage::helper('sizechart')->__('Fade'),
            self::EFFECT_ELASTIC   => Mage::helper('sizechart')->__('Elastic')
        );
    }
}