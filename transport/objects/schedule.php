<?php
class schedule
{
    private $conn;
    private $table_name = "schedule";

    public $schedule_id;
    public $route_id;
    public $bus_id;
    public $schedule;

    public function __construct($db){
        $this->conn = $db;
    }
}