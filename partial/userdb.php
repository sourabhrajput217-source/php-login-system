<?php

$connection = mysqli_connect("localhost", "root", "", "user1229");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
