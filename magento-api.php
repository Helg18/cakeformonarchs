<?php
/**
 * Example of retrieving the products list using Admin account via Magento REST API. OAuth authorization is used
 * Preconditions:
 * 1. Install php oauth extension
 * 2. If you were authorized as a Customer before this step, clear browser cookies for 'yourhost'
 * 3. Create at least one product in Magento
 * 4. Configure resource permissions for Admin REST user for retrieving all product data for Admin
 * 5. Create a Consumer
 */
// $callbackUrl is a path to your file with OAuth authentication example for the Admin user
$callbackUrl = "http://zierconsulting.com/cakeformonarchs/magento-api.php";
$temporaryCredentialsRequestUrl = "http://zierconsulting.com/cakeformonarchs/oauth/initiate?oauth_callback=" . urlencode($callbackUrl);
$adminAuthorizationUrl = 'http://zierconsulting.com/cakeformonarchs/admin/oauth_authorize';
$accessTokenRequestUrl = 'http://zierconsulting.com/cakeformonarchs/oauth/token';
$apiUrl = 'http://zierconsulting.com/cakeformonarchs/api/rest';
$resource = $_GET['resource'];
$consumerKey = 'c301fb7af2d3d3c0912bd92eeaf4a22f';
$consumerSecret = 'bd15a36b903118478aeff829d027f34a'; 
echo $resource;
session_start();
if (!isset($_GET['oauth_token']) && isset($_SESSION['state']) && $_SESSION['state'] == 1) {
    $_SESSION['state'] = 0;
} 
try {
    $authType = ($_SESSION['state'] == 2) ? OAUTH_AUTH_TYPE_AUTHORIZATION : OAUTH_AUTH_TYPE_URI;
    $oauthClient = new OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, $authType);
    $oauthClient->enableDebug();

    if (!isset($_GET['oauth_token']) && !$_SESSION['state']) {
        $requestToken = $oauthClient->getRequestToken($temporaryCredentialsRequestUrl);
        $_SESSION['secret'] = $requestToken['oauth_token_secret'];
        $_SESSION['state'] = 1;
        header('Location: ' . $adminAuthorizationUrl . '?oauth_token=' . $requestToken['oauth_token']);
        exit;
    } else if ($_SESSION['state'] == 1) {
        $oauthClient->setToken($_GET['oauth_token'], $_SESSION['secret']);
        $accessToken = $oauthClient->getAccessToken($accessTokenRequestUrl);
        $_SESSION['state'] = 2;
        $_SESSION['token'] = $accessToken['oauth_token'];
        $_SESSION['secret'] = $accessToken['oauth_token_secret'];
        header('Location: ' . $callbackUrl);
        exit;
    } else {
        $oauthClient->setToken($_SESSION['token'], $_SESSION['secret']);

        $resourceUrl = "$apiUrl/".$resource;
        $oauthClient->fetch($resourceUrl, array(), 'GET', array('Content-Type' => 'application/json'));
        $productsList = $oauthClient->getLastResponse();
        //echo $accessToken['oauth_token'];
        print_r($productsList);
    }
} catch (OAuthException $e) {
    //print_r($e->getMessage());
    //echo "&lt;br/&gt;";
    //print_r($e->lastResponse);
}