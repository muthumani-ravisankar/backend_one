<?php

require_once "./Database.php";

use PDO;
use PDOException;

class users{
    
    public function __construct(){
        $this->db = Database::getConnection();
        $this->table = "users";
    }
    
    public function register($username,$email,$phone,$password){
        try{
            $password = password_hash($password,PASSWORD_DEFAULT);
            $query = "INSERT INTO `$this->table` (username, email, phone, password) VALUES (:user, :email, :phone, :password)";
            $stmt = $this->db->prepare($query);
            $stmt->bindparam(":user",$username);
            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":phone",$phone);
            $stmt->bindparam(":password",$password);
            $stmt->execute();
            
            return [
                "result" => true,
                "message" => "sigunup success" 
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