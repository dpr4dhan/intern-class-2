<?php

class Db {
    private string $hostname;
    private string $username;
    private string $password;
    private string $db_name;
    private $conn;
    private $stmt;

//    private $stmt;

    public function __construct()
    {
        $this->hostname = env('DB_HOST');
        $this->username = env('DB_USER');
        $this->password = env('DB_PASS');
        $this->db_name =  env('DB_NAME');
    }

    public function getConnection()
    {
        $conn = new mysqli($this->hostname, $this->username, $this->password, $this->db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->conn = $conn;
    }

    public function createStatement($query)
    {
        $this->getConnection();
        $stmt = $this->conn->prepare($query);
        $this->stmt = $stmt;
        return $this;
    }

    public function bindValues(string $types, array $valueArr)
    {
        $this->stmt->bind_param($types, ...$valueArr);
        return $this;
    }

    public function execute()
    {
        $this->stmt->execute();
        return $this;
    }
    public function getResult()
    {
        return $this->stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

}