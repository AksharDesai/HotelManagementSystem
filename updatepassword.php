<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            text-align: center;
        }

        .form-container form {
            display: inline-block;
        }

        .form-container h3 {
            margin-bottom: 10px;
        }

        .form-container input[type="password"] {
            margin-bottom: 10px;
            padding: 5px;
        }

        .form-container button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    require("connection.php");
    if (isset($_GET['email']) && isset($_GET['reset_token'])) {

        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d");
        $query = "SELECT * FROM `registered_users` WHERE `email`='$_GET[email]' AND `resettoken`='$_GET[reset_token]' AND `resettokenexpire`='$date'";
        $result = mysqli_query($con, $query);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                echo <<<updatepasswordform

                    <div class="form-container">
                        <form method='POST'>
                            <h3> Create New Password </h3>
                            <input type='password' placeholder='New Password' name='password' required>
                            <button type='submit' class=" btn-success" name='updatepassword'>UPDATE</button>
                            <input type='hidden' name='email' value='$_GET[email]'>
                            <input type='hidden' name='reset_token' value='$_GET[reset_token]'>
                        </form>
                    </div>

                updatepasswordform;
            } else {
                echo "
                    <script>
                    alert('Invalid or Expired Link');
                    </script>";
            }
        } else {
            echo "
            <script>
            alert('Server down try again later .');
            </script>";
        }
    }
    ?>

    <?php
    if (isset($_POST['updatepassword'])) {
        $email = $_POST['email'];
        $reset_token = $_POST['reset_token'];
        $new_password = $_POST['password'];

        
        $email = $_POST['email'];
        $reset_token = $_POST['reset_token'];
        $new_password = $_POST['password'];

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password in the database
        $update_query = "UPDATE `registered_users` SET `password`='$hashed_password' , `resettoken`=NULL , `resettokenexpire`=NULL  WHERE `email`='$email'";
        if (mysqli_query($con, $update_query)) {
            echo "<script>alert('Password updated successfully');
            window.location.href = 'index.php'; // Redirect to index page
            </script>";
        } else {
            echo "<script>alert('Failed to update password');
            window.location.href = 'index.php'; // Redirect to index page
            </script>";
        }
    }
    ?>

</body>

</html>
