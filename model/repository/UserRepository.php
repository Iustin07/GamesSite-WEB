<?php

include_once('../../model/connection/Connection.php');

class UserRepository
{
    private static $selectQuery =
        "select u.ID, u.FNAME, u.LNAME, u.EMAIL, u.PHONE_NUMBER, u.PASSWORD, u.MONEY_SPENT from USERS u";
    private static $selectWhereId =
        "select u.ID, u.FNAME, u.LNAME, u.EMAIL, u.PHONE_NUMBER, u.PASSWORD, u.MONEY_SPENT  from USERS u where u.ID=:id";
    private static $selectWhereEmail =
        "select u.ID, u.FNAME, u.LNAME, u.EMAIL, u.PHONE_NUMBER, u.PASSWORD, u.MONEY_SPENT  from USERS u where u.EMAIL=:email";
    private static $insertQuery =
        "insert into USERS(FNAME, LNAME, EMAIL, PHONE_NUMBER, PASSWORD, MONEY_SPENT) 
         values(:fName, :lName, :eMail, :phoneNumber, :passWd, :moneySpent)";
    private static $deleteById =
        "delete from USERS where ID=:id";
    private static $deleteByEmail =
        "delete from USERS where EMAIL=:eMail";
    private static $updateById =
        "update USERS set FNAME=:fName, LNAME=:lName, EMAIL=:eMail, PHONE_NUMBER=:phoneNumber,
                 PASSWORD=:passWd, MONEY_SPENT=:moneySpent where ID=:id";

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return array|string
     */
    public function getUsers()
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectQuery);
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


    /**
     * @param $ID
     * @return mixed
     */
    public function findById($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereId);
            $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param $EMAIL
     * @return mixed
     */
    public function findByEmail($EMAIL)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereEmail);
            $stmt->bindParam(':email', $EMAIL);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param User $user
     * @return int|string
     */
    public function addUser(User $user)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$insertQuery);
            $firstName = $user->getFirstName();
            $stmt->bindParam(':fName', $firstName);
            $lastName = $user->getLastName();
            $stmt->bindParam(':lName', $lastName);
            $email = $user->getEmail();
            $stmt->bindParam(':eMail', $email);
            $phoneNumber = $user->getPhoneNumber();
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $password = $user->getPassword();
            $stmt->bindParam(':passWd', $password);
            $moneySpent = $user->getMoneySpent();
            $stmt->bindParam(':moneySpent', $moneySpent);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $ID
     * @return int|string
     */
    public function deleteUserByID($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteById);
            $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $EMAIL
     * @return int|string
     */
    public function deleteUserByEmail($EMAIL)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteByEmail);
            $stmt->bindParam(':eMail', $EMAIL);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param User $user
     * @return int|string
     */
    public function updateUser(User $user)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$updateById);
            $id = self::findByEmail($user->getEmail())[0];
            $firstName = $user->getFirstName();
            $stmt->bindParam(':fName', $firstName);
            $lastName = $user->getLastName();
            $stmt->bindParam(':lName', $lastName);
            $email = $user->getEmail();
            $stmt->bindParam(':eMail', $email);
            $phoneNumber = $user->getPhoneNumber();
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $password = $user->getPassword();
            $stmt->bindParam(':passWd', $password);
            $moneySpent = $user->getMoneySpent();
            $stmt->bindParam(':moneySpent', $moneySpent);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}

?>