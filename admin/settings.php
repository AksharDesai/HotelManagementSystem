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


                <h3 class="mb-4">Settings</h3>


                <!-- general settings starts here -->


                <!-- general settings ends here -->

                <!-- Shutdown Section Starts From Here -->
                <div class="card shadow-lg ">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 ">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form action="s1.php" method="post">

                                    <input class="form-check-input " type="checkbox" id="shutdown-toggle">
                                    
                                </form>
                            </div>
                        </div>
                        <p>No Customers will be allowed to book hotel room , when Shutdown mode is ON</p>

                    </div>
                </div>








            </div>
        </div>
    </div>





    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>
</body>

</html>