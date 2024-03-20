<?php
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <style>

        .flex-heading {
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .addroom-button{
            padding-left: 500px;
            padding-right: 500px;
            font-size: 25px;
            border: solid 1px black;
        }
        </style>
</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>
    <?php require('inc\connection.php'); ?>

    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 flex-heading">


                <h3 class="mb-4 btn btn-warning addroom-button addroom-button"><i class="bi bi-person-fill-exclamation"></i> User Queries</h3>

                <hr>











            </div>
        </div>
    </div>
    <div class="container-fluid  " id=" main-content" ">
        <div class=" row " >

        <div class=" col-lg-10 ms-auto p-0 ">
            <table class=" table table-hover text-center ">
                <thead class=" bg-dark text-light">
        <tr>
            <th scope="col" class="rounded-start">Sr.No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col" class="rounded end">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white">
            <?php
            $query = "SELECT * FROM  `user_queries` ";
            $result = mysqli_query($con, $query);
            $i = 1;

            while ($fetch = mysqli_fetch_assoc($result)) {
                
                echo <<<product
                        
                        
                        <tr>
                        <th scope="row">$i</th>
                        <td>$fetch[name]</td>
                        <td>$fetch[email]</td>
                        <td>$fetch[subject]</td>
                        <td>$fetch[message]</td>
                        <td><button onclick="confirm_rem($fetch[sr_no])" class="btn btn-danger text-light "><i class="bi bi-eye-slash-fill text-dark "></i>  Seen</button></td>
                        
                        
                        </tr>
                     

                    
                        
                        product;
                $i++;
            }

            ?>

            <?php

            if (isset($_GET['rem']) && $_GET['rem'] > 0) {
                $query = "SELECT * FROM `user_queries` WHERE `sr_no`='$_GET[rem]'";
                $result = mysqli_query($con, $query);
                $fetch = mysqli_fetch_assoc($result);

                $query = "DELETE  FROM `user_queries` WHERE `sr_no`='$_GET[rem]'";
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

    <script>
        function confirm_rem(sr_no) {
            if (confirm("Are you sure,By clicking on seen it will be no more Displayed")) {
                window.location.href = "userqueries.php?rem=" + sr_no;
            }

        }
    </script>






    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>
</body>

</html>