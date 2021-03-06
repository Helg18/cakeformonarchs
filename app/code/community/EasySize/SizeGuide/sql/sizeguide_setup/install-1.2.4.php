<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$install = $this;
$install->startSetup();

$user = Mage::getSingleton('admin/session');
$user_email = urlencode($user->getUser()->getEmail());
$shop_doman = urlencode(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB));

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://internal-tracking.easysize.me/install?domain={$shop_doman}&email={$user_email}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: 6e549668-2f0a-1bad-3f47-a21f34bab086"
    ),
));

$response = curl_exec($curl);

curl_close($curl);


$install->endSetup();