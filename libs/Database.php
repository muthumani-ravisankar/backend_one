<?php 



use PDOException;
use PDO;

class Database{
    private $servername;
    private $database;
    public static function getConnection(){
        try{
            $servername = "localhost";
            $username = "root"; 
            $password = "password123";
            $database = "backend_one"; 
       
            $conn = null;
            $msg =null;
       
            $conn = new PDO("mysql:host=". $servername .";dbname=" .$database, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $msg = "connection success";
            return $conn;

        }catch(PDOException $e){
            $conn = $e->getMessage();
            return  $conn;
        }
    }

    function get_con_string(){
        return "mysql:host=". $this->servername .";dbname=" .$this->database;
    }


}
