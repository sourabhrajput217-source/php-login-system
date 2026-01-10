<?php
$username = "root";
$password = "";
$server = "localhost";
$database= "user1229";

$connection = mysqli_connect($server,$username,$password,$database);
if(!$connection){
    die("error" .mysqli_connect_error());
}


?>
