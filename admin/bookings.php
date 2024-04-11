<?php
require('inc\connection.php');
require('C:\xampp\htdocs\hello\inc\links.php');
session_start();


if (isset($_POST['save_changes'])) {
    // Retrieve booking ID and status from the form
    $bookingId = mysqli_real_escape_string($con, $_POST['booking_id']);
    $status = isset($_POST['status']) ? mysqli_real_escape_string($con, $_POST['status']) : '';

    // Update the status field in the bookings table
    $query = "UPDATE bookings SET status = '$status' WHERE booking_id = '$bookingId'";

    if (mysqli_query($con, $query)) {
        // Status updated successfully
        echo '<script>alert("Status updated successfully");</script>';
    } else {
        // Error updating status
        echo '<script>alert("Error updating status");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>


    <link rel="stylesheet" href="admin\css\common.css">

    <style>
        .flex-heading {
            display: flex;
            justify-content: center;
            align-items: center;


        }

        .addroom-button {
            padding-left: 500px;
            padding-right: 500px;
            font-size: 25px;
            border: solid 1px black;
        }

        .suchna-message {
            position: absolute;
            top: 20%;
            right: 2%;
        }

        .filter-options {
            width: fit-content;
            height: 50px;
            margin-left: 17%;
        }

        select option:hover {
            background-color: transparent !important;
        }

        select option {
            pointer-events: none;
            /* Disable pointer events */
        }
    </style>

</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>


    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 flex-heading">


                <h3 class="mb-4 btn btn-warning addroom-button addroom-button"><i class="bi bi-journal-medical"></i> Bookings</h3>

                <hr>


            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form action="bookings.php" method="POST">

                        <p>Booking ID: <span id="bookingId"></span></p>
                        <input type="hidden" id="bookingIdInput" name="booking_id">

                        <select class="form-select" aria-label="Filter by status" name="status">

                            <option value="1" selected>Not Checked Out Yet</option>
                            <option value="2">Cancelled Bookings</option>
                            <option value="3">Checked Out Bookings</option>
                        </select>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn custom-bg text-white" name="save_changes">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="filter-options d-flex ">

        <?php
        $filter_status = 0;

        // Handle form submission
        if (isset($_GET['filter_submit'])) {
            // Retrieve the selected filter status
            $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : 0;
        }
        ?>

        <form action="bookings.php" method="GET" class="d-flex">
            <select class="form-select" aria-label="Filter by status" name="filter_status">
                <option value="0" <?php if ($filter_status == 0) echo 'selected'; ?>>All Bookings</option>
                <option value="1" <?php if ($filter_status == 1) echo 'selected'; ?>>Not Checked Out Yet</option>
                <option value="2" <?php if ($filter_status == 2) echo 'selected'; ?>>Cancelled Bookings</option>
                <option value="3" <?php if ($filter_status == 3) echo 'selected'; ?>>Checked Out Bookings</option>
            </select>

            <button type="submit" class="btn custom-bg  fw-bold" name="filter_submit">Filter</button>
        </form>
    </div>


    <div class="container-fluid mt-1" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-0">
                <table class="table table-hover text-center">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col" class="rounded-start">Sr.No</th>

                            <th scope="col">User-Name</th>
                            <th scope="col">Phone no</th>
                            <th scope="col">Room-id</th>
                            <th scope="col">Check-IN</th>
                            <th scope="col">Check-OUT</th>
                            <th scope="col">Total Price</th>

                            <th scope="col" class="rounded end">Action</th>
                            <th scope="col" class="rounded end">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php


                        // Handle filter selection
                        $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : 0; // Default: Show all bookings

                        // Construct the WHERE clause based on filter selection
                        $where_clause = "";
                        if ($filter_status == 1) {
                            $where_clause = "WHERE status = 1"; // Not Checked Out Yet
                        } elseif ($filter_status == 2) {
                            $where_clause = "WHERE status = 2"; // Cancelled Bookings
                        } elseif ($filter_status == 3) {
                            $where_clause = "WHERE status = 3"; // Checked Out Bookings
                        }

                        // Modify the WHERE clause if filter_status is 0 (All Bookings)
                        if ($filter_status == 0) {
                            // No filtering needed, so don't add any condition to the WHERE clause
                        }

                        $query = "SELECT bookings.*, registered_users.name, registered_users.phoneno 
                            FROM `bookings` 
                            JOIN registered_users ON bookings.user_id = registered_users.user_id 
                            $where_clause";
                        $result = mysqli_query($con, $query);
                        $i = 1;

                        while ($fetch = mysqli_fetch_assoc($result)) {

                            $print_status = '';
                            if ($fetch['status'] == 1) {
                                $print_status = '<span style="color:rgb(147, 125, 2); font-weight: 600;">Not Checked Out</span>';
                            } elseif ($fetch['status'] == 2) {
                                $print_status = '<span style="color: red;font-weight: 600;">Booking Cancelled</span>';
                            } elseif ($fetch['status'] == 3) {
                                $print_status = '<span style="color: green;font-weight: 600;">Checked Out</span>';
                            }



                            echo <<<product
                        <tr>
                            <th scope="row">$i</th>
                            
                           
                            <td>$fetch[name]</td>
                            <td>$fetch[phoneno]</td>
                            <td>$fetch[room_id]</td>
                            <td>$fetch[check_in]</td>
                            <td>$fetch[check_out]</td>
                            <td>$fetch[total_price]</td> 
                            <td><button onclick="confirm_rem($fetch[booking_id])" class="btn btn-danger text-light "><i class="bi bi-trash3-fill  text-light"></i></button> 
                            <button onclick="launchModal('$fetch[booking_id]')" class="btn custom-bg"><i class="bi bi-arrow-bar-down"></i></button>
                                </td>

                                <td>$print_status </td>

                            
                        </tr>
                        product;
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php

    if (isset($_GET['rem']) && $_GET['rem'] > 0) {
        $query = "SELECT * FROM `bookings` WHERE `booking_id`='$_GET[rem]'";
        $result = mysqli_query($con, $query);
        $fetch = mysqli_fetch_assoc($result);

        $query = "DELETE  FROM `bookings` WHERE `booking_id`='$_GET[rem]'";
        if (mysqli_query($con, $query)) {
            echo <<<alert

        <div class="alert alert-warning alert-dismissible fade show suchna-message" role="alert"">
        <strong class="me-3">Done</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

     
        alert;
            exit();
        } else {
            echo <<<alert2

        <div class="alert alert-warning alert-dismissible fade show" role="alert"">
        <strong class="me-3">Sorry</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

     
        alert2;
            exit();
        }
    }

    ?>

























    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>


    <script>
        function confirm_rem(booking_id) {
            if (confirm("Are you sure,Delete? ")) {
                window.location.href = "bookings.php?rem=" + booking_id;
            }

        }
    </script>

    <script>
        // JavaScript function to launch modal and pass booking_id
        function launchModal(bookingId) {
            // Set the booking_id in the modal content
            document.getElementById('bookingId').textContent = bookingId;

            document.getElementById('bookingIdInput').value = bookingId;
            // Launch the modal
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        }
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>