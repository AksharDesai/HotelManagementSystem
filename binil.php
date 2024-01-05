<?php

require("connection.php");

if (isset($_POST["login"])) {



    $query = "SELECT * FROM  registered_users WHERE  email='$_POST[email_username]' OR phoneno='$_POST[email_username]' ";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);

            if (password_verify($_POST['password'], $result_fetch['password'])) {
                echo "right";
            } else {

                echo "
                        <script>
                        alert('incorrect password');
                        window.location.href='index.php';
                        </script>
                        ";
            }
        } else {
            echo "
                 <script>
                 alert('email or mobile number not registered');
                 window.location.href='index.php';
                 </script>
                 ";
        }
    }
}

if (isset($_POST["register"])) {

    $user_exist_query = "SELECT * FROM  registered_users WHERE  email='$_POST[email]' OR mobileno = '$_POST[mobileno]'";
    $result = mysqli_query($con, $user_exist_query);



    if ($result) {

        if (mysqli_num_rows($result) > 0) {

            $result_fetch = mysqli_fetch_assoc($result);

            if ($result_fetch['email'] == $_POST['email']) {
                echo "
                <script>
                alert('email already registered ');
                window.location.href='index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('mobile number already registered ');
                window.location.href='index.php';
                </script>
                ";
            }
        } elseif ($_POST['password'] != $_POST['repeat_password']) {
            echo "
            <script>
            alert('password not match ');
            window.location.href='index.php';
            </script>
            ";
        } else {
            // maybe from here 
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $query = "INSERT INTO registered_users (fullname, mobileno, email, password) VALUES ('$_POST[fullname]','$_POST[mobileno]' ,'$_POST[email]','$password')";
            if (mysqli_query($con, $query)) {

                echo "
            <script>
            alert('Registration Successfull');
            window.location.href='index.php';
            </script>
            ";
            } else {
                echo "
            <script>
            alert('cannot run query');
            window.location.href='index.php';
            </script>
            ";
            }
        }
    }
}
