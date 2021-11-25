<?php

include_once('../repository/ProductRepository.php');
include_once('../models/Product.php');
include_once('../repository/UserRepository.php');
include_once('../models/User.php');
include_once('../repository/OrderRepository.php');
include_once('../models/Order.php');
include_once('../repository/OrderContentRepository.php');
include_once('../models/OrderContent.php');
include_once('../controller/ProductController.php');
class Main
{

    public static function mainFunction()
    {
//        $conn = new Connection();
//        $conn->setServerName("localhost");
//        $conn->setUserName("root");
//        $conn->setPassword("root");

        $productrepo= new ProductRepository();
        $productrepo->findProductById(3);
        echo '$productrepo';
//        $user = new UserRepository();
//        $product=new ProductRepository();
//        echo "<br>" . $user->findByEmail("paula.balint@yahoo.com")[2];
//        $products=$product->getProducts();
//        echo json_encode($products);
//        $requestMethod='GET';
//        $controller = new ProductController($conn, $requestMethod);
//        $controller->processRequest();
//        echo '\n';
//        echo '\n';
// echo 'alt rand';
 //$controller=new ProductController($conn,'GET');
// echo print_r($controller);
       // print_r($products);
        /*$user->addUser(new User("First", "Last", "myemeail@io.com",
            "07888888", "passs", 300));
        echo "<br>" . $user->findById(3)[2];*/
        /*    $product=new ProductRepository;

            $arrayUsers=$product->getProducts();
            foreach ($arrayUsers as $prod){
              // echo "$product=$val <br>";
                print_r($prod);
            }*/

        // echo "<br>" . $product->findProductByName('el grande')[1];
        //echo"<br>" . "insert";
        //$product->addProduct(new Product("Rusia", "../../auction-images/japonia.png", "35","cards", "10", "4-7","7.2"));
        // echo "<br>" . "delete by id";
        //$product->deleteProductByID(4);
        //echo "<br>" . "update";
        //$product->updateProduct(new Product("Rusia", "../asfsdfsd/asdasfdas.png", "37", "dsadfdsfa","50", "5-6","8.5"));
        //echo "<br>" . $product->findProductById(19)[1];
        //echo "<br>" . file_get_contents($product->findProductById(1)[2]);

        /*$order = new OrderRepository();
        echo "<br>" . "order";
        echo print_r($order->findOrderById(1)) . "<br>";
        // $order->addOrder(new Order("2","3","400s"));
//print_r($order->deleteOrderByUserId(2));
        print_r($order->findUserOrdersById(2));
        /*         "0788888888", "pass", 300));
             echo "<br>" . $user->findById(2)[1];
             //$user->deleteUserByID(11);
             $user->updateUser(new User("Luiza", "Balint", "paula.balint@yahoo.com", "0769696969",
             "pass", 700));*/
        /*$orderContent = new OrderContentRepository();
        echo "orders" . "<br>";
        print_r($orderContent->findOrderProducts(5));
        print_r($orderContent->findProductFromOrders(2));*/
//$user->deleteUserByID(2);
    }
}