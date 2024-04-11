<?php

require('connection.php');
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VA9-Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc\links.php'); ?>
    <link rel="stylesheet" href="C:\xampp\htdocs\hello\css\common.css">

    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width:575px) {
            .availability-form {
                margin-top: 25px;
                padding: 0 35px;
            }
        }

        .ban {
            z-index: 1040;
        }
    </style>
</head>

<body>
    <?php


    $query = "SELECT * FROM  `shutdown_status` ";
    $result = mysqli_query($con, $query);
    $i = 0;

    while ($fetch = mysqli_fetch_assoc($result)) {



        $isshut = $fetch['is_shutdown'];
    }
    ?>



    <?php

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['ban']) && $_SESSION['ban'] == 1) {
        echo <<<alert

        <div class="alert ban alert-danger alert-dismissible fade show position-fixed" role="alert""><i class="bi bi-exclamation-triangle-fill"></i>
        <strong class="me-3">"Access Denied:</strong>We regret to inform you that your access to this platform has been suspended due to violations of our terms of service,If you believe this action was taken in error, please contact our support team for assistance "<a class=" me-2 text-dark " href="contactus.php">Contact Us</a>
        <a class=" me-2 text-dark " href="logout.php">Log Out</a>
        </div>
        
        
        alert;
    } else if ($isshut == 1) {
        echo <<<alert
                <div class="alert alert-warning text-center" role="alert">
                <i class="bi bi-building-fill-lock text-dark"></i> Sorry For Now All Rooms Are Booked
            </div>
        
        
        alert;
    }
    ?>
    <?php require('inc/header.php'); ?>



    <!-- carousel -->
    <div class="container-fluid mt-4 px-lg-4">

        <div id="carouselExampleFade" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images\IMG_15372.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images\IMG_40905.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images\IMG_55677.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images\IMG_62045.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images\IMG_93127.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images\IMG_99736.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <!-- carousel end here -->

    <!-- check availability form -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-dark shadow p-4 shadow-lg rounded d-flex align-items-center justify-content-center">


                <h5 class="mb-4 mt-4 text-center text-white ">"Embark on a journey of comfort and luxury. Your stay is not just a reservation; it's a passport to unparalleled experiences."</h5>
               
            </div>
        </div>
    </div>

    <!--  check availability-form ends here -->

    <!-- Our Rooms -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

    <div class="container">
        <div class="row">


            <?php



            $query = "SELECT * FROM  `rooms` ";
            $result = mysqli_query($con, $query);
            $i = 1;
            $fetch_srcrad = FETCH_SRCrad;

            while ($fetch = mysqli_fetch_assoc($result)) {


                echo <<<indexroomprint
                            <div class="col-lg-4 col-md-6 my-3">
                                <div class="card border-0 shadow-lg" style="max-width: 350px; margin:auto;">
                                    <img src="$fetch_srcrad$fetch[image]" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">$fetch[name]</h5>
                                        <h6 class="card-title mb-4">$$fetch[price] per night</h6>
                                        <div class="features mb-4">
                                            <h6 class="mb-1">Features</h6>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[features]</span>
                                            
                                        </div>
                                        <div class="facilities mb-4">
                                            <h6 class="mb-1">Facilities</h6>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[facilities]</span>
                                          
                                        </div>
                                        <div class="Guest mb-4">
                                            <h6 class="mb-1">Guests</h6>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[adult] Adults</span>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[children]Children</span>
                                        </div>
                                        <div class="rating mb-4">
                                            <h6 class="mb-1">Rating</h6>
                                            <span class="badge rounded-pill bg-secondary">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-evenly mb-2">
                                            
                                        
                                                
                                                <a href="" class="btn text-white custom-bg shadow-none">Book Now</a>
                                                <a href="#" class="btn btn-outline-dark shadow-none">More Details</a>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            indexroomprint;
            }



            ?>

        </div>


        <!-- rooms part ends here -->

        <!-- facilities part -->

        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Facilities</h2>
        <div class="container">
            <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow-lg py-4 my-3">
                    <img src="images\icons\ac.png" width="80px">
                    <h5 class="mt-3">AC</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow-lg py-4 my-3">
                    <img src="images\icons\wifi.png" width="80px">
                    <h5 class="mt-3">Wifi</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow-lg py-4 my-3">
                    <img src="images\icons\spa.png" width="80px">
                    <h5 class="mt-3">Spa</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow-lg py-4 my-3">
                    <img src="images\icons\heater.png" width="80px">
                    <h5 class="mt-3">Heater</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow-lg py-4 my-3">
                    <img src="images\icons\tv.png" width="80px">
                    <h5 class="mt-3">TV</h5>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    <a href="#" class="btn  btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
                </div>
            </div>
        </div>

        <!-- facilities parts ends here -->

        <!-- testimonal starts from here -->

        

        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font ">Testimonials</h2>

        <div class="container shadow-lg mt-5">
            <div class="swiper swiper-testimonials">
                <div class="swiper-wrapper">


                <?php 
               
               $feedback_query="SELECT feedback.feedback_id, feedback.rating, feedback.subject, feedback.message, registered_users.name, registered_users.image 
               FROM feedback
               INNER JOIN registered_users ON feedback.user_id = registered_users.user_id";
               $feedback_result=mysqli_query($con,$feedback_query);

               $fetch_src = FETCH_SRC;

               while ($fetch_feedback = mysqli_fetch_assoc($feedback_result)){

               


               echo <<<feedbackecho
                    <div class="swiper-slide bg-white p-4 ">
                        <div class="profile d-flex align-items-center mb-3">
                            <img src="$fetch_src$fetch_feedback[image]" width="40px" class="rounded-circle">
                            <h6 class="m-0 ms-2">$fetch_feedback[name]</h6>
                        </div>
                        <p>$fetch_feedback[message]</p>
                        <div class="rating">

                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>

                        </div>

                    </div>

                    feedbackecho;

               }

                    ?>


            


               

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="feedback.php" class="btn  btn-outline-dark rounded-0 fw-bold shadow-none">Know More >>></a>
        </div>


        <!-- testimonal part ends here -->

        <!-- Reach us part starts from here -->
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font bg-white rounded">Reach Us</h2>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-light">
                    <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3549.4005559853913!2d78.03727128233547!3d27.175144715877178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39747121d702ff6d%3A0xdd2ae4803f767dde!2sTaj%20Mahal!5e0!3m2!1sen!2sin!4v1707894192085!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


                </div>
                <div class="col-lg-4 col-md-4 ">
                    <div class="bg-light p-4 rounded mb-4">
                        <h5>Call us</h5>
                        <a href="tel :+916354747685" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+916354747685</a>
                        <br>
                        <a href="tel :+916354747685" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+919825020460</a>
                    </div>

                    <div class="bg-light p-4 rounded mb-4">
                        <h5>Follow us</h5>
                        <a href="#" class="d-inline-block mb-3">
                            <span class="badge bg-light text-dark fs-6 p-2 "><i class="bi bi-twitter-x me-2"></i>Twitter</span>
                        </a>
                        <br>
                        <a href="#" class="d-inline-block mb-3">
                            <span class="badge bg-light text-dark fs-6 p-2 "><i class="bi bi-instagram me-2"></i>Instagram</span>
                        </a>
                        <br>
                        <a href="#" class="d-inline-block ">
                            <span class="badge bg-light text-dark fs-6 p-2 "><i class="bi bi-facebook me-2"></i>Facebook</span>
                        </a>
                        <br>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!--  reach us ends here -->



    <?php require('inc/footer.php'); ?>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            loop: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            }
        });
    </script>
</body>

</html>