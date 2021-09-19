<?php
require('BaseProduct.php');

class Product extends BaseProduct{

    protected $connection;
    protected $productId;
    protected $SKU;
    protected $name;
    protected $price;
    protected $tableName="product";

    public function __construct($db){
        $this->connection = $db;
    }

    public function setProductId($productId){
        $this->productId = $productId;
    }

    public function setSKU($SKU){
        $this->SKU = $SKU;
    }

    public function setName($name){
        $this->name=$name;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setTableName($tableName){
        $this->tableName = $tableName;
    }

    public function getProductId(){
        return $this->productId;
    }

    public function getSKU(){
        return $this->SKU;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getTableName(){
        return $this->tableName;
    }
    
    // get all products
    public function read(){
        // $query = "SELECT * FROM product,furniture WHERE product.productId=furniture.productId"; 
        
        $query = "SELECT * FROM " .$this->getTableName();

        // prepare query statement
        $stmt = $this->connection-> prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
        exit;
    }

    public function insert(){
        //query statement
        $query = "INSERT INTO " . $this->getTableName(). "(sku, name, price) VALUES(?,?,?)";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // Sanitize
        $sku=htmlspecialchars(strip_tags($this->getSKU()));
        $name = htmlspecialchars(strip_tags($this->getName()));
        $price=htmlspecialchars(strip_tags($this->getPrice()));

        // bind values
        $stmt->bind_param("ssd", $sku, $name, $price);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

        exit;
    }

    public function delete(){
        // query statement
        $query = "DELETE FROM ".$this->getTableName(). " WHERE productId=?";

        //prepare query
        $stmt = $this->connection->prepare($query);

        //sanitize
        $productId = htmlspecialchars(strip_tags($this->getProductId()));

        //bind productId of the recond to be deleted
        $stmt->bind_param('d', $productId);

        //execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        exit;
    }
}
?>