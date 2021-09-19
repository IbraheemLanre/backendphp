<?php
require('Product.php');

class Book extends Product{
    protected $weight;
    protected $tableName = 'book';

    public function __construct($db){
        $this->connection=$db;
    }

    public function setWeight($weight){
        $this->weight = $weight;
    }

    public function setTableName($tableName){
        $this->tableName = $tableName;
    }

    public function getWeight(){
        return $this->weight;
    }    

    public function getTableName(){
        return $this->tableName;
    }

    // get all products
    public function read(){
        
        $query = "SELECT * FROM product,book WHERE product.productId=book.productId";
        // $query = "SELECT * FROM " .$this->getTableName();

        // prepare query statement
        $stmt = $this->connection-> prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
        exit;
    }


    public function insert(){
        //query statement
        $query = "INSERT INTO " . $this->getTableName(). "(productId, weight) VALUES(?,?)";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // Sanitize
        $productId=htmlspecialchars(strip_tags($this->getProductId()));
        $weight=htmlspecialchars(strip_tags($this->getWeight()));

        // bind values
        $stmt->bind_param("dd", $productId, $weight);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

        exit;
    }

    // public function delete(){
    //     // query statement
    //     $query = "DELETE FROM ".$this->getTableName(). " WHERE productId=?";

    //     //prepare query
    //     $stmt = $this->connection->prepare($query);

    //     //sanitize
    //     $productId = htmlspecialchars(strip_tags($this->getProductId()));

    //     //bind productId of the recond to be deleted
    //     $stmt->bind_param('d', $productId);

    //     //execute query
    //     if($stmt->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    //     exit;
    // }
}
?>