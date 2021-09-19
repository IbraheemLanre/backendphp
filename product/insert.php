<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database connection
include_once '../model/Database.php';
include_once '../objects/Product.php';

$DB_connection = new Database();
$db = $DB_connection->getDB();
$product = new Product($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->sku) && !empty($data->name) && !empty($data->price)){
    $product->setSKU($data->sku);
    $product->setName($data->name);
    $product->setPrice($data->price);

    if(($product->insert($product->getSKU(), $product->getName(), $product->getPrice()))){
        // set response code - 201 created
        http_response_code(201);

        echo json_encode([
            "success" => true,
            "message" => "Product added successfully!"]);
    }else{
        http_response_code(503);
    }
}else{
    // incomplete data
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Unable to add product."]);
}
?>