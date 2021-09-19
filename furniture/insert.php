<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database connection
include_once '../model/Database.php';
include_once '../objects/Furniture.php';

$DB_connection = new Database();
$db = $DB_connection->getDB();
$furniture = new Furniture($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->productId) && !empty($data->height) && !empty($data->width) && !empty($data->length)){
    $furniture->setProductId($data->productId);
    $furniture->setHeight($data->height);
    $furniture->setWidth($data->width);
    $furniture->setLength($data->length);

    if(($furniture->insert($furniture->getProductId(), $furniture->getHeight(), $furniture->getWidth(), $furniture->getLength()))){
        // set response code - 201 created
        http_response_code(201);

        echo json_encode([
            "success" => true,
            "message" => "Product added successfully!"]);
    }else{
        http_response_code(503);
        echo json_encode([
            "success" => false,
            "message" => "Unable to add product!"]);
    }
}else{
    // incomplete data
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Unable to add product."]);
}
?>