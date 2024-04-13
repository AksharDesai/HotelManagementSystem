<?php

require('connection.php');
session_start();

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VA9-Rooms</title>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>

    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }

        .h-font {
            font-family: 'Merienda', cursive !important;
        }
    </style>
</head>

<body>

    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Rooms</h2>
        <div class="hline bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 px-4">

                <?php
                $query = "SELECT * FROM  `rooms` ";
                $result = mysqli_query($con, $query);
                $i = 1;
                $fetch_srcrad = FETCH_SRCrad;

                while ($fetch = mysqli_fetch_assoc($result)) {
                    echo <<<mogambo
                                    <div class="card mb-4 border-0 shadow">
                                        <div class="row g-0 p-3 align-items-center">
                                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                                <img src="$fetch_srcrad$fetch[image]" class="img-fluid rounded">
                                            </div>
                                        <div class="col-md-5 px-lg-3 px-md-3 px-0 ">
                                            <h5 class="mb-3">$fetch[name]</h5>
                                            <div class="features mb-3 ">
                                                <h6 class="mb-1">Features</h6>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[features]hgvjhgjy</span>
                                            </div>
                                            <div class="facilities mb-3">
                                                <h6 class="mb-1">Facilities</h6>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[facilities]</span>
                                            </div>
                                            <div class="Guest ">
                                                <h6 class="mb-1">Guests</h6>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[adult] Adult</span>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[children] Children</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                            <h6 class="card-title mb-4">$$fetch[price] per night</h6>
                                    mogambo;

                    if (isset($_SESSION['user_id'])) {
                        echo <<<HTML
                            <a href="bookings.php?room_id=$fetch[room_id]&price=$fetch[price]" class="btn text-white custom-bg shadow-none mb-2">Book Now</a>
                            <a href="feedbackform.php" class="btn btn-outline-dark shadow-none">FeedBack</a>
HTML;
                    } else {
                        echo <<<HTML
                            <button class="btn text-white custom-bg shadow-none mb-2" onclick="openLoginModal()">Book Now</button>
                            <a href="feedbackform.php" class="btn btn-outline-dark shadow-none">FeedBack</a>
HTML;
                    }

                    echo <<<HTML
                                </div>
                            </div>
                        </div>
                        HTML;


                    $_SESSION['price'] = $fetch['price'];
                    $i++;
                }


                ?>

            </div>

        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script>
        function openLoginModal() {
            $('#loginModal').modal('show'); // Assuming your Bootstrap modal uses ID "loginModal"
        }
    </script>

</body>

</html>