<?php
require_once "./../libs/Database.php";
require_once "./../libs/Users.php";


$u = new users();

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($username != null && $phone != null && $email != null) {
        $result = users::register($username, $email, $phone, $password);
        
        if ($result['result']) {
            echo json_encode(['status' => 'success', 'message' => 'Signup successful']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['message']]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please provide needed credential details.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
