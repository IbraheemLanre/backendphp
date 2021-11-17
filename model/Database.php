<?php
class Database{
    protected $connection = null;
    private $DB_HOST = "localhost";
    private $DB_USERNAME = "root";
    private $DB_PASSWORD = "";
    private $DB_NAME = "productdb";

    public function getDB(){
        try{
            $this->connection = new mysqli($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);

            if(mysqli_connect_errno()){
                throw new Exception("Could not connect to database.");
            }
        }catch(\Exception $e){
            throw new Exception($e->getMessage());
        }

        return $this->connection;
    }
 }
?>