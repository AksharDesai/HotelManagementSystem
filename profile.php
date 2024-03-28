<?php
session_start();
require("connection.php");




if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `registered_users` WHERE `user_id` = $user_id";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the user's data
    $user_data = mysqli_fetch_assoc($result);
} else {
    // Handle error if user data not found
    $user_data = array();
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc\links.php'); ?>
    <link rel="stylesheet" href="C:\xampp\htdocs\hello\css\common.css">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>Profile</title>


</head>

<body>

    <?php require('inc/header.php'); ?>

    <div class="container mt-5">
        <h1 class="mb-0">Profile</h1>
        <h6 class="text-secondary">Home>Profile</h6>
    </div>




    <div class="container Info-form mt-4 ">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 shadow-lg rounded ">


                <h5 class="mb-4">Basic information</h5>
                <form>
                    <div class="row align-items-end">

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input type="text" class="form-control " value="<?php echo $user_data['name'] ?? ''; ?>" required>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Phone Number</label>
                            <input type="number" class="form-control" aria-describedby="emailHelp" name="phoneno" value="<?php echo $user_data['phoneno'] ?? ''; ?>" required>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <label class="form-label" style="font-weight: 500;">Date of Birth</label>
                            <input type="date" class="form-control" aria-describedby="emailHelp" name="phoneno" value="<?php echo $user_data['birthdate'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Pincode</label>
                            <input type="number" class="form-control" aria-describedby="emailHelp" name="phoneno" value="<?php echo $user_data['pincode'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label" style="font-weight: 500;">Address</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="phoneno" value="<?php echo $user_data['address'] ?? ''; ?>" required>
                        </div>







                    </div>

                    <div class="col-lg-2 mb-lg-4 mb-2">
                        <button type="submit" class="btn text-white shadow-none custom-bg">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- profile pic and change password starts from here -->

    <div class="container mt-4">
        <div class="row align-items-end">

            <div class="col-lg-6 col-md-6 mb-5 px-4 mx-auto">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <form action="">
                        <h5 class="mb-3 fw-bold">Picture</h5>

                        <img src="images\IMG_15372.png" alt="" class="img-fluid mb-3">

                        <label class="input-group-text">New Image</label>

                        <input type="file" class="form-control mb-4" name="image" accept=".jpg,.png,.jpeg,.svg">



                        <button type="submit" class="btn text-white shadow-none custom-bg ">Save Changes</button>



                    </form>
                </div>
            </div>













        </div>
    </div>











    <?php require('inc/footer.php'); ?>

</body>

</html>