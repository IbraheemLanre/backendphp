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

//get deleted data
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->productId)){
    // set product id
    $product->setProductId($data->productId);

    if($product->delete($product->getProductId())){
    
        // set response code 200 ok
        http_response_code(200);
        echo json_encode([
            "success" => true,
            "message" => "Product was deleted successfully!"]);
    }else{
        http_response_code(503);
        echo json_encode([
            "success" => false,
            "message" => "Unable to delete product."]);
        }
    

    }else{
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "message" => "Unable to delete product."
        ]);
    }  
?>