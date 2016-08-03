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
 * Uctracker List Controller
 *
 * @category    Ubercx
 * @package     Ubercx_Shippingtracking
 * @author	    Ubercx Developer <ubercx_nospam@jframeworks.com>
 */

class Ubercx_Shippingtracking_ListController extends Mage_Core_Controller_Front_Action
{
  /**
   * List of the trcking information
   * 
   * @var null
   * @return null
   */
	public function indexAction(){		
    $shippingInfoModel = Mage::getModel('shippingtracking/info')->loadByHash($this->getRequest()->getParam('hash'));
    Mage::register('current_shipping_info', $shippingInfoModel);
    if (count($shippingInfoModel->getTrackingInfo()) == 0) {
        $this->norouteAction();
        return;
    }
    $this->loadLayout();
    $this->renderLayout();
	}
}    