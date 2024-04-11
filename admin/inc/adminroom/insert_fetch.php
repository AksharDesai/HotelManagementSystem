<?php

if (isset($_POST['addroom'])) {

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
    $add_query = "INSERT INTO `rooms`(`image`, `name`, `area`, `quantity`, `price`, `adult`, `children`, `features`, `facilities`, `Description`,`status`) VALUES ('$imgpath', '$name', '$area', '$quantity', '$price', '$adult', '$children', '$features1', '$facilities1', '$desc','$status')";

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
<td><button onclick="confirm_rem($fetch[room_id])" class="btn btn-danger text-light "><i class="bi bi-trash3-fill  text-light"></i></button>  <a href="?edit=$fetch[room_id]" class="btn custom-bg mt-1 "><i class="bi bi-bookmark-plus-fill text-dark fw-5  "></i></a></td>
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