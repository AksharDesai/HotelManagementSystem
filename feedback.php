<?php
require('connection.php');
session_start();


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['ban']) && $_SESSION['ban'] == 1) {
    echo <<<alert

    <div class="alert ban alert-danger alert-dismissible fade show position-fixed" role="alert""><i class="bi bi-exclamation-triangle-fill"></i>
    <strong class="me-3">"Access Denied:</strong>We regret to inform you that your access to this platform has been suspended due to violations of our terms of service,If you believe this action was taken in error, please contact our support team for assistance "<a class=" me-2 text-dark " href="contactus.php">Contact Us</a>
    <a class=" me-2 text-dark " href="logout.php">Log Out</a>
    </div>
    
    
    alert;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VA9-FeedBack</title>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .h-font {
            font-family: 'Merienda', cursive;
        }

        .pop:hover {
            border: 2px solid;

            border-color: var(--teal) !important;

            transform: scale(1.1);
            transition: all 0.3s;
        }

        .pop:hover .feedback-name {
            width: 70%;
            background-color: gold !important;
            color: black !important;
        }

        .feedback-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .feedback-card img {
            width: 130px;
            height: 130px;
        }

        .feedback-name {
            width: 70%;
            text-align: center;
        }
        .ban {
            z-index: 1040;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Testimonials</h2>
        <div class="hline bg-dark"></div>
    </div>
    <div class="container">
        <div class="row">
            <?php

            // SQL query to fetch feedback along with user information
            $query = "SELECT feedback.feedback_id, feedback.rating, feedback.subject, feedback.message, registered_users.name, registered_users.image 
                          FROM feedback
                          INNER JOIN registered_users ON feedback.user_id = registered_users.user_id";
            $result = mysqli_query($con, $query);
            $i = 1;
            $fetch_src = FETCH_SRC;


            while ($row = mysqli_fetch_assoc($result)) {
                echo <<<khushhuva
                            <div class="col-lg-3 col-md-3 mb-5 px-2">
                                    <div class="bg-white rounded shadow p-2 border-top border-4 border-dark pop">
                                        <div class=" feedback-card mb-2">
                                            <img src=" $fetch_src$row[image]  " alt=""  class="rounded-circle">
                                            <h5 class="m-0 ms-3 mt-3 bg-dark text-light feedback-name "> $row[name]</h5>
                                            <p class="mt-3">$row[message]</p>
                                        </div>
                                    </div>
                                </div>

                            khushhuva;
                $i++;
            }
            ?>
        </div>
    </div>
    <?php require('inc/footer.php'); ?>
</body>

</html>