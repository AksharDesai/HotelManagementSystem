<?php


session_start();


// it is the function of uploading an image vv
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>

    <?php require('C:\xampp\htdocs\hello\inc\links.php'); ?>
    <link rel="stylesheet" href="admin\css\common.css">

    <style>

        .flex-heading{
            display: flex;
            justify-content: space-between;
            align-items: center;

        }
      

    </style>

</head>

<body class="bg-light ">


    <?php require("inc\header.php"); ?>
    <?php require('inc\connection.php'); ?>

    <div class="container-fluid bg-secondary" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 flex-heading">


               

                <!-- add room modal starts form here -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addroom">
                    Add Room
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addroom" tabindex="-1" role="dialog" aria-labelledby="addroomTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title bg-dark text-light p-2 w-100 text-center" id="addroomTitle">Fill Room Details</h5>

                            </div>
                            <div class="modal-body">

                                <form action="rooms.php" method="post" enctype="multipart/form-data">

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Name</label>
                                            <input type="text" name="name" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Area</label>
                                            <input type="number" name="area" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Price</label>
                                            <input type="number" name="price" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Quantity</label>
                                            <input type="number" name="quantity" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Adult</label>
                                            <input type="number" name="adult" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Children</label>
                                            <input type="number" name="children" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-md-12 ps-0">
                                            <label class="input-group-text">Picture</label>
                                            <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.svg">
                                        </div>
                                        <div class="mb-3 col-12">

                                            <label class="form-label fw-bold">Features</label>


                                            <div class="row">
                                                <div class="col-md-3 mb-1">
                                                    <label class="form-label">bathroom</label>
                                                    <input type="checkbox" name="features[]" class="form-check-input shadow-none" value="bathroom">


                                                </div>
                                                <div class="col-md-3 mb-1">
                                                    <label class="form-label">bedroom</label>
                                                    <input type="checkbox" name="features[]" class="form-check-input shadow-none" value="bedroom">


                                                </div>
                                                <div class="col-md-3 mb-1">
                                                    <label class="form-label">balcony</label>
                                                    <input type="checkbox" name="features[]" class="form-check-input shadow-none" value="balcony">


                                                </div>



                                            </div>
                                        </div>
                                        <div class="mb-3 col-12">

                                            <label class="form-label fw-bold">Facilities</label>
                                            <div class="row">
                                                <div class="col-md-3 mb-1">
                                                    <label>Wifi</label>
                                                    <input type="checkbox" name="facilities[]" value="wifi" class="form-check-input shadow-none">


                                                </div>
                                                <div class="col-md-3">
                                                    <label>AC</label>
                                                    <input type="checkbox" name="facilities[]" value="ac" class="form-check-input shadow-none">


                                                </div>
                                                <div class="col-md-3">
                                                    <label> Room Heater</label>
                                                    <input type="checkbox" name="facilities[]" value="room heater" class="form-check-input shadow-none">


                                                </div>
                                                <div class="col-md-3">
                                                    <label>Television</label>
                                                    <input type="checkbox" name="facilities[]" value="television" class="form-check-input shadow-none">


                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label>Spa</label>
                                                    <input type="checkbox" name="facilities[]" value="spa" class="form-check-input shadow-none">


                                                </div>
                                                <div class="col-12 ">
                                                    <label class="form-label fw-bold">Description</label>
                                                    <textarea name="desc" rows="4" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark text-light" data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-success my-1" name="addroom">Add Room</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <!--  above add  room modal ends here  -->

                <!-- the insertion of the data from the above modal into rooms table code begins from here -->

                <?php

                if (isset($_POST['addroom'])) {


                    $facilities = $_POST['facilities'];
                    $features = $_POST['features'];
                    $facilities1 = implode(",", $facilities);
                    $features1 = implode(",", $features);



                    $imgpath = image_upload($_FILES['image']);



                    $add_query = "INSERT INTO `rooms`(`image`,`name`, `price`, `adult`, `children`, `features`, `facilities`, `Description`) VALUES ('$imgpath','$_POST[name]','$_POST[price]','$_POST[adult]','$_POST[children]','$features1','$facilities1','$_POST[desc]')";
                    if (mysqli_query($con, $add_query)) {

                        echo "
                    <script>
                    alert('Room Added ');
                    window.location.href='rooms.php';
                    </script>
                    ";
                    } else {
                        echo "
                    <script>
                    alert('cannot run query');
                    window.location.href='rooms.php';
                    </script>
                    ";
                    }
                }



                ?>





            </div>
        </div>
    </div>
    <div class="container-fluid  " id=" main-content" ">
        <div class=" row " >

        <div class=" col-lg-10 ms-auto p-0 ">
            <table class=" table table-hover text-center ">
                <thead class=" bg-success text-light">
        <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Adult</th>
            <th scope="col">Children</th>
            <th scope="col">Features</th>
            <th scope="col">Facilities</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white">
            <?php
            $query = "SELECT * FROM  `rooms` ";
            $result = mysqli_query($con, $query);
            $i = 1;
            $fetch_srcrad = FETCH_SRCrad;
            while ($fetch = mysqli_fetch_assoc($result)) {

                // $isBanned = $fetch['ban'];

                // // Initialize the variable to store the button HTML
                // $buttonHTML = '';

                // if ($isBanned) {
                //     // If the user is banned, store HTML for the "Unban" button
                //     $buttonHTML = '<button onclick="confirm_rem2(' . $fetch['user_id'] . ', false)" class="btn btn-warning"><i class="bi bi-arrow-clockwise"></i> Unban</button>';
                // } else {
                //     // If the user is not banned, store HTML for the "Ban" button
                //     $buttonHTML = '<button onclick="confirm_rem(' . $fetch['user_id'] . ', true)" class="btn btn-danger"><i class="bi bi-exclamation-triangle-fill"></i> Ban</button>';
                // }


                echo <<<product
                        
                        
                        <tr>
                        <th scope="row">$i</th>
                        <td><img src="$fetch_srcrad$fetch[image] " width="150px" height="100px" "></td>
                        <td>$fetch[name]</td>
                        <td>$fetch[price]</td>
                        <td>$fetch[adult]</td>
                        <td>$fetch[children]</td>
                        <td>$fetch[features]</td>
                        <td>$fetch[facilities]</td>

                        <td>$fetch[Description]</td> 
                        <td><button onclick="confirm_rem($fetch[room_id])" class="btn btn-danger "><i class="bi bi-eye ">Delete</i></button></td>
                         
                        
                        
                    
                        
                        </tr>
                        
            
                        product;
                $i++;
            }


            ?>

            <?php
            
            ?>

            <?php

            if (isset($_GET['rem']) && $_GET['rem'] > 0) {
                $query = "SELECT * FROM `rooms` WHERE `room_id`='$_GET[rem]'";
                $result = mysqli_query($con, $query);
                $fetch = mysqli_fetch_assoc($result);

                $query = "DELETE  FROM `rooms` WHERE `room_id`='$_GET[rem]'";
                if (mysqli_query($con, $query)) {
                    echo <<<alert

        <div class="alert alert-warning alert-dismissible fade show" role="alert"">
        <strong class="me-3">Done</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

     
        alert;
                } else {
                    echo <<<alert2

        <div class="alert alert-warning alert-dismissible fade show" role="alert"">
        <strong class="me-3">Sorry</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

     
        alert2;
                }
            }

            ?>
            


        </tbody>
        </table>
    </div>
    </div>
    </div>





    <?php require('C:\xampp\htdocs\hello\inc\scripts.php'); ?>
    <script>
        function confirm_rem(room_id) {
            if (confirm("Are you sure,Delete?")) {
                window.location.href = "rooms.php?rem=" + room_id;
            }

        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>