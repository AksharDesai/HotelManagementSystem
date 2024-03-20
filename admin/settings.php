<?php
    require('inc\connection.php'); 
    session_start();
?>

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
  

    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4">


                <h3 class="mb-4">Settings</h3>




                <!-- Shutdown Section Starts From Here -->
                <div class="card shadow-lg ">
                    <div class="card-body">
                        <div class=" align-items-center justify-content-between mb-3 ">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <p class="my-2">No Customers will be allowed to book hotel room , when Shutdown mode is ON</p>

                            <?php
                            
                            
                            $query = "SELECT * FROM  `shutdown_status` ";
                            $result = mysqli_query($con, $query);
                            $i = 0;
                            
                            while ($fetch = mysqli_fetch_assoc($result)) {
                                
                                $_SESSION["is_shutdown"] = $fetch["is_shutdown"];
                                
                                $isshut = $fetch['is_shutdown'];


                                // Initialize the variable to store the button HTML
                                $buttonHTML = '';

                                if ($isshut) {
                                    // If the user is banned, store HTML for the "Unban" button
                                    $buttonHTML = '<button onclick="confirm_rem2(' . $fetch['id'] . ', false)" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Start</button>';
                                } else {
                                    // If the user is not banned, store HTML for the "Ban" button
                                    $buttonHTML = '<button onclick="confirm_rem(' . $fetch['id'] . ', true)" class="btn btn-danger text-light"><i class="bi bi-exclamation-triangle-fill text-dark"></i> Shutdown </button>';
                                }
                            }
                            ?>


                            <?php

                            if (isset($_GET['rem2']) && $_GET['rem2'] > 0) {
                                $query = "SELECT * FROM `shutdown_status` WHERE `id`='$_GET[rem2]'";
                                $result = mysqli_query($con, $query);
                                $fetch = mysqli_fetch_assoc($result);

                                $query = "UPDATE `shutdown_status` SET `is_shutdown`=0 WHERE `id`='$_GET[rem2]'";
                                if (mysqli_query($con, $query)) {
                                } else {
                                }
                            }

                            ?>


                            <?php

                            if (isset($_GET['rem']) && $_GET['rem'] > 0) {

                                $query = "SELECT * FROM `shutdown_status` WHERE `id`='$_GET[rem]'";
                                $result = mysqli_query($con, $query);
                                $fetch = mysqli_fetch_assoc($result);

                                $query = "UPDATE `shutdown_status` SET `is_shutdown`= 1 WHERE `id`='$_GET[rem]'";
                                if (mysqli_query($con, $query)) {
                                } else {
                                }
                            }

                            ?>

                            <?php
                            echo $buttonHTML;
                            ?>
                            <!-- <input class="form-check-input " type="checkbox" id="shutdown-toggle" name="shutdown_toggle"> -->

                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->


                        </div>
                    </div>

                </div>
            </div>








        </div>
    </div>










    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>




    <script>
        function confirm_rem(id) {
            if (confirm("Are you sure,You want to SHUTDOWN the site")) {
                window.location.href = "settings.php?rem=" + id;
            }

        }

        function confirm_rem2(id) {
            if (confirm("Are you sure,You want to START the site")) {
                window.location.href = "settings.php?rem2=" + id;
            }

        }
    </script>
</body>

</html>