<?php

require('connection.php');
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VA9-About</title>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>

    <style>
        .box:hover {
            border-top-color: var(--teal) !important;

        }

        * {
            font-family: 'Poppins', sans-serif;

        }

        .h-font {
            font-family: 'Merienda', cursive;
        }
    </style>



</head>

<body>



    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">About Us</h2>
        <div class="hline bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, harum et! Laborum <br> at ipsa nesciunt blanditiis illum velit reiciendis voluptatibus.</p>

    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nesciunt eligendi quos, tenetur adipisci aperiam tempore?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nesciunt eligendi quos, tenetur adipisci aperiam tempore?

                </p>

            </div>

            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2  order-1">
                <img src="images\about\about.jpg" alt="" class="w-100">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark box">
                    <img src="images\about\hotel.svg" width="70px">
                    <h4 class="mt-3">100+ Rooms</h4>
                </div>
            </div>

            <div class="col-lg-3 md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark box">
                    <img src="images\about\customers.svg" width="70px">
                    <h4 class="mt-3">200+ Customers</h4>
                </div>
            </div>

            <div class="col-lg-3 md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark box">
                    <img src="images\about\rating.svg" width="70px">
                    <h4 class="mt-3">150+ Reviews</h4>
                </div>
            </div>

            <div class="col-lg-3 md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark box">
                    <img src="images\about\staff.svg" width="70px">
                    <h4 class="mt-3">200+ Staff</h4>
                </div>
            </div>
        </div>
    </div>

   




    <?php require('inc/footer.php'); ?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
   


</body>

</html>