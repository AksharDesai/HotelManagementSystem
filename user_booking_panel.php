<?php
require('connection.php');
session_start();



// Check if the booking ID is provided in the URL
if (isset($_GET['booking_id'])) {
    // Retrieve the booking ID from the URL
    $booking_id = $_GET['booking_id'];

    // Implement your cancelation logic here, such as updating the booking status or deleting the booking record from the database
    $query = "UPDATE bookings SET `status` = 2 WHERE booking_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $booking_id);
    mysqli_stmt_execute($stmt);

    // After processing, redirect the user back to the user bookings page
    header("Location: user_booking_panel.php");
} else {
    // If booking ID is not provided, redirect the user to an error page or home page
    // echo "no book id";
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VA9-Bookings</title>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>

    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        main {
            width: 100%;
            height: 100%;
        }

        .page-1 {
            width: 100%;
            height: 100%;
            display: flex;
        }

        .left {
            width: 40%;
            height: 100%;
            background-color: red;
        }

        .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .right {
            width: 60%;
            height: 100%;
            /* background-color: yellow; */
            padding: 2vw;
        }

        .h-font {
            font-family: 'Merienda', cursive !important;
        }

        .center {
            margin: 0 auto;
            float: none;

        }

        .img {
            width: 391px;
            height: 126px;

            border-top-left-radius: 0;
            border-top-right-radius: 0;
            /* border-top: 5px solid black; */
        }

        .card-header {
            border-radius: 0;
        }
    </style>
</head>

<body>
    <main>


        <?php require('inc/header.php'); ?>
        <div class="my-3 px-4">
            <h2 class="fw-bold text-center">Your Bookings <i class="bi bi-check-circle-fill"></i></h2>
            <div class="hline bg-dark"></div>
        </div>
        <div class="page-1">
            <div class="left"><img src="images\booking_page.jpg" alt=""></div>



            <div class="right">

                <div class="container mt-5">
                    
                    <div class="table-responsive mt-5 rounded">
                        <table class="table table-bordered table-hover">
                            <thead class="thead bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Room ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               $query = "SELECT `booking_id`, `check_in`, `check_out`, `room_id`, `name`, `email`, `status` FROM `bookings`
                               INNER JOIN `registered_users` ON bookings.user_id = registered_users.user_id WHERE bookings.user_id = '$_SESSION[user_id]'";



                                // Execute the query
                                $result = mysqli_query($con, $query);


                                $count = 1; // Counter for row number
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$count}</td>";
                                    echo "<td>{$row['check_in']}</td>";
                                    echo "<td>{$row['check_out']}</td>";
                                    echo "<td>{$row['room_id']}</td>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td>{$row['email']}</td>";
                                    
                                    // Check if status is 2 (cancelled)
                                    if ($row['status'] == 2) {
                                        echo "<td>Cancelled</td>";
                                    } else {
                                        // If status is not cancelled, show cancel button
                                        echo "<td><button onclick=\"confirm_cancel({$row['booking_id']})\" class=\"btn btn-danger\"><i class=\"bi bi-trash\"></i> Cancel</button></td>";
                                    }
                                
                                    echo "</tr>";
                                    $count++; // Increment row counter
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>










            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </div>
        <script>
            function confirm_cancel(booking_id) {
                if (confirm("Are you sure you want to cancel this booking?")) {
                    window.location.href = "user_booking_panel.php?booking_id=" + booking_id;
                }
            }
        </script>

        
    </main>
</body>

</html>