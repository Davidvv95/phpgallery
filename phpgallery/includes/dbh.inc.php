<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "travel_gallery";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
//Lets us know if there are any errors happening with the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
