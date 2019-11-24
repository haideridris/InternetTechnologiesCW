<?php

$servername = "localhost";
$dBUsername = ""; //before submitting change to LAMP credentials
$dBPassword = "";     //before submitting change to LAMP credentials
$dBName = "hraoof";

//Establishes connection to database
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//Error message if connection is not established to the database
if (!$conn) {
	die("Connection failed: ".mysql_connect_error());
}

?>