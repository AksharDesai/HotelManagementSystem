<?php

require('connection.php');
session_start();




if (isset($_SESSION['name'])) {
    // Database connection
    // require 'connection.php'; // Adjust this according to your connection script

    // Fetch user details from database
    $user_name = mysqli_real_escape_string($con, $_SESSION['name']); // Assuming user ID is stored in session
    $sql = "SELECT * FROM registered_users WHERE `name` = '$user_name'";  // Adjust table and column names as needed
    $result_user = mysqli_query($con, $sql); // Use a different variable name

    // Check if query executed successfully
    if ($result_user) {
        // Check if user exists
        if (mysqli_num_rows($result_user) == 1) {
            // Fetch user details
            $user = mysqli_fetch_assoc($result_user);
            // Output user details

            // Output other details as needed
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error executing query: " . mysqli_error($con);
    }

    // Close database connection (assuming it's no longer needed)
    // mysqli_close($con);
} else {
    echo "User not logged in.";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedBack Form</title>
    <style>
        .text-slog {
            margin-top: 40px;
            margin-bottom: 60px;
        }
    </style>
</head>

<body>

    <?php require('inc/header.php'); ?>


    <div class="my-5 px-4">

        <h2 class="fw-bold  text-center">Feedback</h2>
        <div class="hline bg-dark"></div>

    </div>


    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6  px-4">
                <div class="bg-white rounded shadow p-4 ">

                    <h1 class=" custom-font text-slog ">We'd love to hear your thoughts </h1>

                    <h6 class="mb-4">Tell us about your vision : which challanges are you facing? we'd love to stay in touch with you. so we are always ready to answer any question that interests you</h6>


                    <a href="tel :+916354747685" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+919825020460</a>
                    <br>
                    <h5 class="mt-4 fw-bold ">Email</h5>
                    <i class="bi bi-envelope-fill mx-1"></i><a class="d-inline-block mb-2 text-decoration-none text-dark" href="mailto: akshar25desai@gmail.com">akshar25desai@gmail.com</a>


                    <h5 class="mt-4 fw-bold ">Follow us</h5>
                    <a href="#" class="d-inline-block    fs-8  text-dark me-2">
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


                        <div class="mt-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="name" value="<?php echo $user['name']; ?>" disabled required>
                        </div>


                        <div class="mt-3">
                            <label class="form-label fw-bold">Email address</label>
                            <input type="email" class="form-control" aria-describedby="emailHelp" name="email" value="<?php echo $user['email']; ?>" disabled required>
                        </div>

                        <label class="form-label fw-bold mt-3">Rating</label>

                        <br>

                        <div class="form-chec  form-check-inline ">
                            <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i>
                            </label>
                        </div>

                        <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="2">
                            <label class="form-check-label" for="exampleRadios1">
                                <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i>
                            </label>
                        </div>

                        <div class="form-check form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="3">
                            <label class="form-check-label" for="exampleRadios1">
                                <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i>
                            </label>
                        </div>

                        <div class="form-check form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="4">
                            <label class="form-check-label" for="exampleRadios1">
                                <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i>
                            </label>
                        </div>

                        <div class="form-check form-check form-check-inline ">
                            <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="5">
                            <label class="form-check-label" for="exampleRadios1">
                                <i class="bi bi-star-fill text-warning"></i>
                            </label>
                        </div>




                        <div class="mt-3">
                            <label class="form-label fw-bold">Subject</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="subject" required>
                        </div>

                        <div class="mt-3">
                            <label class="form-label  fw-bold">Message</label>
                            <textarea class="form-control" rows="2" name="message" required></textarea>
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

        $q = "INSERT INTO `feedback`( `user_id`,`rating`, `subject`, `message`) VALUES ('$user[user_id]','$_POST[rating]','$_POST[subject]','$_POST[message]')";

        if (mysqli_query($con, $q)) {
            echo <<<alert

    <div class="alert alert-success fade show custom-alert role="alert">
    <strong class="me-3">Successfully Submited Your Feed back</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>

 
    alert;
   
        } else {
            echo <<<alert

    <div class="alert  alert-danger fade show custom-alert role="alert">
    <strong class="me-3">Unable To Submit Your Feedback</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>



 
    alert;
 
        }
    }
    ?>



    <?php require('inc/footer.php'); ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>