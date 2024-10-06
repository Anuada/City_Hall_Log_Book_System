<?php

require_once "util/DbConnection.php";

class DbDrop extends DbConnection
{
    public function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function drop()
    {
        $checkDB = "SHOW DATABASES LIKE '$this->database'";
        $checkDBQuery = $this->conn->query($checkDB);

        if ($checkDBQuery->num_rows <= 0) {
            return "Database does not exists \n";
        }

        $dropDB = "DROP DATABASE $this->database";
        $dropDBQuery = $this->conn->query($dropDB);

        return $dropDBQuery === true ?
            "Database dropped successfully \n" :
            "Error Dropping Database: " . $this->conn->error;
    }
}