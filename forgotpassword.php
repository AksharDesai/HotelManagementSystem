<?php

require("connection.php");

use PHPMailer\PHPmailer\PHPMailer;
use PHPMailer\PHPmailer\Exception;
use PHPMailer\PHPmailer\SMTP;

function sendMail($email, $reset_token)
{

    require('PHPmailer/Exception.php');
    require('PHPmailer/PHPMailer.php');
    require('PHPmailer/SMTP.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'forprojectpurpose150302024@gmail.com';                     //SMTP username
        $mail->Password   = 'zS23*1=7EZ#*';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('forprojectpurpose150302024@gmail.com', 'AksharUchiha');

        $mail->addAddress($email);     //Add a recipient


        //Attachments


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link';
        $mail->Body    = "We got a request from you to reset your password ! <br> click the link below <br> <a href='http://localhost/password recovery system/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password </a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['send-reset-link'])) {

    $query = "SELECT * FROM `registered_users` WHERE `email`='$_POST[email]'";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {

            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $query = "UPDATE `registered_users` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE 'email'='$_POST[email]'";
            if (mysqli_query($con, $query) && sendMail($_POST['email'], $reset_token)) {

                echo "
                <script>
                alert('Password reset link Sent To Mail');
                window.location.href='index.php';
                </script>
                
                ";
            } else {
                echo "
                <script>
                alert('Server Down Please Try Again Later');
                window.location.href='index.php';
                </script>
                
                ";
            }
        } else {
            echo "
            <script>
            alert('Email Not Found');
            window.location.href='index.php';
            </script>
            
            ";
        }
    } else {
        echo "
        <script>
        alert('cannot run query');
        window.location.href='index.php';
        </script>
        
        ";
    }
}
