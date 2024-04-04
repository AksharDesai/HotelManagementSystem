<?php

require("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
    require('PHPmailer/PHPMailer.php');
    require('PHPmailer/Exception.php');
    require('PHPmailer/SMTP.php');

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lalitadesai212004@gmail.com';
        $mail->Password   = 'agkgnllohzjugnnv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('forprojectpurpose150302024@gmail.com', 'AksharUchiha');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Link';
        $mail->Body    = "We received a request from you to reset your password!<br>Click the link below to reset your password:<br><a href='http://localhost/hello/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        // Return true when email is sent successfully
        return true;
    } catch (Exception $e) {
        // Log or echo the error message
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");

        // Throw an exception to be caught in the calling code
        throw new Exception("Error occurred while sending email.");
    }
}

if (isset($_POST['send-reset-link'])) {
    try {
        $email = $_POST['email'];

        $query = "SELECT * FROM `registered_users` WHERE `email`='$email'";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $reset_token = bin2hex(random_bytes(16));
                date_default_timezone_set('Asia/Kolkata');
                $date = date("Y-m-d");

                $update_query = "UPDATE `registered_users` SET `resettoken`='$reset_token', `resettokenexpire`='$date' WHERE `email`='$email'";

                if (mysqli_query($con, $update_query)) {
                    if (sendMail($email, $reset_token)) {
                        echo "
                        <script>
                        alert('Password reset link sent to email.');
                        </script>";
                    }
                }
            } else {
                echo "
                <script>
                alert('Email not found.');
                </script>";
            }
        }
    } catch (Exception $e) {
        echo "
        <script>
        alert('Error occurred while sending email.');
        </script>";
    }
}
