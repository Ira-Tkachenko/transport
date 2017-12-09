<?php
class Stop{
    private $conn;
    private $table_name = "stops";

    public $stop_id;
    public $city_id;
    public $name;

    public function __construct($db){
        $this->conn = $db;
    }

    function search_all(){

        $query = "SELECT * FROM stops";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function search_by_id($keywords){

        $query = "SELECT * FROM stops WHERE stop_id=1";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_name($keywords){

        $query = "SELECT * FROM stops where name LIKE '%Funny%'";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }
}