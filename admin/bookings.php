<?php
require('inc\connection.php');
require('C:\xampp\htdocs\hello\inc\links.php');
session_start();
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

        .suchna-message{
            position: absolute;
            top: 20%;
            right: 2%;
        }

      

    </style>

</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>


    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 flex-heading">


                <h3 class="mb-4 btn btn-warning addroom-button addroom-button"><i class="bi bi-journal-medical"></i> Bookings</h3>

                <hr>


            </div>
        </div>
    </div>



    <div class="container-fluid mt-4" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-0">
            <table class="table table-hover text-center">
                <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col" class="rounded-start">Sr.No</th>
                        
                        <th scope="col">User-id</th>
                        <th scope="col">Room-id</th>
                        <th scope="col">Check-IN</th>
                        <th scope="col">Check-OUT</th>
                        <th scope="col">Total Price</th>
                        
                        <th scope="col" class="rounded end">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    $query = "SELECT * FROM `bookings`";
                    $result = mysqli_query($con, $query);
                    $i = 1;
                    
                    while ($fetch = mysqli_fetch_assoc($result)) {

                      


                        echo <<<product
                        <tr>
                            <th scope="row">$i</th>
                            
                           
                            <td>$fetch[user_id]</td>
                            <td>$fetch[room_id]</td>
                            <td>$fetch[check_in]</td>
                            <td>$fetch[check_out]</td>
                            <td>$fetch[total_price]</td> 
                            <td><button onclick="confirm_rem($fetch[booking_id])" class="btn btn-danger text-light "><i class="bi bi-trash3-fill  text-light"></i></button>  <a href="?edit=$fetch[booking_id]" class="btn btn-success mt-1 "><i class="bi bi-bookmark-plus-fill text-dark fw-5  "></i></a></td>

                            
                        </tr>
                        product;
                        $i++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php

if (isset($_GET['rem']) && $_GET['rem'] > 0) {
    $query = "SELECT * FROM `bookings` WHERE `booking_id`='$_GET[rem]'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_assoc($result);

    $query = "DELETE  FROM `bookings` WHERE `booking_id`='$_GET[rem]'";
    if (mysqli_query($con, $query)) {
        echo <<<alert

        <div class="alert alert-warning alert-dismissible fade show suchna-message" role="alert"">
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

























    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>


    <script>
        function confirm_rem(booking_id) {
            if (confirm("Are you sure,Delete? ")) {
                window.location.href = "bookings.php?rem=" + booking_id;
            }

        }
    </script>






</body>

</html>