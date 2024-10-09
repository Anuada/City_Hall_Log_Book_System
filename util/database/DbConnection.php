<?php

/**
 * This class provides a set of methods for establishing a connection to a database and performing basic database operations.
 */
class DbConnection
{
    protected string $hostname = "127.0.0.1";
    protected string $username = "root";
    protected string $password = "";
    protected string $database = "city_log_booksystem";
    protected mysqli $conn;

    /**
     * This destructor closes the database connection when the object is destroyed.
     */
    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * Checks if a database exists and creates it if it does not. It uses the mysqli extension to execute a `CREATE DATABASE` query.
     * @return void
     */
    protected function createDatabaseIfNotExists()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS `$this->database`";
        if ($this->conn->query($sql) === false) {
            die("Error creating database: " . $this->conn->error);
        }
    }
}