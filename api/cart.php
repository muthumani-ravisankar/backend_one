<?php
require_once "./../libs/Database.php";
require_once "./../libs/Cart.php";
require_once "./../libs/mail/MailSender.php";

session_start();

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $pid = $_POST['pid'] ?? null;
    $email = $_POST['uemail'] ?? null;
    $username=$_SESSION['user'] ;
    
    if ($email && $pid) {
        
        $result = cart::create($pname,$price, $email,$usename);
        
        if ($result['result']) {
            try{
                $mail = mailSender::send($pname,$price,$username,$email);
                echo json_encode(['status' => 'success', 'message' => 'Cart added and mail sent', 'user' => $result['user']]);
            }catch(Exceotion $e){
                echo json_encode(['status' => 'error', 'message' => 'Something went wrong']);
            }
            
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['message']]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please provide email and password.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
