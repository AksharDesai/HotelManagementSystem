<?php

if (isset($_POST['addroom'])) {



    $facilities = $_POST['facilities'];
    $features = $_POST['features'];
    $facilities1 = implode(" | ", $facilities);
    $features1 = implode(" | ", $features);

    $imgpath = image_upload($_FILES['image']);



    // $add_query = "INSERT INTO `rooms`(`image`,`name`, `price`, `adult`, `children`, `features`, `facilities`, `Description`) VALUES ('$imgpath','$_POST[name]','$_POST[price]','$_POST[adult]','$_POST[children]','$features1','$facilities1','$_POST[desc]')";
    $add_query = "INSERT INTO `rooms`(`image`, `name`, `area`, `quantity`, `price`, `adult`, `children`, `features`, `facilities`, `Description`) VALUES ('$imgpath','$_POST[name]','$_POST[area]','$_POST[quantity]','$_POST[price]','$_POST[adult]','$_POST[children]','$features1','$facilities1','$_POST[desc]')";
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
    </tr>
    </thead>
    <tbody class="bg-white">
        <?php
        $query = "SELECT * FROM  `rooms` ";
        $result = mysqli_query($con, $query);
        $i = 1;
        $fetch_srcrad = FETCH_SRCrad;
        while ($fetch = mysqli_fetch_assoc($result)) {




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
<td><button onclick="confirm_rem($fetch[room_id])" class="btn btn-danger text-light "><i class="bi bi-trash3-fill  text-light"></i></button>  <a href="?edit=$fetch[room_id]" class="btn btn-success mt-1 "><i class="bi bi-bookmark-plus-fill text-dark fw-5  "></i></a></td>






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