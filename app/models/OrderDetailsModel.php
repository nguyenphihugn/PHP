<?php
class OrderDetailsModel
{
    private $conn;
    private $table_name = "orderdetails";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}