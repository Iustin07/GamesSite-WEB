<?php

include_once('../../model/connection/Connection.php');

class OrderRepository
{
    private static $selectQuery =
        "select o.id_order, o.id_user, o.payment, o.finalized from orders o";
    //needed ? for knowing orders of an user?
    private static $selectWhereUserId =
        "select o.id_order, o.payment, o.finalized from orders o where o.id_user=:idUser";

    private static $selectWhereUserIdAndFinalized =
        "select o.id_order, o.payment, o.finalized from orders o where o.id_user=:idUser and o.finalized=:final";

    private static $updateFinalizedWhereUserIdAndNotFinalized =
        "update orders set finalized='yes' where id_user=:id and finalized='no'";
    //
    private static $selectWhereOrderId =
        "select o.id_order, o.id_user, o.payment, o.finalized from orders o where o.id_order=:idOrder";
    //need autoincrement
    private static $insertOrderQuery =
        "insert into orders(id_user, payment) values(?, ?)";
    //untested
    private static $deleteOrderByUserId =
        "delete from orders where id_user=:id";

    private static $deleteOrderByOrderId =
        "delete from orders where id_order=:id";

    private static $deleteAllWhereUserIdAndNotFinalized=
        "delete from orders where id_user=:idUser and finalized='no'";

    /**
     * OrderRepository constructor.
     */
    public function __construct()
    {
    }

    public function findAllOrders()
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectQuery);
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

    public function findUserOrdersById($ID_USER)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereUserId);
            $stmt->bindParam(':idUser', $ID_USER);
            $stmt->execute();
            $resultSet = $stmt->fetchAll();
            $arrayUsers = array();
            foreach ($resultSet as $row) {
                array_push($arrayUsers, $row);
            }
            return $arrayUsers;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function findOrdersWhereUserIdAndNotFinalized($ID_USER, $final)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereUserIdAndFinalized);
            $stmt->bindParam(':idUser', $ID_USER);
            $stmt->bindParam(':final', $final);
            $stmt->execute();
            return $stmt->fetch();
            /*$resultSet = $stmt->fetch();
            $arrayUsers = array();
            foreach ($resultSet as $row) {
                array_push($arrayUsers, $row);
            }
            return $arrayUsers;*/
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function findOrderById($ID_ORDER)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereOrderId);
            $stmt->bindParam(':idOrder', $ID_ORDER);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function updateWhereUserIdAndNotFinalized($ID){
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$updateFinalizedWhereUserIdAndNotFinalized);
            $stmt->bindParam(':idUser', $ID);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function addOrder(Order $order)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$insertOrderQuery);
            $idUser = $order->getUserId();
            $payment = $order->getPayment();
            $stmt->bindParam(1, $idUser);
            $stmt->bindParam(2, $payment);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteOrderByUserId($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteOrderByUserId);

            $stmt->bindParam(':id', $ID);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteOrderByOrderId($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteOrderByOrderId);

            $stmt->bindParam(':id', $ID);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteOrdersWhereNotFinalized($id_user)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteAllWhereUserIdAndNotFinalized);

            $stmt->bindParam(':id', $id_user);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}