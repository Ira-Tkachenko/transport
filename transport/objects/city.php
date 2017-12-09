<?php
class City{
    private $conn;
    private $table_name = "cities";

    public $city_id;
    public $name;

    public function __construct($db){
        $this->conn = $db;
    }

    function search_all(){

        $query = "SELECT * FROM cities";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function search_by_id($keywords){

        $query = "SELECT * FROM cities WHERE city_id=1";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_name($keywords){

        $query = "SELECT * FROM cities WHERE name LIKE '%Minsk%'";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }
}