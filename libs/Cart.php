<?php

require_once "./Database.php";

use PDO;
use PDOException;

class cart {
    
    public function __construct(){
        $this->db = Database::getConnection();
        $this->table = "cart";
    }
    
    public function create($pname,$price,$uemail,$username){
        try{
            $password = password_hash($password,PASSWORD_DEFAULT);
            $query = "INSERT INTO `$this->table` (pname,price, uemail,username) VALUES (:pname,:price, :uemail,:username)";
            $stmt = $this->db->prepare($query);
            $stmt->bindparam(":pname",$pname);
            $stmt->bindparam(":price",$price);
            $stmt->bindparam(":uemail",$email);
            $stmt->bindparam(":usename",$username);
            $stmt->execute();
            
            return [
                "result" => true,
                "message" => "cart added" 
            ];
            
        }catch(PDOException $e){
            return [
                "result" => false,
                "message" => $e->getMessage()
            ];
            
        }
        
    }
    
    public  function login($email,$password){
        try{
            $query = "SELECT * FROM `$this->table` WHERE username = :user OR email = :user OR phone = :user";
            $stmt = $this->db->prepare($query);
            $stmt->bindparam(":user",$username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $password_hash = $result['password'];
            if(password_verify($password,$password_hash)){
                Session::start();
                $_SESSION['username'] = $result['username'];
                $_SESSION['uid'] = $result['id'];
                return $result['username'];
            }else{
                return "Incorrect password , Try again";
            }
        }catch(PDOException $e){
            return [
                "result"=> false,
                "message"=> $e->getMessage()
            ];
        }
    }
}