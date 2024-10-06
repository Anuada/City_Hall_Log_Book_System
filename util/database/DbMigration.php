<?php

require_once "DbConnection.php";

class DbMigration extends DbConnection
{
    private $tableName;
    private $columns = [];
    private $primaryKey = null;
    private $foreignKeys = [];

    public function __construct($tableName)
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Check if the database exists
        $this->createDatabaseIfNotExists();

        // Now connect to the specified database
        $this->conn->select_db($this->database);

        if ($this->conn->error) {
            die("Database selection failed: " . $this->conn->error);
        }

        $this->tableName = $tableName;
    }

    public function addColumn($name, $type, $nullable = false, $default = null, $auto_increment = false)
    {
        $column = "`$name` $type";

        // Add NULL or NOT NULL constraint
        $column .= $nullable ? " NULL" : " NOT NULL";

        $column .= $auto_increment ? " AUTO_INCREMENT" : "";

        // Add DEFAULT value if provided
        if ($default !== null) {
            if (is_string($default) && $default !== 'CURRENT_TIMESTAMP') {
                $default = "'$default'";
            }
            $column .= " DEFAULT $default";
        }

        $this->columns[] = $column;
        return $this;
    }

    public function addPrimaryKey($columnName)
    {
        $this->primaryKey = $columnName;
        return $this;
    }

    public function addForeignKey($columnName, $referencedTable, $referencedColumn, $onDelete = 'CASCADE', $onUpdate = 'CASCADE')
    {
        $this->foreignKeys[] = "FOREIGN KEY (`$columnName`) REFERENCES `$referencedTable`(`$referencedColumn`) ON DELETE $onDelete ON UPDATE $onUpdate";
        return $this;
    }

    public function create()
    {
        $columnsSQL = implode(", ", $this->columns);

        // Add primary key if defined
        if ($this->primaryKey) {
            $columnsSQL .= ", PRIMARY KEY (`$this->primaryKey`)";
        }

        // Add foreign keys if defined
        if (!empty($this->foreignKeys)) {
            $columnsSQL .= ", " . implode(", ", $this->foreignKeys);
        }

        try {
            // Final SQL for creating the table
            $sql = "CREATE TABLE IF NOT EXISTS `$this->tableName` ($columnsSQL) ENGINE=InnoDB";

            $query = $this->conn->query($sql);

            if ($query === true) {
                return "Created '$this->tableName' table \n";
            } else {
                throw new Exception('Error Creating table: ' . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage() . " \n";
        }
    }
}