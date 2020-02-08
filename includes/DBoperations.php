<?php

class DBoperations{

    private $conn;

    function __construct(){
        include_once dirname(__FILE__).'./DBconnect.php ';

        $db = new DBconnect();

        $this->conn = $db -> connect();
    }

    /*CRUD -> C -> CREATE*/

    public function createUser($username, $password, $email){
        if($this->isUserExist($username, $email)){

            return 0;
        
        }else{
   
        $password = md5($password);
        $stmt = $this->conn->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, ?,?,?);");

        $stmt->bind_param("sss", $username, $password, $email);

        if($stmt->execute()){
            return 1;
        }else{
            return 2;
        }
      }        
    }

    public function userLogin($username, $pass){
        $upass = md5($pass);
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username=? AND password=?");
        $stmt->bind_param("ss",$username, $upass);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows>0;
    }

    public function getUserByUsername($username){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute(); 
        return $stmt->get_result()->fetch_assoc();
        
    }

    private function isUserExist($username, $email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users where username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows>0;
    }

}