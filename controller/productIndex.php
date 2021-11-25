<?php
include('ProductController.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$conn = new Connection();

$url=$_SERVER['SERVER_NAME'];
//echo '$url';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query=parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
//echo 'acesta este';
//echo($uri). "\n";
$uri = explode( '/', $uri );
//print_r($uri);
// all of our endpoints start with /person
// everything else results in a 404 Not Found
if ($uri[4] !== 'product') {
    header("HTTP/1.1 404 Not Found");
    exit();
}
$productId = null;
$productName=null;
$isColectional=-1;
if (isset($uri[5])) {
    if (is_numeric($uri[5])) {
        $productId = (int)$uri[5];
    } else {
        $cast = (string)$uri[5];
        $var2 = "auction";
        if (strcmp($cast, $var2) == 0) {
            $isColectional = 1;
        } else {
            if (strcmp($cast, "games") == 0) {
                $isColectional = 0;
            } else {
                $productName = (string)str_replace('%20', ' ', $cast);
            }
        }
}
}
$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and user ID to the PersonController and process the HTTP request:
$controller = new ProductController($conn, $requestMethod);
$controller->setProductId($productId);
$controller->setProductName($productName);
$controller->setIsColectional($isColectional);
$controller->processRequest();
?>