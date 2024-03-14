<?php

$con = mysqli_connect("localhost", "root", "", "testing");
if (mysqli_connect_error()) {
    echo "<script>alert('Cannot Connect To The Database'); </script>";
    exit();
}
define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/hello/uploads/");
define("UPLOAD_SRC1", $_SERVER['DOCUMENT_ROOT'] . "/hello/rooms/");

define("FETCH_SRC", "http://127.0.0.1/hello/uploads/");
define("FETCH_SRCrad", "http://127.0.0.1/hello/rooms/");
