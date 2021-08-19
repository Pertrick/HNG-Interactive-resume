<?php

session_start();

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
require 'C:\xampp\vendor\autoload.php';

/* If you installed PHPMailer without Composer do this instead: */
/*
require 'C:\PHPMailer\src\Exception.php';
require 'C:\PHPMailer\src\PHPMailer.php';
require 'C:\PHPMailer\src\SMTP.php';
*/

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$phpmailer = new PHPMailer();

if(isset($_POST['submit'])){
    // Get the submitted form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Check whether submitted data is not empty
    if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $statusMsg = 'Please enter your valid email.';
            $msgClass = 'errordiv';
        }else{
           
/* Open the try/catch block. */
try {
   /* Set the mail sender. */

$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.mailtrap.io';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = '86a7cd9beda8e0';
$phpmailer->Password = '015e232836666a';
 


 // Recipient email
            //$toEmail = 'user@example.com';
$emailSubject = 'Contact Request Submitted by '.$name;
$htmlContent = "<h2>Contact Request Submitted</h2>
                <h4>Name</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Subject</h4><p>'.$subject.'</p>
                <h4>Message</h4><p>'.$message.'</p>'";

$phpmailer->setFrom($email, $name);
$phpmailer->addReplyTo('info@mailtrap.io', 'Mailtrap');
$phpmailer->addAddress('pat-0f525f@inbox.mailtrap.io', 'Pat');
$phpmailer->Subject = $emailSubject;
$mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
    <p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>";
$phpmailer->Body = $htmlContent ;


if($phpmailer->send()){
    $statusMsg = 'Your contact request has been submitted successfully !';
    $msgClass = 'succdiv';
    $_SESSION['save'] = "<div class='good'>Details Sent Successfully!</div>";

        header('location:http://localhost/creative-cv_free_1-1-0/');
            
    //echo 'Message has been sent';
}else{
    $_SESSION['save'] = "<div class='failed'>Failed to send details!</div>";
     header('location:http://localhost/creative-cv_free_1-1-0/');

                $statusMsg = 'Your contact request submission failed, please try again.';
                $msgClass = 'errordiv';

    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
}

}



catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
}
}
}
