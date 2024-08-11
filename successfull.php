<?php
require('connection.php');
session_start();
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
    <?php require('inc/header.php'); ?>

    <div class="my-3 px-4">
        <h2 class="fw-bold text-center">Booked <i class="bi bi-check-circle-fill"></i></h2>
        <div class="hline bg-dark"></div>
    </div>

    <?php
    if (isset($_SESSION['user_id'])) {
        // echo "$_SESSION[user_id]";
    } else {
        echo "nahi mili user id <br>";
    }

    $query = "SELECT `booking_id`, `check_in`, `check_out`, `room_id`, `name`, `email` FROM `bookings`
    INNER JOIN `registered_users` ON bookings.user_id = registered_users.user_id WHERE bookings.user_id = '$_SESSION[user_id]' LIMIT 1";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query executed successfully
    if ($result) {
        $row = mysqli_fetch_assoc($result); // Fetch only one row

        // Access data from the $row variable
        // Example: $row['bookings_column_name'], $row['rooms_column_name'], $row['users_column_name']
        // Display or process the data as needed
        echo <<<krishna
        <div class="card center border-5 border-dark" style="width: 25rem;">
            <div class="card-body">
                <h5 class="">Name :- {$row['name']}</h5>
                <h5 class="">{$row['email']}</h5>
                <p>Booking-ID :- {$row['booking_id']} <br> Room-Number :- {$row['room_id']} <br> Check_in-DATE :- {$row['check_in']} <br> Check_out-DATE :- {$row['check_out']} </p>
            </div>
            <img src="images\card-image.jpg" class="img" alt="...">
        </div>
        <br>
        <h6 class="text-center fw-light">Make Sure to take a screenshot of the E-Card </h6>
        krishna;
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>