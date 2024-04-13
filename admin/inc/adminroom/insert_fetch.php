<?php

if (isset($_POST['addroom'])) {
    echo "<pre>";
    print_r($_FILES['video']);

    $video_name = $_FILES['video']['name'];
    $tmp_name = $_FILES['video']['tmp_name'];
    $error = $_FILES['video']['error'];


    if (($error == 0)) {
        $video_ex = pathinfo($video_name, PATHINFO_EXTENSION);


        $video_ex_lc = strtolower($video_ex);

        $allowed_exs = array('mp4', 'webm', 'avi', 'flv');

        if (in_array($video_ex_lc, $allowed_exs)) {

            $upload_dir = 'videos/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $new_video_name = uniqid("video-", true) . '.' . $video_ex_lc;
            $video_upload_path = $upload_dir . $new_video_name;
            move_uploaded_file($tmp_name, $video_upload_path);
            echo "video uploaded";

            //inserting the path into database 


        } else {
            $em = "you can't upload files of this type";
            header("Location:settings.php?error=$em");
        }
    }


    $facilities = $_POST['facilities'];
    $features = $_POST['features'];
    $facilities1 = implode(" | ", $facilities);
    $features1 = implode(" | ", $features);

    $imgpath = image_upload($_FILES['image']);

    // Escape user inputs to prevent SQL injection
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $area = mysqli_real_escape_string($con, $_POST['area']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $adult = mysqli_real_escape_string($con, $_POST['adult']);
    $children = mysqli_real_escape_string($con, $_POST['children']);
    $desc = mysqli_real_escape_string($con, $_POST['desc']);
    $status = mysqli_real_escape_string($con, $_POST['room_status']);

    // Construct the SQL query
    $add_query = "INSERT INTO `rooms`(`image`, `name`, `area`, `quantity`, `price`, `adult`, `children`, `features`, `facilities`, `Description`,`status`,`video`) VALUES ('$imgpath', '$name', '$area', '$quantity', '$price', '$adult', '$children', '$features1', '$facilities1', '$desc','$status','$new_video_name')";

    // Execute the query
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
            alert('Cannot run query');
            window.location.href='rooms.php';
            </script>
        ";
    }
}


if (isset($_POST['save_video'])) {
    // Check if the room ID is set
    if (isset($_POST['roomIdInput'])) {
        // Get the room ID
        $room_id = $_POST['roomIdInput'];
        

        // Debug statement to check the received room ID
        echo "Received Room ID: $room_id";

        $fetch_video_query = "SELECT video FROM rooms WHERE room_id = $room_id";
        $fetch_video_result = mysqli_query($con, $fetch_video_query);
        $row = mysqli_fetch_assoc($fetch_video_result);
        $existing_video_path = $row['video'];

        // Check if there is an existing video
        if (!empty($existing_video_path)) {
            // Delete the existing video file
            $existing_video_file = "videos/$existing_video_path";
            if (file_exists($existing_video_file)) {
                unlink($existing_video_file);
            }
        }

        

        // Check if a video file is uploaded
        if (isset($_FILES['video'])) {
            // Get the details of the uploaded video
            $video_name = $_FILES['video']['name'];
            $tmp_name = $_FILES['video']['tmp_name'];
            $error = $_FILES['video']['error'];

            // If there is no error in uploading the video
            if ($error == 0) {
                // Get the file extension
                $video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
                $video_ex_lc = strtolower($video_ex);

                // Define allowed video extensions
                $allowed_exs = array('mp4', 'webm', 'avi', 'flv');

                // Check if the uploaded video has an allowed extension
                if (in_array($video_ex_lc, $allowed_exs)) {
                    // Define the upload directory
                    $upload_dir = 'videos/';

                    // Create the upload directory if it doesn't exist
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    // Generate a unique name for the uploaded video
                    $new_video_name = uniqid("video-", true) . '.' . $video_ex_lc;

                    // Define the upload path
                    $video_upload_path = $upload_dir . $new_video_name;

                    // Move the uploaded video to the upload path
                    if (move_uploaded_file($tmp_name, $video_upload_path)) {
                        // Update the video path in the database
                        $video_query = "UPDATE rooms SET video='$new_video_name' WHERE room_id='$room_id'";

                        // Execute the update query
                        if (mysqli_query($con, $video_query)) {
                            // Video added successfully
                            echo "<script>alert('Video added successfully.'); window.location.href='rooms.php';</script>";
                        } else {
                            // Failed to update video path in the database
                            echo "<script>alert('Failed to update video path in the database.'); window.location.href='rooms.php';</script>";
                        }
                    } else {
                        // Failed to move the uploaded video to the upload path
                        echo "<script>alert('Failed to move the uploaded video.'); window.location.href='rooms.php';</script>";
                    }
                } else {
                    // Invalid video file type
                    echo "<script>alert('Invalid video file type.'); window.location.href='rooms.php';</script>";
                }
            } else {
                // Error in uploading the video
                echo "<script>alert('Error in uploading the video.'); window.location.href='rooms.php';</script>";
            }
        } else {
            // No video file uploaded
            echo "<script>alert('No video file uploaded.'); window.location.href='rooms.php';</script>";
        }
    } else {
        // Room ID not set
        echo "<script>alert('Room ID not set.'); window.location.href='rooms.php';</script>";
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
<thead class=" bg-dark text-light">
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
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody class="bg-white">
        <?php
        $query = "SELECT * FROM  `rooms` ";
        $result = mysqli_query($con, $query);
        $i = 1;
        $fetch_srcrad = FETCH_SRCrad;
        while ($fetch = mysqli_fetch_assoc($result)) {

            if ($fetch['status'] == 1) {
                $print_status = '<span style="color: green; font-weight: 600;">Available</span>';
            } elseif ($fetch['status'] == 2) {
                $print_status = '<span style="color: red;font-weight: 600;">All Booked</span>';
            } elseif ($fetch['status'] == 3) {
                $print_status = '<span style="color:rgb(147, 125, 2);font-weight: 600;">Under Maintenance</span>';
            }


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
<td><button onclick="confirm_rem($fetch[room_id])" class="btn btn-danger text-light "><i class="bi bi-trash3-fill  text-light"></i></button> 
 <a href="?edit=$fetch[room_id]" class="btn custom-bg mt-1 "><i class="bi bi-pencil-fill text-dark fw-5  "></i></a>  
 <a href="?video_edit_upload=$fetch[room_id]" class="btn custom-bg mt-1 "><i class="bi bi-camera-reels-fill text-dark fw-5  "></i></a>  
 
 </td>
<td class="text-center">$print_status</td> 






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