<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection
include_once '../model/Database.php';
include_once '../objects/Book.php';

// instantiate database and product classes
$DB_connection = new Database();
$db = $DB_connection->getDB();
$book = new Book($db);

// read products here
$result = $book->read();

if($result->num_rows > 0){
    $book_arr = [];
    while($row = $result -> fetch_assoc()){
        $id = $row['productId'];
        $weight=$row['weight'];

        $book_arr[] = $row;
    }
    //set response code - 200 ok
    http_response_code(200);

    // show products data in json format
    echo json_encode($book_arr);
}else{
    //set response code 404 Not Found
    http_response_code(404);

    echo json_encode([
        "success" => false,
        "message" => "No products found."
    ]);
}
?>