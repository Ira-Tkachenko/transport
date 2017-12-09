<?php
class Route{
    private $conn;
    private $table_name = "routes";

    public $route_id;
    public $number;

    public function __construct($db){
        $this->conn = $db;
    }

    function search_all(){

        $query = "SELECT DISTINCT * FROM routes";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function search_by_id($keywords){

        $query = "SELECT * FROM routes WHERE route_id=1";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_number($keywords){

        $query = "SELECT * FROM routes WHERE  number LIKE '%18%'";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_stops($keywords){

        $query = "SELECT DISTINCT number FROM routes, orders, `schedule`, stops
                    WHERE (SELECT `order` FROM orders, stops 
                            WHERE `name`='Funny' AND orders.order_id=stops.stop_id)<
                        (SELECT `order` FROM orders, stops 
                               WHERE `name`='Nice' AND orders.order_id=stops.stop_id)
                    AND stops.stop_id=orders.stop_id
                    AND `schedule`.schedule_id=orders.schedule_id
                    AND routes.route_id=`schedule`.route_id";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_cities($keywords){

        $query = "SELECT DISTINCT number FROM routes, orders, `schedule`, stops, cities
                    WHERE cities.`name` IN ('Minsk', 'Gomel') AND stops.stop_id=orders.stop_id
                    AND `schedule`.schedule_id=orders.schedule_id
                    AND routes.route_id=`schedule`.route_id
                    AND stops.city_id=cities.city_id";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_currentTime($keywords){

        $query = "SELECT DISTINCT number,`schedule` FROM routes, orders, `schedule`, stops
                    WHERE `name`='Nice'
                    AND `schedule` BETWEEN CURTIME() AND ADDTIME(CURTIME(), '00:20:00')
                    AND stops.stop_id=orders.stop_id
                    AND `schedule`.schedule_id=orders.schedule_id
                    AND routes.route_id=`schedule`.route_id";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_all_by_stop($keywords){

        $query = "SELECT DISTINCT number FROM routes, orders, `schedule`, stops
                    WHERE `name`='Nice' AND stops.stop_id=orders.stop_id
                    AND `schedule`.schedule_id=orders.schedule_id
                    AND routes.route_id=`schedule`.route_id";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_time($keywords){

        $query = "SELECT DISTINCT number,`schedule` FROM routes, orders, `schedule`, stops
                    WHERE `name`='Nice'
                    AND `schedule` BETWEEN '09:27:00' AND ADDTIME('09:27:00', '00:20:00')
                    AND stops.stop_id=orders.stop_id
                    AND `schedule`.schedule_id=orders.schedule_id
                    AND routes.route_id=`schedule`.route_id";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_by_bus($keywords){

        $query = "SELECT routes.number FROM routes,`schedule`, buses
                    WHERE buses.bus_id=1 AND routes.route_id=`schedule`.route_id
                    AND buses.bus_id=`schedule`.schedule_id";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }

    function search_all_by_city($keywords){

        $query = "SELECT DISTINCT number FROM routes, orders, `schedule`, stops, cities
                    WHERE cities.`name`='Minsk' AND stops.stop_id=orders.stop_id
                    AND `schedule`.schedule_id=orders.schedule_id
                    AND routes.route_id=`schedule`.route_id
                    AND stops.city_id=cities.city_id";

        $stmt = $this->conn->prepare($query);

        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);

        $stmt->execute();

        return $stmt;
    }
}