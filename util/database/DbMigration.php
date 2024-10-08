<?php

require_once "DbConnection.php";
require_once "DbHelper.php";

class DbMigration extends DbConnection
{
    private $tableName;
    private $columns = [];
    private $modifiedColumns = [];
    private DbHelper $db;

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
        $this->db = new DbHelper();

        $this->tableName = $tableName;
    }

    public function addColumn($name, $type, $nullable = false, $default = null, $auto_increment = false)
    {
        $column = "`$name` $type";

        $column .= $nullable ? " NULL" : " NOT NULL";

        $column .= $auto_increment ? " AUTO_INCREMENT" : "";

        if ($default !== null) {
            if (is_string($default) && $default !== 'CURRENT_TIMESTAMP') {
                $default = "'$default'";
            }
            $column .= " DEFAULT $default";
        }

        $this->columns[] = $column;
        return $this;
    }

    public function renameColumn($name, $rename, $type, $nullable = false)
    {
        $column = "CHANGE `$name` $rename $type";

        $column .= $nullable ? " NULL" : " NOT NULL";

        $this->modifiedColumns[] = $column;
        return $this;
    }

    public function modifyColumn($name, $type, $nullable = false, $default = null, $auto_increment = false)
    {
        $column = "MODIFY `$name` $type";

        $column .= $nullable ? " NULL" : " NOT NULL";

        $column .= $auto_increment ? " AUTO_INCREMENT" : "";

        if ($default !== null) {
            if (is_string($default) && $default !== 'CURRENT_TIMESTAMP') {
                $default = "'$default'";
            }
            $column .= " DEFAULT $default";
        }

        $this->modifiedColumns[] = $column;
        return $this;
    }

    public function dropColumn($name)
    {
        $column = "DROP COLUMN `$name`";
        $this->modifiedColumns[] = $column;
        return $this;
    }

    public function addPrimaryKey($columnName)
    {
        $column = "PRIMARY KEY (`$columnName`)";
        $this->columns[] = $column;
        return $this;
    }

    public function addForeignKey($columnName, $referencedTable, $referencedColumn, $onDelete = 'CASCADE', $onUpdate = 'CASCADE')
    {
        $column = "FOREIGN KEY (`$columnName`) REFERENCES `$referencedTable`(`$referencedColumn`) ON DELETE $onDelete ON UPDATE $onUpdate";
        $this->columns[] = $column;
        return $this;
    }

    public function dropPrimaryKey()
    {
        $column = "DROP PRIMARY KEY";
        $this->modifiedColumns[] = $column;
        return $this;
    }

    public function dropForeignKey($columnName)
    {
        $foreign_key_name = $this->db->foreignKeyNameFinder($this->tableName, $columnName);
        $column = "DROP FOREIGN KEY $foreign_key_name";
        $this->modifiedColumns[] = $column;
        return $this;
    }

    public function create()
    {
        try {
            $columnsSQL = implode(", ", $this->columns);

            $checkTable = "SHOW TABLES LIKE '$this->tableName'";
            $checkTableQuery = $this->conn->query($checkTable);

            if ($checkTableQuery->num_rows > 0) {
                return;
            }

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

    public function modify()
    {
        $columnsSQL = "";
        try {
            if (!empty($this->modifiedColumns)) {
                $columnsSQL = implode(", ", $this->modifiedColumns);
            } elseif (!empty($this->columns)) {
                $addColumns = array_map(function ($column) {
                    return "ADD $column";
                }, $this->columns);
                $columnsSQL = implode(", ", $addColumns);
            } else {
                throw new Exception("Nothing to modify");
            }

            $checkTable = "SHOW TABLES LIKE '$this->tableName'";
            $checkTableQuery = $this->conn->query($checkTable);
            if ($checkTableQuery->num_rows <= 0) {
                throw new Exception("'$this->tableName' table does not exists");
            }

            $sql = "ALTER TABLE `$this->tableName` $columnsSQL";

            $query = $this->conn->query($sql);

            if ($query === true) {
                return "Modified '$this->tableName' table \n";
            } else {
                throw new Exception('Error Modifying table: ' . $this->conn->error);
            }

        } catch (Exception $e) {
            return $e->getMessage() . " \n";
        }
    }

    public function dropTable()
    {
        try {
            $sql = "DROP TABLE IF EXISTS `$this->tableName`";

            $query = $this->conn->query($sql);

            if ($query === true) {
                return "Table '$this->tableName' deleted successfully \n";
            } else {
                throw new Exception('Error deleting table: ' . $this->conn->error);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}