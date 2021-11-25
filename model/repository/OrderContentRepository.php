<?php

include_once('../../../model/connection/Connection.php');

class OrderContentRepository
{

    private static $selectOrderProducts =
        "select oc.id_product from order_content oc where oc.id_order=:idOrder";
    private static $selectProductFromOrders =
        "select oc.id_order from order_content oc where oc.id_product=:idProduct";
    private static $insertOrderContentQuery =
        "insert into order_content(id_order, id_product) values(?, ?)";

    public function __construct()
    {
    }

    public function findOrderProducts($ORDERID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectOrderProducts);
            $stmt->bindParam(':idOrder', $ORDERID);
            $stmt->execute();
            $resultSet = $stmt->fetchAll();

            $arrayProducts = array();
            foreach ($resultSet as $row) {
                array_push($arrayProducts, $row);
            }
            return $arrayProducts;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function findProductFromOrders($PRODUCTID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectProductFromOrders);
            $stmt->bindParam(':idProduct', $PRODUCTID);
            $stmt->execute();

            $resultSet = $stmt->fetchAll();

            $arrayOrders = array();
            foreach ($resultSet as $row) {
                array_push($arrayOrders, $row);
            }
            return $arrayOrders;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function addOrderContent(OrderContent $orderContent)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$insertOrderContentQuery);
            $orderid = $orderContent->getOrderId();
            $stmt->bindParam(1, $orderid);
            $productid = $orderContent->getProductId();
            $stmt->bindParam(2, $productid);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}