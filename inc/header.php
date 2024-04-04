    <!-- Navbar -->

    <?php include("links.php") ?>
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
                    <li class="nav-item">
                        <a class="nav-link" href="feedbackform.php">FeedBack</a>
                    </li>


                </ul>
                <form class="d-flex">
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['level'] == 1) {

                        echo <<<data

                    
                    <div class="btn-group">
                    <a class="nav-link active link-warning btn-outline-dark text-decoration-none shadow-none btn-sm " aria-current="page" target="_blank" href="admin\settings.php">Admin</a>
                    <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        $_SESSION[name]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="successfull.php">Booking</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                    </div>
                    data;
                    } else if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['ban'] == 1) {

                        echo <<<data

                    
                    <div class="btn-group">
                    
                    <button type="button" class="btn btn-outline-dark  dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        $_SESSION[name]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</b></li>
                        <li><a class="dropdown-item" href="#">Banned</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                    </div>
                    data;
                    } else if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

                        echo <<<data

                    
                    <div class="btn-group">
                    
                    <button type="button" class="btn btn-outline-dark  dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        $_SESSION[name]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="successfull.php">Booking</a></li>
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
                            <a href="forgotpage.php" class="btn btn-outline-danger text-dark border-0" >
                                Forget Password ?
                            </a>
                        </div>

                    </div>


                </form>
            </div>



        </div>
    </div>

    <!-- login modal ends here -->

    <!-- register modal -->

    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header ">
                    <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-badge fs-3 me-2"></i>User Registration</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="login_register.php" method="post" enctype="multipart/form-data">
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

                                <div class="col-md-6 ps-0">
                                    <label class="input-group-text">Picture</label>
                                    <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.svg">
                                </div>

                                <div class="col-md-12 p-0 mb-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                        <textarea class="form-control" rows="1" name="address" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 ps-1">
                                    <label class="form-label">Pincode </label>
                                    <input type="number" class="form-control" aria-describedby="emailHelp" name="pincode" required>
                                </div>
                                <div class="col-md-6 ps-0 ps-1">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" aria-describedby="emailHelp" name="birthdate" required>
                                </div>
                                <div class="col-md-6 p-0 ps-1 my-2">
                                    <label class="form-label">Password </label>
                                    <input type="password" class="form-control" aria-describedby="emailHelp" name="password" required>
                                </div>

                                <div class="col-md-6 ps-1 my-2">
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

    <!-- register modal ends here -->



    <!-- Forget Modal Starts Here -->

    <div class="modal fade" id="forgetmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header ">
                    <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>Reset Password</h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="forgotpassword.php" method="POST">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" aria-describedby="email" name="email" required>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Go Back</button>
                            <button type="submit" class="btn btn-dark reset" name="send-reset-link">Send</button>
                        </div>

                    </div>
                    <br><br><br><br>


                </form>
            </div>



        </div>
    </div>
    <!-- forget modal ends here -->