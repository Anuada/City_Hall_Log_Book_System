<?php

class DbHelper
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "city_log_booksystem";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }

    public function __destruct()
    {
        $this->conn->close();
    }



    public function fetchRecords_limit($table, $start = 0, $limit = 10)
    {
        $sql = "SELECT * FROM `$table` LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $start, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }




    public function fetchTotalRecords($table)
    {
        $sql = "SELECT COUNT(*) as count FROM `$table`";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }


    #Delete record/s


    public function deleteRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $condition = $this->condition($key, $value, "0", " AND ");
        $sql = "DELETE FROM `$table` WHERE $condition";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    #Add record/s
    public function addRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $keys = implode("`, `", $key);
        $values = implode("', '", $value);
        $sql = "INSERT INTO `$table` (`$keys`) VALUES ('$values')";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    #Update record/s
    public function updateRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $set = $this->condition($key, $value, "1", ", ");
        $sql = "UPDATE `$table` SET $set WHERE `$key[0]` = '$value[0]'";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    public function getCurrentYear()
    {
        $sql = "SELECT CURRENT_DATE AS `currentDate`";
        $query = $this->conn->query($sql);
        $date = $query->fetch_assoc();
        $year = date("Y", strtotime($date["currentDate"]));
        return $year;
    }
    private function condition($key, $value, $index, $implode)
    {
        $condition = [];
        for ($i = $index; $i < count($key); $i++) {
            $condition[] = "`" . $key[$i] . "` = '" . $value[$i] . "'";
        }
        $cond = implode($implode, $condition);
        return $cond;
    }

    public function getAllLogs()
    {
        $sql = "SELECT `id`, CONCAT(`fname`,' ',`lname`) AS `title`, `purpose`, `type`, `status`, DATE_FORMAT(`date`, '%Y-%m-%d') AS `start`, DATE_FORMAT(`date`, '%Y-%m-%d') AS `end`, DATE_FORMAT(`date`, '%I:%i %p') AS `time` FROM `visitor_info`";
        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    // All total of clients by monthly
    public function allClients($month)
    {
        $sql = "SELECT 
                    COUNT(CASE WHEN type = 'Employee' THEN 1 END) AS employee_count,
                    COUNT(CASE WHEN type = 'Visitor' THEN 1 END) AS visitor_count
                FROM 
                    visitor_info
                WHERE
                    DATE_FORMAT(date, '%Y-%m') = '$month' AND status = 'Accepted'
                ";
        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }
}
