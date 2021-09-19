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

//     public function select($query="", $params = []){
//         try{
//             $stmt=$this->executeStatement($query, $params);
//             $result = $stmt->get_result()->fetch_assoc(MYSQLI_ASSOC);
//             return $result;
//         }catch(\Exception $e){
//             throw new Exception($e->getMessage());
//         }
//     }

//     private function executeStatement($query="", $params=[]){
//         try{
//             $stmt = $this->connection->prepare($query);
//             if($stmt===false){
//                 throw new Exception("Unable to do prepare statement: ". $query);
//             }
//             if($params){
//                 $stmt->bind_param($params[0], $params[1]);
//             }
//             $stmt->execute();

//             return $stmt;

//         }catch(\Exception $e){
//             throw new Exception($e->getMessage());
//         }
//     }
 }
?>