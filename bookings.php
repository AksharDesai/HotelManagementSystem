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



if (empty($_GET['room_id'])) {
    header("location:successfull.php");
} else {

    $_SESSION['room_id'] = $_GET['room_id'];
    $_SESSION['price'] = $_GET['price'];

    $price = $_SESSION['price'];


    // echo $_GET['room_id'] . "< GET<br>";
    // echo $_SESSION['room_id'] . "< SESSION<br>";
    // echo $_SESSION['price'] . "< PRICE SESSION<br>";
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

    <script>
         function calculateTotalPrice() {
        var pricePerNight = <?php echo isset($_SESSION['price']) ? $_SESSION['price'] : 0; ?>;
        var checkIn = document.getElementById("check_in").value;
        var checkOut = document.getElementById("check_out").value;

        if (checkIn && checkOut) {
            var daysDifference = Math.ceil((new Date(checkOut) - new Date(checkIn)) / (1000 * 60 * 60 * 24));
            var totalPrice = pricePerNight * daysDifference;
            document.getElementById("total_price").innerText = "Total Price: $" + totalPrice;
            document.getElementById("total_days").innerText = "Total Days: " + daysDifference;
        } else {
            document.getElementById("total_price").innerText = "";
            document.getElementById("total_days").innerText = "";
        }
        
        validatePrice(); // Call validatePrice function after calculating total price
    }
    function validatePaymentAmount() {
    var paymentAmount = parseFloat(document.getElementById("payment_amount").value);
    var totalPrice = parseFloat(document.getElementById("total_price").innerText.split("$")[1]);
    var confirmButton = document.getElementById("confirm_booking");

    if (isNaN(paymentAmount)) {
        document.getElementById("payment_error").innerText = "Please enter a valid payment amount.";
        confirmButton.disabled = true;
    } else if (paymentAmount < totalPrice) {
        document.getElementById("payment_error").innerText = "Payment amount must be equal to the displayed price above.";
        confirmButton.disabled = true;
    } else if (paymentAmount > totalPrice) {
        document.getElementById("payment_error").innerText = "Payment amount must be equal to the displayed price above..";
        confirmButton.disabled = true;
    }else {
        document.getElementById("payment_error").innerText = "";
        confirmButton.disabled = false;
    }
}

    function validatePrice() {
        var enteredPrice = parseFloat(document.getElementById("payment_amount").value);
        var totalPrice = parseFloat(document.getElementById("total_price").innerText.split("$")[1]);

        if (enteredPrice !== totalPrice) {
            document.getElementById("price_error").innerText = "Entered price does not match the total price.";
            document.getElementById("confirm_booking").disabled = true; // Disable the confirm button
        } else {
            document.getElementById("price_error").innerText = "";
            document.getElementById("confirm_booking").disabled = false; // Enable the confirm button
        }
    }
    </script>



</head>

<body>



    <?php require('inc/header.php'); ?>


    <div class="my-5 px-4">

        <h2 class="fw-bold h-font text-center">Booking Details</h2>
        <div class="hline bg-dark"></div>

    </div>




    <?php

    $query = "SELECT * FROM  `rooms` WHERE room_id = '$_SESSION[room_id]'";
    $result = mysqli_query($con, $query);
    $i = 1;
    $fetch_srcrad = FETCH_SRCrad;
    while ($fetch = mysqli_fetch_assoc($result)) {

        echo <<<mogambo
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">  
                    <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 p-1 align-items-center">
                            <div class="col-md-12 mb-lg-0 mb-md-0 mb-3 p-2">
                                <img src="$fetch_srcrad$fetch[image]" class="img-fluid rounded mb-2">
                                <h2 class="mb-2">$fetch[name]</h2>
                                <h6 class="card-title">$$fetch[price] per night</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">  
                    <div class="card mb-4 border-0 shadow">
                    <form action="bookings.php" target="_blank" method="post"> <!-- Start form tag -->
                    <div class="row g-0 p-2">
                                <div class="col-md-5 px-1 mb-1">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control bg-light" aria-describedby="emailHelp" name="name" placeholder="$user[name]" required disabled>
                                </div>
                                <div class="col-md-5 px-1 mb-1">
                                    <label class="form-label">Email </label>
                                    <input type="email" class="form-control bg-light" aria-describedby="emailHelp" name="email" placeholder="$user[email]" required disabled>
                                </div>
                                <div class="col-md-6 px-1 mb-2">
                                    <label class="form-label">Phone no</label>
                                    <input type="number" class="form-control bg-light" aria-describedby="emailHelp" name="phoneno" placeholder="$user[phoneno]" required disabled>
                                </div>
                                <div class="col-md-10 px-1 mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                    <textarea class="form-control bg-light" rows="1" name="address" placeholder="$user[address]" required disabled></textarea>
                                </div>
                                                                <div class="col-md-5 ps-0 ps-1 me-3">
                                    <label class="form-label">Check In Date</label>
                                    <input type="date" class="form-control" aria-describedby="emailHelp" name="check_in" id="check_in" onchange="calculateTotalPrice()" required>
                                </div>
                                <div class="col-md-5 ps-0 ps-1 mb-3">
                                    <label class="form-label">Check Out Date</label>
                                    <input type="date" class="form-control" aria-describedby="emailHelp" name="check_out" id="check_out" onchange="calculateTotalPrice()" required>
                                </div>
                                <input type="hidden" name="room_id" value="{$_SESSION['room_id']}"> <!-- Include room_id here -->                                <div class="col-md-12 mb-2 ">
                                    <p id="total_price"></p>
                                    <p id="total_days"></p>
                                </div>

                                <div class="col-md-12 mb-2">
                                <label for="payment_amount" class="form-label">Payment Amount</label>
                                <input type="number" class="form-control" id="payment_amount" name="payment_amount" placeholder="Enter Payment Amount" required oninput="validatePaymentAmount()">
                                <div id="payment_error" class="text-danger"></div>
                            </div>
                            
                                
                            <div class="col-md-12  d-flex justify-content-center"> <!-- Center Confirm Booking button -->
                                <button type="submit" id="confirm_booking" name="confirm_booking" class="btn btn-primary text-white custom-bg shadow-none mb-2 mt-3 w-100" disabled>Confirm Booking</button> <!-- Make button 100% width -->
                            </div>

                            </form> <!-- End form tag -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        mogambo;


        $i++;
    }

    ?>


    <!-- insertion of data will start from here -->

    <?php

    if (isset($_POST['confirm_booking']) && isset($_POST['room_id'])) {


        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];




        if ($check_in == $check_out) {
            echo "Check-in and check-out dates cannot be equal.";
        } elseif ($check_in < date('Y-m-d')) {
            echo "Check-in date cannot be in the past.";
        } elseif (strtotime($check_out) - strtotime($check_in) > 15778463) { // 6 months in seconds
            echo "The difference between check-in and check-out dates cannot be more than 6 months.";
        } else {
            // Calculate the number of days between check-in and check-out dates
            $days_difference = (int)floor((strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24));
            $total_price = $days_difference * $price;

            echo "total price = " . $total_price;

            $insert_query = "INSERT INTO `bookings`(`user_id`, `room_id`, `check_in`, `check_out`, `total_price`) VALUES ('$user[user_id]','$_POST[room_id]','$check_in','$check_out','$_POST[payment_amount]')";
            $result_insert = mysqli_query($con, $insert_query);

            if ($result_insert) {
                // Decrease room quantity by 1
                $update_query = "UPDATE `rooms` SET `quantity` = `quantity` - 1 WHERE `room_id` = '$_POST[room_id]' AND `quantity` > 0";
                $result_update = mysqli_query($con, $update_query);

                if ($result_update) {
                    echo "Room booked successfully.";
                } else {
                    echo "Failed to update room quantity.";
                }
            } else {
                echo "Failed to insert booking.";
            }
        }
        unset($_SESSION['room_id']);
    }

    ?>










    <?php require('inc/footer.php'); ?>






</body>

</html>