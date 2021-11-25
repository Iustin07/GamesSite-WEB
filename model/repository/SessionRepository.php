<?php
include_once('../../model/connection/Connection.php');

class SessionRepository
{
    private static $selectQuery= "select s.ID, s.ID_USER, s.TOKEN, s.SERIAL  from SESSIONS s";

    private static $selectWhereUserId =
        "select s.ID, s.ID_USER, s.TOKEN, s.SERIAL  from SESSIONS s where s.ID_USER=:id_user";
    private static $selectWhereToken =
        "select s.ID, s.ID_USER, s.TOKEN, s.SERIAL  from SESSIONS s where s.TOKEN=:token";
    private static $selectWhereId =
        "select s.ID, s.ID_USER, s.TOKEN, s.SERIAL  from SESSIONS s where s.ID=:id";

    private static $insertQuery =
        "insert into SESSIONS(ID_USER, TOKEN, SERIAL) values(:id_user, :token, :serial)";

    private static $deleteById =
        "delete from SESSIONS s where s.ID=:id";
    private static $deleteByUserId =
        "delete from SESSIONS s where s.ID_USER=:id_user";

    private static $updateByUserId =
        "update SESSIONS set TOKEN=:token, SERIAL=:serial where ID_USER=:id_user";

    /**
     * SessionRepository constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return array|string
     */
    public function findAll(){
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectQuery);
            $stmt->execute();
            $resultSet = $stmt->fetchAll();

            $arraySessions = array();
            foreach ($resultSet as $row) {
                array_push($arraySessions, $row);
            }
            return $arraySessions;
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
     * @param $ID
     * @return mixed|string
     */
    public function findByUserId($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereUserId);
            $stmt->bindParam(':id_user', $ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param $token
     * @return mixed|string
     */
    public function findByToken($token)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereToken);
            $stmt->bindParam(':token', $token, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Session $session
     * @return int|string
     */
    public function addSession(Session $session)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$insertQuery);
            $id_user = $session->getIdUser();
            $stmt->bindParam(':id_user', $id_user);
            $token = $session->getToken();
            $stmt->bindParam(':token', $token);
            $serial = $session->getSerial();
            $stmt->bindParam(':serial', $serial);
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
    public function deleteSessionByID($ID)
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
     * @param $ID
     * @return int|string
     */
    public function deleteSessionByUserId($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteByUserId);
            $stmt->bindParam(':id_user', $ID);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param Session $session
     * @return int|string
     */
    public function updateSession(Session $session)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$updateByUserId);
            $id = self::findByUserId($session->getIdUser())[0];
            $token = $session->getToken();
            $stmt->bindParam(':token', $token);
            $serial = $session->getSerial();
            $stmt->bindParam(':serial', $serial);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}