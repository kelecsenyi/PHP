<?php
require('config.php');
include ('functions.inc.php');
if (isset($_POST["logbutton"])) 
{
	$email = $_POST["email"];
	$password = $_POST["password"];

	loginUser($conn,$email,$password);
}
else
{
	header("location:belepes.php");
	exit();
}
?>