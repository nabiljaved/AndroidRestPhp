<?php
require_once '../includes/DBoperations.php ';
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email']))
    {
        //operate data

        if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))
        {
            $response['error'] = false;
            $response['message'] = "please fill all the fields";
            echo json_encode($response); //i show echo because if exit() is called then echo wont call
            exit();

        }
        
        $db = new DBoperations();
        

        $result = $db->createUser($_POST['username'], $_POST['password'], $_POST['email']);

        if($result == 1){
            //data is inserted
            $response['error'] = false;
            $response['message'] = "user registered successfully";
        }
        else if($result == 2) {
            //error data inserting
            $response['error'] = true;
            $response['message'] = "user failed to register";

        } else if($result == 0) {

        $response['error'] = true;
        $response['message'] = "you are already registered! please choose different username and email";
        
    }
    }else{
        $response['error'] = true;
        $response['message'] = "fields are empty"; 
    }

    }else{

        $response['error'] = true;
        $response['message'] = "invalid request"; 

    }

echo json_encode($response);