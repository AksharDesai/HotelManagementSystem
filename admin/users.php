<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>
    <link rel="stylesheet" href="admin\css\common.css">

    <?php require('C:\xampp\htdocs\hello\inc\links.php'); ?>

</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>
    <?php require('inc\connection.php'); ?>

    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4">


                <h3 class="mb-4">Registered Users</h3>

                <hr>











            </div>
        </div>
    </div>
    <div class="container-fluid  " id=" main-content" ">
        <div class=" row " >

        <div class=" col-lg-10 ms-auto p-0 ">
            <table class=" table table-hover text-center ">
                <thead class=" bg-success text-light">
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
                    $buttonHTML = '<button onclick="confirm_rem2(' . $fetch['user_id'] . ', false)" class="btn btn-warning"><i class="bi bi-arrow-clockwise"></i> Unban</button>';
                } else {
                    // If the user is not banned, store HTML for the "Ban" button
                    $buttonHTML = '<button onclick="confirm_rem(' . $fetch['user_id'] . ', true)" class="btn btn-danger"><i class="bi bi-exclamation-triangle-fill"></i> Ban</button>';
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
                        <td>$buttonHTML</td>
                        
                     
                        

                                  


                        
                        
                        
                        
                        
                        
                        </tr>
                        
                        
                        
                        
                        product;
                $i++;
            }


            ?>

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