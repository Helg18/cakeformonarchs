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
 * @category   UBERCX
 * @package    Ubercx_Shippingtracking
 * @copyright  Copyright (c) 2015 Ubercx, Inc.
 * @author	   Ubercx Developer <ubercx_nospam@jframeworks.com>
 * @license    http://opensource.org/licenses/gpl-license GNU General Public License
 */


class Ubercx_Shippingtracking_Model_Info extends Mage_Shipping_Model_Info
{
	/**
	 * Retrieve all tracking by order id
	 *
	 * @return array
	 */
	public function getTrackingInfoByOrder()
	{
		$shipTrack = array();
		$order = $this->_initOrder();
	
		if ($order) {
			$shipments = $order->getShipmentsCollection();
			foreach ($shipments as $shipment){
				$increment_id = $shipment->getIncrementId();
				$tracks = $shipment->getTracksCollection();
				$trackingInfos=array();
				
				foreach ($tracks as $track){ 
					$trackingInfos[$track->getId()]['tracking_number'] = $track->getTrackNumber();
					$trackingInfos[$track->getId()]['title'] = $track->getTitle();
					$trackingInfos[$track->getId()]['carrier_code'] = $track->getCarrierCode();
				}
				$shipTrack[$increment_id] = $trackingInfos;
			}
		}
		$this->_trackingInfo = $shipTrack;
		return $this->_trackingInfo;
	}
	/**
	 * Retrieve all tracking by ship id
	 *
	 * @return array
	 */
	public function getTrackingInfoByShip()
	{
		$shipTrack = array();
		$shipment = $this->_initShipment();
		if ($shipment) {
			$increment_id = $shipment->getIncrementId();
			$tracks = $shipment->getTracksCollection();
			$trackingInfos=array();
			
			foreach ($tracks as $track){
				$trackingInfos[$track->getId()]['tracking_number'] = $track->getTrackNumber();
				$trackingInfos[$track->getId()]['title'] = $track->getTitle();
				$trackingInfos[$track->getId()]['carrier_code'] = $track->getCarrierCode();
			}
			$shipTrack[$increment_id] = $trackingInfos;
		}
		$this->_trackingInfo = $shipTrack;
		return $this->_trackingInfo;
	}

	/**
	 * Retrieve tracking by tracking entity id
	 *
	 * @return array
	 */
	public function getTrackingInfoByTrackId()
	{
		$track = Mage::getModel('sales/order_shipment_track')->load($this->getTrackId());
		$this->setShipId($track->getParentId());
		$shipment = $this->_initShipment(); 
		if ($shipment) {
			$increment_id = $shipment->getIncrementId();
			if ($track->getId() && $this->getProtectCode() == $track->getProtectCode()) {
				$this->_trackingInfo[$increment_id][$track->getId()]['tracking_number'] = $track->getTrackNumber();
				$this->_trackingInfo[$increment_id][$track->getId()]['title'] = $track->getTitle();
				$this->_trackingInfo[$increment_id][$track->getId()]['carrier_code'] = $track->getCarrierCode();
			}
		}	
		return $this->_trackingInfo;
	}
}