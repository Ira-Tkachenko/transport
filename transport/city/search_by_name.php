<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);

$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $city->search_by_name($keywords);
$num = $stmt->rowCount();

if($num>0){
    $cities_arr=array();
    $cities_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $city_item=array(
            "city_id" => $city_id,
            "name" => $name,
        );
        array_push($cities_arr["records"], $city_item);
    }

    echo json_encode($cities_arr);
}

else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>