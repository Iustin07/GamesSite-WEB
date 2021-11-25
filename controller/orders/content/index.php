<?php

/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../controller/OrderContentController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$uriQuery = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$split = null;
if(isset($uriQuery)){
    $split = explode("=", $uriQuery);
}

$orderId = null;
$productId = null;

if(!empty($split)){
    if($split[0] == 'id_order'){
        $orderId = (int)$split[1];
    }
    if($split[0] == 'id_product'){
        $userId = (int)$split[1];
    }
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$controller = new OrderContentController($requestMethod, $orderId, $productId);
$controller->processRequest();

?>