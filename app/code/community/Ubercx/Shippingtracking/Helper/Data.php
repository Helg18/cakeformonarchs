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
 * Uctracker Data Helper
 *
 * @category    Ubercx
 * @package     Ubercx_Shippingtracking
 * @author	    Ubercx Developer <ubercx_nospam@jframeworks.com>
 */
class Ubercx_Shippingtracking_Helper_Data extends Mage_Shipping_Helper_Data
{
	/**
   * Retrieve tracking url with params
   * Function override from Mage_Shipping_Helper_Data class 
   * 
   * @deprecated the non-model usage
   * @param  string $key
   * @param  integer|Mage_Sales_Model_Order|Mage_Sales_Model_Order_Shipment|Mage_Sales_Model_Order_Shipment_Track $model
   * @param  string $method - option
   * @return string
   */
  protected function _getTrackingUrl($key, $model, $method = 'getId')
  {  
  	if (empty($model)) {
		   $param = array($key => ''); // @deprecated after 1.4.0.0-alpha3
		} else if (!is_object($model)) {
		   $param = array($key => $model); // @deprecated after 1.4.0.0-alpha3
		} else {
		   $param = array(
		       'hash' => Mage::helper('core')->urlEncode("{$key}:{$model->$method()}:{$model->getProtectCode()}")
		   );
		}
		$storeId = is_object($model) ? $model->getStoreId() : null;
		$storeModel = Mage::app()->getStore($storeId);
		return $storeModel->getUrl('shippingtracking/list/index', $param);
 	}
}
