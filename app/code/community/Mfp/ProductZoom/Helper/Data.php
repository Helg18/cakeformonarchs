<?php
class Mfp_ProductZoom_Helper_Data extends Mage_Core_Helper_Abstract
{

public function getUrl()
{
$base_url = Mage::getBaseUrl();
$js_url = str_replace("index.php","",$base_url);
return $js_url;
}
}
	 