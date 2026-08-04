<?php

$conn = mysqli_connect("localhost", "root", "", "pawcketful_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$servername = "localhost";
$username = "root";
$password = "";
$database = "pawcketful_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
