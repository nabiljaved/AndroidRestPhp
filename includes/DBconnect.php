<?php

class DBconnect{
    private $conn;

    function __construct(){

    }

    function connect(){

        include_once dirname(__FILE__).'./constants.php ';
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if(mysqli_connect_errno()){
            echo "Failed to connect with Database".mysqli_connect_err();
        }else{
            return $this -> conn;
        }

    }
}