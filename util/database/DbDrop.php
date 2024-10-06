<?php

require_once "DbConnection.php";

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
        try {
            $checkDB = "SHOW DATABASES LIKE '$this->database'";
            $checkDBQuery = $this->conn->query($checkDB);

            if ($checkDBQuery->num_rows <= 0) {
                throw new Exception("Database does not exists");
            }

            $dropDB = "DROP DATABASE $this->database";
            $dropDBQuery = $this->conn->query($dropDB);

            if ($dropDBQuery === true) {
                return "Database dropped successfully \n";
            } else {
                throw new Exception("Error Dropping Database: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage() . " \n";
        }
    }
}