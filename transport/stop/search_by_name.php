<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/stop.php';

$database = new Database();
$db = $database->getConnection();

$stop = new stop($db);

$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $stop->search_by_name($keywords);
$num = $stmt->rowCount();

if($num>0){
    $stops_arr=array();
    $stops_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $stop_item=array(
            "stop_id" => $stop_id,
            "city_id" => $city_id,
            "name" => $name,
        );
        array_push($stops_arr["records"], $stop_item);
    }

    echo json_encode($stops_arr);
}

else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>