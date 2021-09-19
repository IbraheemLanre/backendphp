<?php
require('Product.php');

class DVD extends Product{
    protected $size;
    protected $tableName = 'dvd';

    public function __construct($db){
        $this->connection=$db;
    }

    public function setSize($size){
        $this->size = $size;
    }

    public function setTableName($tableName){
        $this->tableName = $tableName;
    }

    public function getSize(){
        return $this->size;
    }    

    public function getTableName(){
        return $this->tableName;
    }

    // get all products
    public function read(){    
        $query = "SELECT * FROM product,dvd WHERE product.productId=dvd.productId";
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
        $query = "INSERT INTO " . $this->getTableName(). "(productId, size) VALUES(?,?)";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // Sanitize
        $productId=htmlspecialchars(strip_tags($this->getProductId()));
        $size=htmlspecialchars(strip_tags($this->getSize()));

        // bind values
        $stmt->bind_param("dd", $productId, $size);

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