<?php
session_start();
require("connection.php");




if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `registered_users` WHERE `user_id` = $user_id";
$result = mysqli_query($con, $query);
$fetch_src = FETCH_SRC;

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the user's data
    $user_data = mysqli_fetch_assoc($result);
} else {
    // Handle error if user data not found
    $user_data = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store the fields that need to be updated
    $update_fields = array();

    // Check each input field to see if it has changed or not
    if (!empty($_POST['name']) && $_POST['name'] !== $user_data['name']) {
        $update_fields['name'] = $_POST['name'];
    }
    if (!empty($_POST['phoneno']) && $_POST['phoneno'] !== $user_data['phoneno']) {
        $update_fields['phoneno'] = $_POST['phoneno'];
    }
    if (!empty($_POST['birthdate']) && $_POST['birthdate'] !== $user_data['birthdate']) {
        $update_fields['birthdate'] = $_POST['birthdate'];
    }
    if (!empty($_POST['pincode']) && $_POST['pincode'] !== $user_data['pincode']) {
        $update_fields['pincode'] = $_POST['pincode'];
    }
    if (!empty($_POST['address']) && $_POST['address'] !== $user_data['address']) {
        $update_fields['address'] = $_POST['address'];
    }

    // Check if there are fields to update
    if (!empty($update_fields)) {
        // Generate the SQL update query
        $update_query = "UPDATE `registered_users` SET ";
        foreach ($update_fields as $key => $value) {
            $update_query .= "`$key` = '$value', ";
        }
        // Remove the trailing comma and space from the query
        $update_query = rtrim($update_query, ", ");
        // Add the WHERE condition
        $update_query .= " WHERE `user_id` = $user_id";

        // Execute the update query
        if (mysqli_query($con, $update_query)) {
            // Redirect to the profile page after successful update
            header("Location: profile.php");
            exit();
        } else {
            // Handle error if update fails
            echo "Error updating record: " . mysqli_error($con);
        }
    }
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
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="row align-items-end">

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input type="text" class="form-control " name="name" value="<?php echo $user_data['name'] ?? ''; ?>" required>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Phone Number</label>
                            <input type="number" class="form-control" name="phoneno" aria-describedby="emailHelp" name="phoneno" value="<?php echo $user_data['phoneno'] ?? ''; ?>" required>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <label class="form-label" style="font-weight: 500;">Date of Birth</label>
                            <input type="date" class="form-control" aria-describedby="emailHelp" name="birthdate" value="<?php echo $user_data['birthdate'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Pincode</label>
                            <input type="number" class="form-control" aria-describedby="emailHelp" name="pincode" value="<?php echo $user_data['pincode'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label" style="font-weight: 500;">Address</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" name="address" value="<?php echo $user_data['address'] ?? ''; ?>" required>
                        </div>







                    </div>

                    <div class="col-lg-2 mb-lg-4 mb-2">
                        <button type="submit" name="" class="btn text-white shadow-none custom-bg">Save Changes</button>
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

                        <div class="d-flex justify-content-center align-items-center mb-5" style="height: 150px;">
                            <img src="<?php echo $fetch_src . $user_data['image']; ?>" alt="User Image" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
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