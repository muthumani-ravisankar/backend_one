<?php
require_once "./../libs/Database.php";
require_once "./../libs/Users.php";

session_start();

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    
    if ($email && $password) {
        
        $result = users::login($email, $password);
        
        if ($result['result']) {
            
            $_SESSION['user'] = $result['user'];
            echo json_encode(['status' => 'success', 'message' => 'Login successful', 'user' => $result['user']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['message']]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please provide email and password.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
