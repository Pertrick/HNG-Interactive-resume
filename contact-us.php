<?php

session_start();


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
        }
        else{
               $_SESSION['save'] = "<div class='good'>Details Sent Successfully!</div>";

                header('location:resumeemaker.herokuapp.com/index');
            
    //echo 'Message has been sent';
}

}
}

else{
    $_SESSION['save'] = "<div class='failed'>Failed to send details!</div>";
     header('location:resumeemaker.herokuapp.com/index');

                


}

