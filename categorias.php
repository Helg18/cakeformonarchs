<?php 
$proxy = new SoapClient('http://kreativeco.com/cfm/api/v2_soap/?wsdl'); // TODO : change url
$sessionId = $proxy->login('admin', 'Sobr1n0'); // TODO : change login and pwd if necessary

$result = $proxy->catalogCategoryTree($sessionId);
var_dump($result);
 ?>