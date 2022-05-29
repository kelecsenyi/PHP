<?php
if (isset($_POST["button"])) 
{
	$username = $_POST["username"];
	$password = $_POST["password"];

	include ('dbh.inc.php');
	include ('functions.inc.php');

	if (emptyInputLogin($username,$password) !== false) 
	{
		header("location:login.php?error=emptyinput");
		exit();
	}
	loginUser($conn,$username,$password);
}
else
{
	header("location:login.php");
	exit();
}
?>