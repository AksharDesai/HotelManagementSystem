<?php


session_start();




// it is the function of uploading an image 
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

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>
    <link rel="stylesheet" href="admin\css\common.css">

    <?php require('C:\xampp\htdocs\hello\inc\links.php'); ?>

    <style>
        .flex-heading {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .addroom-button {
            padding-left: 500px;
            padding-right: 500px;
            font-size: 20px;
            /* width:800px; */
            border: solid 1px black;

        }
    </style>

</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>
    <?php require('inc\connection.php'); ?>


    <!-- heading about registered_users is starts from here -->
    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 flex-heading">


                <h3 class="mb-4 btn btn-warning addroom-button addroom-button"><i class="bi bi-person-badge"></i> Registered Users</h3>

                <hr>











            </div>
        </div>
    </div>
    <!-- heading about registered_users is starts from here -->




    <!-- printing in table starts from here  -->
    <div class="container-fluid  " id=" main-content" ">
        <div class=" row " >

        <div class=" col-lg-10 ms-auto p-0 table-container">
            <table class=" table table-hover text-center ">
                <thead class=" bg-dark text-light">
        <tr>
            <th scope="col" class="rounded-start">Sr.No</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phoneno</th>
            <th scope="col">Pincode</th>
            <th scope="col">BirthDate</th>
            <th scope="col">Address</th>
            <th scope="col" class="rounded end">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white">
            <?php
            $query = "SELECT * FROM  `registered_users` ";
            $result = mysqli_query($con, $query);
            $i = 1;
            $fetch_src = FETCH_SRC;
            while ($fetch = mysqli_fetch_assoc($result)) {

                $isBanned = $fetch['ban'];

                // Initialize the variable to store the button HTML
                $buttonHTML = '';

                if ($isBanned) {
                    // If the user is banned, store HTML for the "Unban" button
                    $buttonHTML = '<button onclick="confirm_rem2(' . $fetch['user_id'] . ', false)" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Unban</button>';
                } else {
                    // If the user is not banned, store HTML for the "Ban" button
                    $buttonHTML = '<button onclick="confirm_rem(' . $fetch['user_id'] . ', true)" class="btn btn-danger text-white"><i class="bi bi-exclamation-triangle-fill text-dark"></i> Ban</button>';
                }


                echo <<<product
                        
                        
                        <tr>
                        <th scope="row">$i</th>
                        <td><img src="$fetch_src$fetch[image] " width="150px" ></td>
                        <td>$fetch[name]</td>
                        <td>$fetch[email]</td>
                        <td>$fetch[phoneno]</td>
                        <td>$fetch[pincode]</td>
                        <td>$fetch[birthdate]</td>
                        <td>$fetch[address]</td> 
                        <td>$buttonHTML <a href="?edit=$fetch[user_id]" class="btn custom-bg mt-1 "><i class="bi bi-bookmark-plus-fill text-dark fw-5  "></i></a></td>
                        
                     
                        

                                  


                        
                        
                        
                        
                        
                        
                        </tr>
                        
                        
                        
                        
                        product;
                $i++;
            }

            ?>





            <!-- printing in table ends  here  -->


            <!-- register modal -->

            <div class="modal fade" id="edituser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header ">
                            <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-badge fs-3 me-2"></i>User Edit</h5>
                            <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="users.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <span class="badge bg-light text-dark lh-base text-wrap mb-3">Note: Yours details must match with your ID . That will be required at the time of your check-in</span>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6 ps-0">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" aria-describedby="emailHelp" name="name" id="editname" required>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <label class="form-label">Email </label>
                                            <input type="email" class="form-control" aria-describedby="emailHelp" name="email" id="editemail" required>
                                        </div>
                                        <div class="col-md-6 ps-0 mb-3">
                                            <label class="form-label">Phone no</label>
                                            <input type="number" class="form-control" aria-describedby="emailHelp" name="phoneno" id="editphoneno" required>
                                        </div>

                                        <img src=" " id="editimg" alt="" width="200px" height="200px" class="mb-3 border"> <br>



                                        <div class="col-md-12 ps-0">
                                            <label class="input-group-text">Picture</label>
                                            <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.svg">
                                        </div>



                                        <input type="hidden" name="edituid" id="edituid">

                                        <div class="col-md-12 p-0 mb-3">
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                                <textarea class="form-control" rows="1" name="address" id="editaddress" required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-1">
                                            <label class="form-label">Pincode </label>
                                            <input type="number" class="form-control" aria-describedby="emailHelp" name="pincode" id="editpincode" required>
                                        </div>
                                        <div class="col-md-6 ps-0 ps-1">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" aria-describedby="emailHelp" name="birthdate" id="editbirthdate" required>
                                        </div>




                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-dark my-1" name="edituser">Edit</button>
                                    </div>


                        </form>

                    </div>

                </div>

            </div>



    </div>

    </div>

    <!-- register modal ends here -->

    <?php

    if (isset($_GET['edit']) && $_GET['edit'] > 0) {
        $user_id = $_GET['edit'];
        $query = "SELECT * FROM `registered_users` WHERE `user_id` = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $fetch = mysqli_fetch_assoc($result);

        echo "
    <script>
    var edituser = new bootstrap.Modal(document.getElementById('edituser'),{
        keyboard:false
    });
    document.querySelector('#editname').value = `$fetch[name]`;
    document.querySelector('#editemail').value = `$fetch[email]`;
    document.querySelector('#editphoneno').value = `$fetch[phoneno]`;

    document.querySelector('#editimg').src = '$fetch_src$fetch[image]';

    document.querySelector('#editaddress').value = `$fetch[address]`;
    document.querySelector('#editpincode').value = `$fetch[pincode]`;
    document.querySelector('#editbirthdate').value = `$fetch[birthdate]`;


    document.querySelector('#edituid').value = `$fetch[user_id]`;
  
    
    edituser.show();
</script>";
    }


    if (isset($_POST['edituser'])) {

        // foreach ($_POST as $key => $value) {
        //     $_POST[$key] = mysqli_real_escape_string($con, $value);
        // }

        // $facilities = $_POST['facilities'];
        // $features = $_POST['features'];
        // $facilities1 = implode(" | ", $facilities);
        // $features1 = implode(" | ", $features);

        if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {



            // Fetch room information
            $query = "SELECT * FROM `registered_users` WHERE `user_id`='$_POST[edituid]'";
            $result = mysqli_query($con, $query);
            $fetch = mysqli_fetch_assoc($result);

            $imageFilePath = UPLOAD_SRC . $fetch['image'];
            unlink($imageFilePath);


            $imgpath = image_upload($_FILES['image']);

            $update = "UPDATE `registered_users` SET `image`='$imgpath', `name`='$_POST[name]', `email`='$_POST[email]', `phoneno`='$_POST[phoneno]', `address`='$_POST[address]', `pincode`='$_POST[pincode]', `birthdate`='$_POST[birthdate]'  WHERE `user_id`='$_POST[edituid]'";
        } else {

            $update = "UPDATE `registered_users` SET  `name`='$_POST[name]', `email`='$_POST[email]', `phoneno`='$_POST[phoneno]', `address`='$_POST[address]', `pincode`='$_POST[pincode]', `birthdate`='$_POST[birthdate]'  WHERE `user_id`='$_POST[edituid]'";
        }
        if (mysqli_query($con, $update)) {
            echo "
            <script>
            alert('User Updated ');
            window.location.href='users.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('cannot run query');
            window.location.href='users.php';
            </script>
            ";
        }
    }

    ?>

    <!-- the backend of editing starts from here -->


    <!-- the backend of editing ends here -->




    <?php

    if (isset($_GET['rem2']) && $_GET['rem2'] > 0) {
        $query = "SELECT * FROM `registered_users` WHERE `user_id`='$_GET[rem2]'";
        $result = mysqli_query($con, $query);
        $fetch = mysqli_fetch_assoc($result);

        $query = "UPDATE `registered_users` SET `ban`=0 WHERE `user_id`='$_GET[rem2]'";
        if (mysqli_query($con, $query)) {
            echo <<<alert

<div class="alert alert-warning alert-dismissible fade show" role="alert"">
<strong class="me-3">Done</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


alert;
        } else {
            echo <<<alert2

<div class="alert alert-warning alert-dismissible fade show" role="alert"">
<strong class="me-3">Sorry</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


alert2;
        }
    }

    ?>

    <?php

    if (isset($_GET['rem']) && $_GET['rem'] > 0) {
        $query = "SELECT * FROM `registered_users` WHERE `user_id`='$_GET[rem]'";
        $result = mysqli_query($con, $query);
        $fetch = mysqli_fetch_assoc($result);

        $query = "UPDATE `registered_users` SET `ban`=1 WHERE `user_id`='$_GET[rem]'";
        if (mysqli_query($con, $query)) {
            echo <<<alert

        <div class="alert alert-warning alert-dismissible fade show" role="alert"">
        <strong class="me-3">Done</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

     
        alert;
        } else {
            echo <<<alert2

        <div class="alert alert-warning alert-dismissible fade show" role="alert"">
        <strong class="me-3">Sorry</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

     
        alert2;
        }
    }

    ?>


    </tbody>
    </table>
    </div>
    </div>
    </div>





    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>
    <script>
        function confirm_rem(user_id) {
            if (confirm("Are you sure,You want to BAN the user")) {
                window.location.href = "users.php?rem=" + user_id;
            }

        }

        function confirm_rem2(user_id) {
            if (confirm("Are you sure,You want to UNBAN the user")) {
                window.location.href = "users.php?rem2=" + user_id;
            }

        }
    </script>

</body>

</html>