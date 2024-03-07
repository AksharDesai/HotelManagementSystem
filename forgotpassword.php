<?php

require("connection.php");

if (isset($_POST['send-reset-link'])) {

    $query = "SELECT * FROM `registered_users` WHERE `email`='$_POST[email]'";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {

            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $query = "UPDATE `registered_users` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE 'email'='$_POST[email]'";
            if (mysqli_query($con, $query)) {

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
