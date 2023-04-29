<?php

namespace Core\DBManager;

class MysqlConnectManager
{
    private $conn;

    public function __construct() {
        global $host;
        global $username;
        global $password;
        global $dbname;
        $this->conn = mysqli_connect($host, $username, $password, $dbname);
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function getConnection()
    {
        return $this->conn;
    }
}