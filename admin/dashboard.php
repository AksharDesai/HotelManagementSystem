<?php
require('inc\connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>
    <link rel="stylesheet" href="admin\css\common.css">

    <?php require('C:\xampp\htdocs\hello\inc\links.php'); ?>
</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>


    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4">


                <h3 class="mb-4">Dashboard</h3>




                <!-- Shutdown Section Starts From Here -->
                <div class="card shadow-lg ">
                    <div class="card-body">
                        <div class=" align-items-center justify-content-between mb-3 ">

                            <div class="card border-success mb-3" style="max-width: 18rem;">
                                <div class="card-header">Header</div>
                                <div class="card-body text-success">
                                    <?php
                                    // Connect to MySQL database (replace 'localhost', 'username', 'password', and 'database_name' with your actual database credentials)


                                    // Retrieve the current visitor count from the database
                                    $query = "SELECT count FROM visitor_count WHERE id = 1";
                                    $result = mysqli_query($con, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $count = $row['count'];
                                    } else {
                                        // If no count exists in the database, initialize the count to 0
                                        $count = 0;
                                    }

                                    // Check if the session variable 'visited' is not set

                                    if (!isset($_SESSION['visited'])) {
                                        // If not set, increment the visit count
                                        $_SESSION['visited'] = true;
                                        $count++;

                                        // Update the visitor count in the database
                                        $update_query = "UPDATE visitor_count SET count = $count WHERE id = 1";
                                        mysqli_query($con, $update_query);
                                    }

                                    // Display the visitor count
                                    echo "Total visitors: $count";

                                    // Close the database connection
                                    mysqli_close($con);
                                    ?>


                                </div>
                            </div>






                        </div>
                    </div>

                </div>
            </div>








        </div>
    </div>










    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>





</body>

</html>