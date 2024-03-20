<?php

require('connection.php');
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VA9-Contact Us</title>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>

    <style>
        * {
            font-family: 'Poppins', sans-serif !important;

        }

        .h-font {
            font-family: 'Merienda', cursive !important;
        }
        .ban {
            margin-top: -64px;
            z-index: 2;
            position: relative;
        }
        .ban{
            z-index: 1040;
        }
    </style>



</head>

<body>



    <?php require('inc/header.php'); ?>

    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['ban'] == 1) {
        echo <<<alert

        <div class="alert ban alert-danger alert-dismissible fade show position-fixed" role="alert""><i class="bi bi-exclamation-triangle-fill"></i>
        <strong class="me-3">"Access Denied:</strong>We regret to inform you that your access to this platform has been suspended due to violations of our terms of service,If you believe this action was taken in error, please contact our support team for assistance "<a class=" me-2 text-dark " href="contactus.php">Contact Us</a>

        </div>
        
        
        alert;
    }
        ?>




    <div class="my-5 px-4">

        <h2 class="fw-bold h-font text-center">Contact Us</h2>
        <div class="hline bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, harum et! Laborum <br> at ipsa nesciunt blanditiis illum velit reiciendis voluptatibus.</p>

    </div>


    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6  px-4">
                <div class="bg-white rounded shadow p-4 ">


                    <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.43369747637!2d72.66675867535835!3d23.044556279158375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e87195782bb91%3A0x9c8c796554214ff1!2sTaj%20Residency!5e0!3m2!1sen!2sin!4v1704861306438!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
                    <h5 class="mt-2 fw-bold ">Address</h5>
                    <i class="bi bi-geo-alt-fill"></i><a target="_blank" class="d-line-block text-decoration-none text-dark" href="https://maps.app.goo.gl/17w1yeNDMwdNUoRSA">C-501,Gangotri Circle Nikol</a>
                    <h5 class="mt-4 fw-bold ">Call us</h5>

                    <a href="tel :+916354747685" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+916354747685</a>

                    <br>

                    <a href="tel :+916354747685" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+919825020460</a>
                    <br>
                    <h5 class="mt-4 fw-bold ">Email</h5>
                    <i class="bi bi-envelope-fill mx-1"></i><a class="d-inline-block mb-2 text-decoration-none text-dark" href="mailto: akshar25desai@gmail.com">akshar25desai@gmail.com</a>


                    <h5 class="mt-4 fw-bold ">Follow us</h5>
                    <a href="#" class="d-inline-block  mt-3  fs-8  text-dark me-2">
                        <i class="bi bi-twitter-x me-2  "></i>
                    </a>

                    <a href="#" class="d-inline-block  fs-8  text-dark me-2">
                        <i class="bi bi-instagram me-2  "></i>
                    </a>

                    <a href="#" class="d-inline-block fs-8  text-dark me-2 ">
                        <i class="bi bi-facebook  "></i>
                    </a>

                </div>
            </div>
            <div class="col-lg-6 col-md-6  px-4">
                <div class="bg-white rounded shadow p-4 ">

                    <form method="post">
                        <h5 class="fw-bold">Send a message</h5>

                        <div class="mt-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="name" required>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-bold">Email address</label>
                            <input type="email" class="form-control" aria-describedby="emailHelp" name="email" required>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-bold">Subject</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="subject" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label  fw-bold">Message</label>
                            <textarea class="form-control" rows="5" name="message" required></textarea>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-dark custom-bg" name="send">Send</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <?php
    if (isset($_POST['send'])) {
        // $frm_data=filteration($_POST);

        $q = "INSERT INTO `user_queries`( `name`, `email`, `subject`, `message`) VALUES ('$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[message]')";

        if (mysqli_query($con, $q)) {
            echo <<<alert

            <div class="alert alert-success fade show custom-alert role="alert">
            <strong class="me-3">Successfully Submited Your Query</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>

         
            alert;
        } else {
            echo <<<alert

            <div class="alert  alert-danger fade show custom-alert role="alert">
            <strong class="me-3">Unable To Submit Your Query</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>

         
            alert;
        }
    }
    ?>



    <?php require('inc/footer.php'); ?>




</body>

</html>