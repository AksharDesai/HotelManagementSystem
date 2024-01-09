<?php

require('connection.php');
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;

        }

        .h-font {
            font-family: 'Merienda', cursive;
        }

        .custom-bg {
            background-color: #2ec1ac;

        }

        .custom-bg:hover {
            background-color: #279e8c;
        }

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
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg sticky-top px-lg-3 py-lg-2 ">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold h-font fs-3 " href="index.php">VA9</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="room.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="facilities.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>


                </ul>
                <form class="d-flex">
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

                        echo <<<data
                    <div class="btn-group">
                    <button type="button" class="btn btn-outline-dark  dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        $_SESSION[name]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="#">Profile</b></li>
                        <li><a class="dropdown-item" href="#">Booking</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                    </div>
                    data;
                    } else {
                        echo <<<data
                        
                        <button type="button" class="btn btn-outline-dark shadow me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Login
                        </button>
                        <button type="button" class="btn btn-outline-dark shadow " data-bs-toggle="modal" data-bs-target="#registerModal">
                            Register
                        </button>


                        data;
                    }


                    ?>

                </form>
            </div>
        </div>
    </nav>

    <!-- login modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header ">
                    <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="login_register.php" method="POST">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" aria-describedby="emailHelp" name="email_username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" aria-describedby="emailHelp" name="password" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <button type="submit" class="btn btn-dark" name="login">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>

                    </div>


                </form>
            </div>



        </div>
    </div>

    <!-- register modal -->

    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header ">
                    <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-badge fs-3 me-2"></i>User Registration</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="login_register.php" method="post">
                    <div class="modal-body">
                        <span class="badge bg-light text-dark lh-base text-wrap mb-3">Note: Yours details must match with your ID . That will be required at the time of your check-in</span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" name="name" required>
                                </div>
                                <div class="col-md-6 p-0">
                                    <label class="form-label">Email </label>
                                    <input type="email" class="form-control" aria-describedby="emailHelp" name="email" required>
                                </div>
                                <div class="col-md-6 ps-0">
                                    <label class="form-label">Phone no</label>
                                    <input type="number" class="form-control" aria-describedby="emailHelp" name="phoneno" required>
                                </div>
                                <!-- <div class="col-md-6 ps-0">
                                    <label class="form-label">Picture</label>
                                    <input type="file" class="form-control" aria-describedby="emailHelp">
                                </div> -->

                                <div class="col-md-12 p-0 mb-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                        <textarea class="form-control" rows="1" name="address" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 p-0">
                                    <label class="form-label">Pincode </label>
                                    <input type="number" class="form-control" aria-describedby="emailHelp" name="pincode" required>
                                </div>
                                <div class="col-md-6 ps-0">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" aria-describedby="emailHelp" name="birthdate" required>
                                </div>
                                <div class="col-md-6 p-0">
                                    <label class="form-label">Password </label>
                                    <input type="password" class="form-control" aria-describedby="emailHelp" name="password" required>
                                </div>

                                <div class="col-md-6 ps-0">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" aria-describedby="emailHelp" name="repeat_password">
                                </div>

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark my-1" name="register">Register</button>
                            </div>


                </form>

            </div>
            <!-- <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" aria-describedby="emailHelp">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                            </div> -->

        </div>

    </div>


    </div>



    </div>


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

    <!-- check availability form -->
    <div class="container availability-form ">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 shadow-lg rounded ">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control ">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control ">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
                            <select class="form-select">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="col-lg-1 mb-lg-3 mb-2">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Our Rooms -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow-lg" style="max-width: 350px; margin:auto;">
                    <img src="images\rooms\1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Simple Room</h5>
                        <h6 class="card-title mb-4">₹200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Rooms</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Bathroom</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Balcony</span>


                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Television</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">AC</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Room heater</span>
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

                            <a href="#" class="btn  text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn  btn-outline-dark  shadow-none">More Details</a>


                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow-lg" style="max-width: 350px; margin:auto;">
                    <img src="images\rooms\1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Simple Room</h5>
                        <h6 class="card-title mb-4">₹200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Rooms</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Bathroom</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Balcony</span>


                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Television</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">AC</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Room heater</span>
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

                            <a href="#" class="btn  text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn  btn-outline-dark  shadow-none">More Details</a>


                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow-lg" style="max-width: 350px; margin:auto;">
                    <img src="images\rooms\1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Simple Room</h5>
                        <h6 class="card-title mb-4">₹200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Rooms</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">2 Bathroom</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">1 Balcony</span>


                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Television</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">AC</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">Room heater</span>
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

                            <a href="#" class="btn  text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn  btn-outline-dark  shadow-none">More Details</a>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
            </div>
        </div>

        
    </div>

    
    <br> <br> <br> <br> <br> <br>









    <script src=" https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>