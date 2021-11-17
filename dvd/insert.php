<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: http://localhost", false);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database connection
include_once '../model/Database.php';
include_once '../objects/DVD.php';

$DB_connection = new Database();
$db = $DB_connection->getDB();
$dvd = new DVD($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->productId) && !empty($data->size)){
    $dvd->setProductId($data->productId);
    $dvd->setSize($data->size);
    
    if(($dvd->insert($dvd->getProductId(), $dvd->getSize()))){
        // set response code - 201 created
        http_response_code(201);

        echo json_encode([
            "success" => true,
            "message" => "Product added successfully!"]);
    }else{
        http_response_code(503);
        echo json_encode([
            "success" => false,
            "message" => "Unable to add product."]);
    }
}else{
    // incomplete data
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Unable to add product."]);
}
?>