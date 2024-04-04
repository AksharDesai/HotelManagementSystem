<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
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

                    <form method='POST'>
                        <h3> Create New Password </h3>
                        <input type='password' placeholder='New Password' name='password'>
                        <button type='submit' name='updatepassword'>UPDATE</button>
                        <input type='hidden' name='email' value='$_GET[email]'>
                        <input type='hidden' name='reset_token' value='$_GET[reset_token]'>
                    </form>

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

        echo "hi baby you just clicked";
        $email = $_POST['email'];
        $reset_token = $_POST['reset_token'];
        $new_password = $_POST['password'];

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password in the database
        $update_query = "UPDATE `registered_users` SET `password`='$hashed_password' , `resettoken`=NULL , `resettokenexpire`=NULL  WHERE `email`='$email'";
        if (mysqli_query($con, $update_query)) {
            echo "<script>alert('Password updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update password');</script>";
        }
    }
    ?>

</body>

</html>