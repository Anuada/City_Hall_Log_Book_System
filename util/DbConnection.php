<?php

class DbConnection
{
    protected string $hostname = "127.0.0.1";
    protected string $username = "root";
    protected string $password = "";
    protected string $database = "city_log_booksystem";
    protected mysqli $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}