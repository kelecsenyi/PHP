<?php
		include ('config.php');
		include ('configPDO.php');
		include ('functions.inc.php');
if (isset($_POST["regbutton"]))
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		$mobil = $_POST["mobil"];
		$password = $_POST["password"];
		$repassword = $_POST["repassword"];
		$postcode = $_POST["postcode"];
		$city = $_POST["city"];
		$address = $_POST["address"];
		$szamname = $_POST["szamname"];
		$szampostcode = $_POST["szampostcode"];
		$szamcity = $_POST["szamcity"];
		$szamaddress = $_POST["szamaddress"];
		$taxnumber = $_POST["taxnumber"];


		if (invalid($name,$postcode,$szamname,$szampostcode) == true) {
			header("location: registration.php?error=einvaliduid");
			exit();
		}
		if (pwdMatch($password,$repassword) !== false) {
			header("location: registration.php?error=pwddontmatch");
			exit();
		}
	
		createUser($conn,$name,$email,$mobil,$password,$postcode,$city,$address,$szamname,$szampostcode,$szamcity,$szamaddress,$taxnumber);
			
	}
	else
	{
		header("location: registration.php");
	}
?>