<?php

require("connection.php");
session_start();


// it is the function of uploading an image vv
function image_upload($img)
{
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111, 99999) . $img['name'];

    $new_loc = UPLOAD_SRC . $new_name;

    if (!move_uploaded_file($tmp_loc, $new_loc)) {
        header("location: index.php?alert=img_upload");
    } else {
        return $new_name;
    }
}

if (isset($_POST["login"])) {



    $query = "SELECT * FROM  registered_users WHERE  email='$_POST[email_username]' OR phoneno='$_POST[email_username]' ";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);

            if (password_verify($_POST['password'], $result_fetch['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $result_fetch['email'];
                $_SESSION['name'] = $result_fetch['name'];
                $_SESSION['level'] = $result_fetch['level'];
                $_SESSION['ban'] = $result_fetch['ban'];
                if ($result_fetch['level'] == 1) {
                    header("location:index.php");
                } else if ($result_fetch['level'] == 0) {

                    header("location:index.php");
                }
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






if (isset($_POST['register'])) {




    $user_exist_query = "SELECT * FROM  `registered_users` WHERE `phoneno` ='$_POST[phoneno]' OR 'email' ='$_POST[email]' ";
    $result = mysqli_query($con, $user_exist_query);


    foreach ($_POST as $key => $value) {
        $_POST[$key] = mysqli_real_escape_string($con, $value);
    }

    $imgpath = image_upload($_FILES['image']);

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
                alert(' Mobile Number already registered ');
                window.location.href='index.php';
                </script>
                ";
            }
        } elseif ($_POST['password'] != $_POST['repeat_password']) {
            echo "
            <script>
            alert('Confirm Password Doest Not Match ');
            window.location.href='index.php';
            </script>
            ";
        } else {

            // maybe from here 
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $query = "INSERT INTO `registered_users` (`name`,`image`, `email`, `phoneno`, `pincode`, `birthdate`, `password`, `address`) VALUES ('$_POST[name]','$imgpath','$_POST[email]','$_POST[phoneno]','$_POST[pincode]','$_POST[birthdate]','$password','$_POST[address]')";
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
//else {


//     echo "
//     <script>
//     alert('cannot run query');
//     window.location.href='index.php';
//     </script>
//     ";
// }
