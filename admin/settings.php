<?php
require('inc\connection.php');
session_start();
?>


<?php

$roomLabels = array(
    46 => "Premier",
    47 => "Jacuzzi",
    48 => "Superior",
    49 => "Executive",
    50 => "Suite",
    51 => "Deluxe Suite"
);

// Fetch the count of bookings for each type of room
$dataPoints = array();
foreach ($roomLabels as $roomId => $label) {
    $sql = "SELECT COUNT(*) AS booking_count FROM bookings WHERE room_id = $roomId";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $bookingCount = $row['booking_count'];
    // Push the data to dataPoints array
    $dataPoints[] = array("y" => $bookingCount, "label" => $label, "indexLabelFontColor" => "red");
}

?>

<?php

// Query to fetch monthly booking data
$sql = "SELECT MONTHNAME(check_in) AS month, COUNT(*) AS bookings_count FROM bookings GROUP BY MONTH(check_in)";
$result = mysqli_query($con, $sql);

// Initialize an empty array to store monthly booking data
$monthlyBookingDataPoints = array();

// Loop through the result set and populate the $monthlyBookingDataPoints array
while ($row = mysqli_fetch_assoc($result)) {
    $month = $row['month'];
    $bookingsCount = $row['bookings_count'];
    // Push the month and bookings count as an array to $monthlyBookingDataPoints
    $monthlyBookingDataPoints[] = array("label" => $month, "y" => $bookingsCount);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>
    <link rel="stylesheet" href="admin\css\common.css">

    <?php require('C:\xampp\htdocs\hello\inc\links.php'); ?>

    <style>
        .card-body-content {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .car-body-content-circle i {
            font-size: 3vw;
            color: #FDB904;
        }

        .car-body-content-circle {

            width: 75px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            /* margin-left: -21px; */

            background-color: #f1f3f8;


        }
    </style>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function() {
            // Render chart for room bookings
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light",
                title: {
                    text: "Bookings Based On Type Of Room"
                },
                axisY: {},
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## bookings",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            // Render chart for monthly bookings
            var monthlyBookingsChart = new CanvasJS.Chart("monthlyBookingsChart", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Monthly Bookings"
                },
                axisX: {
                    title: "Month",
                    interval: 1
                },
                axisY: {
                    title: "Number of Bookings",
                    includeZero: true
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($monthlyBookingDataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            monthlyBookingsChart.render();
        }
    </script>
</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>


    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4">






                <!-- Shutdown Section Starts From Here -->
                <div class="card shadow-lg ">
                    <div class="card-body">
                        <div class=" align-items-center justify-content-between mb-3 ">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <p class="my-2">No Customers will be allowed to book hotel room , when Shutdown mode is ON</p>

                            <?php


                            $query = "SELECT * FROM  `shutdown_status` ";
                            $result = mysqli_query($con, $query);
                            $i = 0;

                            while ($fetch = mysqli_fetch_assoc($result)) {

                                $_SESSION["is_shutdown"] = $fetch["is_shutdown"];

                                $isshut = $fetch['is_shutdown'];


                                // Initialize the variable to store the button HTML
                                $buttonHTML = '';

                                if ($isshut) {
                                    // If the user is banned, store HTML for the "Unban" button
                                    $buttonHTML = '<button onclick="confirm_rem2(' . $fetch['id'] . ', false)" class="btn btn-success"><i class="bi bi-arrow-clockwise"></i> Start</button>';
                                } else {
                                    // If the user is not banned, store HTML for the "Ban" button
                                    $buttonHTML = '<button onclick="confirm_rem(' . $fetch['id'] . ', true)" class="btn btn-danger text-light"><i class="bi bi-exclamation-triangle-fill text-dark"></i> Shutdown </button>';
                                }
                            }
                            ?>


                            <?php

                            if (isset($_GET['rem2']) && $_GET['rem2'] > 0) {
                                $query = "SELECT * FROM `shutdown_status` WHERE `id`='$_GET[rem2]'";
                                $result = mysqli_query($con, $query);
                                $fetch = mysqli_fetch_assoc($result);

                                $query = "UPDATE `shutdown_status` SET `is_shutdown`=0 WHERE `id`='$_GET[rem2]'";
                                if (mysqli_query($con, $query)) {
                                } else {
                                }
                            }

                            ?>


                            <?php

                            if (isset($_GET['rem']) && $_GET['rem'] > 0) {

                                $query = "SELECT * FROM `shutdown_status` WHERE `id`='$_GET[rem]'";
                                $result = mysqli_query($con, $query);
                                $fetch = mysqli_fetch_assoc($result);

                                $query = "UPDATE `shutdown_status` SET `is_shutdown`= 1 WHERE `id`='$_GET[rem]'";
                                if (mysqli_query($con, $query)) {
                                } else {
                                }
                            }

                            ?>

                            <?php
                            echo $buttonHTML;
                            ?>
                            <!-- <input class="form-check-input " type="checkbox" id="shutdown-toggle" name="shutdown_toggle"> -->

                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->


                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-10 ms-auto p-4">





                <div class="row">
                    <div class="col-lg-2">

                        <div class="card shadow-lg ">
                            <div class="card-body">


                                <div class="card-body-content">


                                    <div class="car-body-content-circle">
                                        <i class="bi bi-people"></i>

                                    </div>

                                    <div class="card-body-content-text text-center">

                                        <?php
                                        $sql = "SELECT COUNT(*) AS total_users FROM registered_users WHERE `level`= 1";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print result
                                        echo "<h1>" . $row['total_users'] . "</h1>";
                                        echo "<h6>Total users</h6>";

                                        ?>


                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2">

                        <div class="card shadow-lg ">
                            <div class="card-body">


                                <div class="card-body-content">


                                    <div class="car-body-content-circle" >
                                        <i class="bi bi-hospital" style="color: red;"></i>


                                    </div>

                                    <div class="card-body-content-text text-center">
                                        <?php
                                        $sql = "SELECT SUM(quantity) AS total_rooms FROM rooms";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print result
                                        echo "<h1>" . $row['total_rooms'] . "</h1>";
                                        echo "<h6>Total rooms</h6>";
                                        ?>
                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-2">

                        <div class="card shadow-lg ">
                            <div class="card-body">


                                <div class="card-body-content">


                                    <div class="car-body-content-circle">
                                        <i class="bi bi-journal-check" style="color: green;"></i>


                                    </div>

                                    <div class="card-body-content-text text-center">

                                        <?php
                                        $sql = "SELECT COUNT(*) AS total_bookings FROM bookings WHERE status != 2";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print result
                                        echo "<h1>" . $row['total_bookings'] . "</h1>";
                                        echo "<h6>Total bookings</h6>";
                                        ?>

                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2">

                        <div class="card shadow-lg ">
                            <div class="card-body">


                                <div class="card-body-content">


                                    <div class="car-body-content-circle">
                                        <i class="bi bi-calendar3" style="color: blue;"></i>


                                    </div>

                                    <div class="card-body-content-text text-center">

                                        <?php
                                        $sql = "SELECT COUNT(*) AS total_customers_in_hotel FROM bookings WHERE status = 1";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print result
                                        echo "<h1>" . $row['total_customers_in_hotel'] . "</h1>";
                                        echo "<h6>Not Checked Out </h6>";
                                        ?>

                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-2">

                        <div class="card shadow-lg ">
                            <div class="card-body">


                                <div class="card-body-content">


                                    <div class="car-body-content-circle">
                                        <i class="bi bi-calendar2-check" style="color: brown;"></i>


                                    </div>

                                    <div class="card-body-content-text text-center">

                                        <?php
                                        $sql = "SELECT COUNT(*) AS checked_out FROM bookings WHERE status = 3";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print result
                                        echo "<h1>" . $row['checked_out'] . "</h1>";
                                        echo "<h6>Checked Out </h6>";
                                        ?>

                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2">

                        <div class="card shadow-lg ">
                            <div class="card-body">


                                <div class="card-body-content">


                                    <div class="car-body-content-circle">
                                        <i class="bi bi-calendar-x-fill" style="color: red;"></i>


                                    </div>

                                    <div class="card-body-content-text text-center">

                                        <?php
                                        $sql = "SELECT COUNT(*) AS cancelled FROM bookings WHERE status = 2";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print result
                                        echo "<h1>" . $row['cancelled'] . "</h1>";
                                        echo "<h6>Cancelled Booking </h6>";
                                        ?>

                                    </div>





                                </div>
                            </div>

                        </div>
                    </div>








                </div>
            </div>




            <div class="col-lg-10 ms-auto p-4">





                <div class="row">
                    <div class="col-lg-12">

                        <div class="card shadow-lg ">
                            <div class="card-body">



                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>


                            </div>

                        </div>
                    </div>

                </div>





            </div>

            <div class="col-lg-10 ms-auto p-4">





                <div class="row">
                    <div class="col-lg-12">

                        <div class="card shadow-lg ">
                            <div class="card-body">

                                <?php
                                // Array to store the total quantity of each room type
                                $totalRoomQuantity = array();

                                // Fetch room data from the database
                                $sql = "SELECT * FROM rooms";
                                $result = mysqli_query($con, $sql);

                                // Loop through each row of room data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Increment the total quantity for the current room type
                                    if (isset($totalRoomQuantity[$row['name']])) {
                                        $totalRoomQuantity[$row['name']] += $row['quantity'];
                                    } else {
                                        $totalRoomQuantity[$row['name']] = $row['quantity'];
                                    }
                                }

                                // Output the total quantity of each room type
                                foreach ($totalRoomQuantity as $roomName => $totalQuantity) {
                                    echo "<p><strong> Room Type :</strong> $roomName | <strong>Total Rooms available :</strong> $totalQuantity</p>";
                                }
                                ?>


                            </div>

                        </div>
                    </div>

                </div>





            </div>


            <div class="col-lg-10 ms-auto p-4">





                <div class="row d-flex justify-content-center align-items-center">


                    <div class="col-lg-2 me-5">

                        <div class="card shadow-lg ">
                            <div class="card-body">

                                <div class="card-body-content">
                                    <div class="car-body-content-circle">
                                        <i class="bi bi-currency-dollar" style="color: green;"></i>
                                    </div>
                                    <div class="card-body-content-text text-center">
                                        <?php
                                        // Query to calculate the total revenue from bookings where status is not equal to 2 (not canceled)
                                        $sql = "SELECT SUM(total_price) AS total_revenue FROM bookings WHERE status != 2";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print total revenue
                                        echo "<h4>" . ($row['total_revenue'] ?? 0) . "</h4>"; // Use null coalescing operator to handle case where no bookings are found
                                        echo "<h6>Total Revenue</h6>";
                                        ?>
                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                    <!-- stop ^ -->
                    <div class="col-lg-2 me-5">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="card-body-content">
                                    <div class="car-body-content-circle">
                                        <i class="bi bi-x-lg" style="color: red;"></i>
                                    </div>
                                    <div class="card-body-content-text text-center">
                                        <?php
                                        // Query to calculate the total revenue from cancelled bookings where status is equal to 2
                                        $sql = "SELECT SUM(total_price) AS total_revenue FROM bookings WHERE status = 2";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print total revenue
                                        echo "<h4>" . ($row['total_revenue'] ?? 0) . "</h4>"; // Use null coalescing operator to handle case where no cancelled bookings are found
                                        echo "<h6>Cancelled Booking Revenue</h6>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- stop ^ -->
                    <div class="col-lg-2 me-5">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="card-body-content">
                                    <div class="car-body-content-circle">
                                        <i class="bi bi-chat-dots" style="color: brown;"></i>
                                    </div>
                                    <div class="card-body-content-text text-center">
                                        <?php
                                        // Query to count the total feedback received
                                        $sql = "SELECT COUNT(*) AS total_feedback FROM feedback";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print total feedback count
                                        echo "<h4>" . ($row['total_feedback'] ?? 0) . "</h4>"; // Use null coalescing operator to handle case where no feedback is found
                                        echo "<h6>Total Feedback Received</h6>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- stop ^ -->

                    <div class="col-lg-2 me-5">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="card-body-content">
                                    <div class="car-body-content-circle">
                                        <i class="bi bi-chat-dots" style="color: black;"></i>
                                    </div>
                                    <div class="card-body-content-text text-center">
                                        <?php
                                        // Query to count the total user queries
                                        $sql = "SELECT COUNT(*) AS total_queries FROM user_queries";

                                        // Execute query
                                        $result = mysqli_query($con, $sql);

                                        // Fetch result
                                        $row = mysqli_fetch_assoc($result);

                                        // Print total queries count
                                        echo "<h4>" . ($row['total_queries'] ?? 0) . "</h4>"; // Use null coalescing operator to handle case where no queries are found
                                        echo "<h6>Total User Queries</h6>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- stop ^ -->




                </div>





            </div>

            <div class="col-lg-10 ms-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="card-body-content">
                            <div id="monthlyBookingsChart" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-10 ms-auto mt-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="card-body-content">
                            <?php
                            // Query to calculate the monthly earnings
                            $sql = "SELECT MONTHNAME(check_in) AS month, SUM(total_price) AS monthly_earnings FROM bookings WHERE status != 2 GROUP BY MONTH(check_in)";
                            $result = mysqli_query($con, $sql);

                            // Initialize an empty array to store monthly earnings data
                            $monthlyEarningsData = array();

                            // Loop through the result set and populate the $monthlyEarningsData array
                            while ($row = mysqli_fetch_assoc($result)) {
                                $month = $row['month'];
                                $earnings = $row['monthly_earnings'];
                                // Store the month and earnings as key-value pairs in the $monthlyEarningsData array
                                $monthlyEarningsData[$month] = $earnings;
                            }

                            // Output the monthly earnings
                            foreach ($monthlyEarningsData as $month => $earnings) {
                                echo "<p><strong>$month:</strong> $earnings</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>






        </div>

    </div>








    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>




    <script>
        function confirm_rem(id) {
            if (confirm("Are you sure,You want to SHUTDOWN the site")) {
                window.location.href = "settings.php?rem=" + id;
            }

        }

        function confirm_rem2(id) {
            if (confirm("Are you sure,You want to START the site")) {
                window.location.href = "settings.php?rem2=" + id;
            }

        }
    </script>





</body>

</html>