<?php

require_once "DbHelper.php";

class DbSeeder
{
    private string $tableName;
    private DbHelper $db;

    public function __construct($tableName)
    {
        $this->db = new DbHelper();
        $this->tableName = $tableName;
    }

    public function seed(array $data, bool $isArray = false)
    {
        $count = 0;
        if ($isArray === true) {
            foreach ($data as $datum) {
                $count += $this->db->addRecord($this->tableName, $datum);
            }
        } else {
            $count = $this->db->addRecord($this->tableName, $data);
        }

        return $count > 0 ? "'$this->tableName' table seeded \n"
            : "Error seeding '$this->tableName' table \n";
    }
}