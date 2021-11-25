<?php


class Connection
{
    private static $serverName = 'localhost';
    private static $userName = 'root';
    private static $password = '';
    private static $connection = null;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
    }

    public function getConnection()
    {
        if (self::$connection != null) {
            return self::$connection;
        }
        try {
            self::$connection = new PDO("mysql:host=" . self::$serverName . ";dbname=game_changer", self::$userName, self::$password);
            // set the PDO error mode to exception
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /*echo "Connected successfully";*/
            return self::$connection;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * @param mixed $serverName
     */
    public function setServerName($serverName): void
    {
        self::$serverName = $serverName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        self::$userName = $userName;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        self::$password = $password;
    }

    /**
     * @param null $connection
     */
    public function setConnection($connection): void
    {
        self::$connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getServerName()
    {
        return self::$serverName;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return self::$userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return self::$password;
    }

}

?>