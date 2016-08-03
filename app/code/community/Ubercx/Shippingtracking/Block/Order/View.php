<?php
/*
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/gpl-license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@refersion.com so we can send you a copy immediately.
 *
 * @category   Ubercx
 * @package    Ubercx_Shippingtracking
 * @copyright  Copyright (c) 2015 Ubercx, Inc.
 * @license    http://opensource.org/licenses/gpl-license GNU General Public License
 */

/**
 * Uctracker order view block
 *
 * @category    Ubercx
 * @package     Ubercx_Shippingtracking
 * @author	    Ubercx Developer <ubercx_nospam@jframeworks.com>
 */

class Ubercx_Shippingtracking_Block_Order_View extends Mage_Sales_Block_Order_View
{
	/**
   *  Block constructor
   *
   *  @return	
   */
	protected function _construct()
	{
	    parent::_construct();
	    $this->setTemplate('shippingtracking/order/view.phtml');
	}//end function
	
	/**
   *  Check if uctracker is active
   *
   *  @return	  string
   */
	public function isActive()
	{
  	return Mage::getStoreConfig('shippingtracking/shippingtracking_settings/shippingtracking_active');
  }//end function
  
}