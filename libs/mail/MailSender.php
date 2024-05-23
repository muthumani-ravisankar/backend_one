<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require '../../vendor/autoload.php';

class mailSender{

    
    public function send($pname,$price,$username,$to="221501068@rajalakshmi.edu.in") {        
        $sub="Product Addedd to cart: ";
        $mail = new PHPMailer(true);
        $message = "
        <html>
        <head>
        <title>$sub</title>
        </head>
        <body>
        <p>Hello $username,</p>
        <p>I am the Mail Bot, and I am delighted to share information, that you have added a product to your cart:</p>
        <ul>
        <li><strong>Product Name:</strong> $pname</li>
        <li><strong>product price:</strong> $price</li>
        <li><strong>Email Address:</strong> $email</li>
        </ul>
        <p>Thanks for visiting out site , waiting for your order to place</p>
        <p>Sincerely,<br>Madhanbalaji Kesavan</p>
        </body>
        </html>
        ";
        
        try {
            // SMTP settings
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'mail@gmail.com';
            $mail->Password = 'ijsg yhui ehyh ntne'; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587; 
            
            // Recipients
            $mail->setFrom('mail@gmail.com', 'bot@Email'); 
            $mail->addAddress($to, 'Manager'); 
            
            // Content
            $mail->isHTML(true); 
            $mail->Subject = $sub;
            $mail->Body = $message;
            
            // Send email
            $mail->send();
            return 'Message: Email has been sent successfully';
        } catch (Exception $e) {
            throw new Exception("Error: Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
        
    }   
}