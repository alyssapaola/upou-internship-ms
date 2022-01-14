<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";

//$user_name = mysqli_real_escape_string($con, $_POST["user_name"]);  
//$user_pass
 $error = "";
 
//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

//From email address and name
$mail->From = "alyssa.pocaan@gmail.com";
$mail->FromName = "Alyssa";

//To address and name
$mail->addAddress($user_name);
//$mail->addAddress("recepient1@example.com"); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("noreply@company.com", "Reply");

//CC and BCC
//$mail->addCC("cc@example.com");
//$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "WEB IMS Login Credentials";
$mail->Body = "Username: ".$user_name."<br> Password ".$user_pass;
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
   // echo "Message has been sent successfully";
   $error = "0";
} catch (Exception $e) {
  //  echo "Mailer Error: " . $mail->ErrorInfo;
    $error = "1";
}
?>