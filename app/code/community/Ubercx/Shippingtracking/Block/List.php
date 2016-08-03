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
 * Uctracker List block
 *
 * @category    Ubercx
 * @package     Ubercx_Shippingtracking
 * @author	    Ubercx Developer <ubercx_nospam@jframeworks.com>
 */
class Ubercx_Shippingtracking_Block_List extends Mage_Shipping_Block_Tracking_Popup
{
	/**
   *  Check if ubercx tracking is enable
   *
   *  @return	  string
   */
	public function isEnabled()
	{
  	return Mage::getStoreConfig('shippingtracking/shippingtracking_settings/shippingtracking_active');
  }//end function
  
	/**
   *  Get ubercx user_key set in config
   *
   *  @return	  string
   */
  public function getUserKey ()
  {
    $api_key = Mage::getStoreConfig('shippingtracking/shippingtracking_settings/shippingtracking_user_key');
    return $api_key;
  }//end funcion
  
  /**
   *  Ubercx api call via curl
   * 	Return array derived from json reponse from api 
   *
   * 	@var $track_id string
   * 	@var $carrier_code string
   *  @return array
   */
  public function getTrackingList($track_id,$carrier_code)
  {
		//Supported shipping codes
		$supportedCodes = array('ups','usps','fedex','dhlint','dhl');
	    		
		if(!in_array($carrier_code,$supportedCodes)){
			return 'No Tracking available for this carrier via UberCX Shipping Tracking Plugin.';
		}
		
		if($carrier_code=='dhlint')
			$carrier_code = 'dhl';
		
		$base_url = Mage::getStoreConfig('shippingtracking/ubercx_api_url');
		// URL to post to
	    $base_url = str_replace('CARRIER_CODE',strtoupper($carrier_code),$base_url);
	  	$url = str_replace('TRACK_ID',$track_id,$base_url);
	 		// Start cURL
		$curl = curl_init();
	
		// Headers
		$headers = array();
		$headers[] = 'user_key:'.$this->getUserKey();
		
		curl_setopt( $curl, CURLOPT_URL, $url );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $curl, CURLOPT_HEADER, false);

		// Get response
		$response = curl_exec($curl);
	
		// Get HTTP status code
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		// Close cURL
		curl_close($curl);
				
		// Return response from server
		if($status==200 && $response!=''){
			$response = json_decode($response);	
		}
		elseif($status==403){
			$response = "Please check your UberCX developer user key.";
		}
		else{
			$response = "There is no tracking available.";
		}
		return $response;
  }//end funcion  
}