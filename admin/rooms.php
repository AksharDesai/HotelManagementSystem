<?php


session_start();

require('C:\xampp\htdocs\hello\inc\links.php');
require('inc\connection.php');


// it is the function of uploading an image 
function image_upload($img)
{
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111, 99999) . $img['name'];
    $new_loc = UPLOAD_SRC1 . $new_name;

    if (!move_uploaded_file($tmp_loc, $new_loc)) {
        header("location: index.php?alert=img_upload");
    } else {
        return $new_name;
    }
}


//Delete room 
if (isset($_GET['rem']) && $_GET['rem'] > 0) {
    $room_id = $_GET['rem'];

    // Fetch room information
    $query = "SELECT * FROM `rooms` WHERE `room_id`='$room_id'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_assoc($result);

    // Delete the image file from the server
    $imageFilePath = UPLOAD_SRC1 . $fetch['image'];
    if (file_exists($imageFilePath) && unlink($imageFilePath)) {
        // If image deletion is successful, proceed to delete room information
        $delete_query = "DELETE FROM `rooms` WHERE `room_id`='$room_id'";
        if (mysqli_query($con, $delete_query)) {
            echo <<<alert
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="me-3">Room Deleted Successfully</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            alert;
            // Redirect back to rooms.php after deletion
            header("Location: rooms.php");
            exit();
        } else {
            echo <<<alert2
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="me-3">Failed to delete room information</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            alert2;
        }
    } else {
        echo <<<alert3
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong class="me-3">Failed to delete image file</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        alert3;
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>


    <link rel="stylesheet" href="admin\css\common.css">

    <style>
        .flex-heading {
            display: flex;
            justify-content: center;
            align-items: center;


        }

        .addroom-button {
            padding-left: 500px;
            padding-right: 500px;
            font-size: 25px;
            border: solid 1px black;
        }

        .apna {
            object-fit: cover;
            object-position: center;
        }
    </style>

</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>



    <!-- add room modal starts form here -->
    <?php require("inc\adminroom\modal_add.php"); ?>
    <!--  above add  room modal ends here  -->




    <!-- edit modal starts from here -->
    <?php require("inc\adminroom\modal_edit.php"); ?>
    <!-- edit modal ends here -->




    
    <!-- the insertion of the data and the fetched data is also displayed in table form -->
    <?php require("inc\adminroom\insert_fetch.php"); ?>
    <!-- the insertion and fetching  of data ends here -->



    <!-- automatically fills the input fields by fetching the data from database v  -->

    <?php

    if (isset($_GET['edit']) && $_GET['edit'] > 0) {
        $room_id = $_GET['edit'];
        $query = "SELECT * FROM `rooms` WHERE `room_id` = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $room_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $fetch = mysqli_fetch_assoc($result);

        echo "
                        <script>
                            var editroom = new bootstrap.Modal(document.getElementById('editroom'),{
                                keyboard:false
                            });
                            document.querySelector('#editname').value = `$fetch[name]`;
                            document.querySelector('#editarea').value = `$fetch[area]`;
                            document.querySelector('#editquantity').value = `$fetch[quantity]`;
                            document.querySelector('#editprice').value = `$fetch[price]`;
                            document.querySelector('#editadult').value = `$fetch[adult]`;
                            document.querySelector('#editchildren').value = `$fetch[children]`;
                            
                            document.querySelector('#editimg').src = '$fetch_srcrad$fetch[image]';
                            document.querySelector('#editdesc').value = `$fetch[Description]`;
                            document.querySelector('#editrid').value = `$fetch[room_id]`;
                            
                            
                            editroom.show();
                        </script>";
    }

    if (isset($_POST['editroom'])) {

        // foreach ($_POST as $key => $value) {
        //     $_POST[$key] = mysqli_real_escape_string($con, $value);
        // }

        // $facilities = $_POST['facilities'];
        // $features = $_POST['features'];
        // $facilities1 = implode(" | ", $facilities);
        // $features1 = implode(" | ", $features);

        if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {

           

            // Fetch room information
            $query = "SELECT * FROM `rooms` WHERE `room_id`='$_POST[editrid]'";
            $result = mysqli_query($con, $query);
            $fetch = mysqli_fetch_assoc($result);

            $imageFilePath = UPLOAD_SRC1.$fetch['image'];
            unlink($imageFilePath);


            $imgpath = image_upload($_FILES['image']);

            $update = "UPDATE `rooms` SET `image`='$imgpath', `name`='$_POST[name]', `area`='$_POST[area]', `quantity`='$_POST[quantity]', `price`='$_POST[price]', `adult`='$_POST[adult]', `children`='$_POST[children]', `Description`='$_POST[desc]' WHERE `room_id`='$_POST[editrid]'";
            
               
            
        } else {

            $update = "UPDATE `rooms` SET  `name`='$_POST[name]', `area`='$_POST[area]', `quantity`='$_POST[quantity]', `price`='$_POST[price]', `adult`='$_POST[adult]', `children`='$_POST[children]', `Description`='$_POST[desc]' WHERE `room_id`='$_POST[editrid]'";
        }
        if (mysqli_query($con, $update)) {
            echo "
            <script>
            alert('Room Updated ');
            window.location.href='rooms.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('cannot run query');
            window.location.href='rooms.php';
            </script>
            ";
        }
    }

    ?>
    <!-- automatically fills the input fields by fetching the data from database ^  -->






    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>



    <script>
        function confirm_rem(room_id) {
            if (confirm("Are you sure,Delete?")) {
                window.location.href = "rooms.php?rem=" + room_id;
            }

        }
    </script>


</body>

</html>