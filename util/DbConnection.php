<?php

class DbConnection
{
    protected string $hostname = "127.0.0.1";
    protected string $username = "root";
    protected string $password = "";
    protected string $database = "city_log_booksystem";
    protected mysqli $conn;

    public function __destruct()
    {
        $this->conn->close();
    }
}