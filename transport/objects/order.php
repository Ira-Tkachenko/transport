<?php
class order
{
    private $conn;
    private $table_name = "orders";

    public $order_id;
    public $schedule_id;
    public $stop_id;
    public $order;

    public function __construct($db){
        $this->conn = $db;
    }

    function search_all(){

        $query = "SELECT DISTINCT * FROM buses";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}