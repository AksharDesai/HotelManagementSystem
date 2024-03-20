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
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">Filters</h4>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterdropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterdropdown">

                            <div class="border bg-light p-3 rounded mb-3 ">

                                <h5 class="mb-3" style="font-size:18px;">Check Availability</h5>

                                <label class="form-label ">Check-in</label>

                                <input type="date" class="form-control mb-3 ">

                                <label class="form-label">Check-out</label>

                                <input type="date" class="form-control ">


                            </div>
                            <div class="border bg-light p-3 rounded mb-3 ">

                                <h5 class="mb-3" style="font-size:18px;">Facilities</h5>

                                <div class="mb-0.5">
                                    <input type="checkbox" id="f1" class="form-check-input  shadow-none mb-3 me-1 ">
                                    <label class="form-label ">Facility one</label>


                                </div>
                                <div class="mb-0.5">
                                    <input type="checkbox" id="f2" class="form-check-input  shadow-none mb-3 me-1 ">
                                    <label class="form-label ">Facility Two</label>


                                </div>
                                <div class="mb-0.5">
                                    <input type="checkbox" id="f3" class="form-check-input  shadow-none mb-3 me-1 ">
                                    <label class="form-label ">Facility Three</label>


                                </div>





                            </div>
                            <div class="border bg-light p-3 rounded mb-3 ">

                                <h5 class="mb-3" style="font-size:18px;">Guests</h5>

                                <div class="d-flex">

                                    <div class="me-3">
                                        <label class="form-label">Adults</label>
                                        <input type="number" class="form-control ">

                                    </div>
                                    <div>
                                        <label class="form-label">Children</label>
                                        <input type="number" class="form-control ">

                                    </div>
                                </div>




                            </div>






                        </div>

                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">



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
                                                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">$fetch[features]</span>
                                                            
                                                            
                                                            
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
                                                        
                                                        <a href="" class="btn  text-white custom-bg shadow-none mb-2">Book Now</a>
                                                        <a href="#" class="btn  btn-outline-dark  shadow-none">More Details</a>
                                                            
                                                            
                                                        
                                                        
                                                        
                                                        
                                                        </div>
                                                        </div>
                                                        </div>
                                                    
                                            mogambo;



                    $i++;
                }

                ?>

                <!-- bus bus -->

            </div>
        </div>
    </div>
    </div>






    <?php require('inc/footer.php'); ?>






</body>

</html>