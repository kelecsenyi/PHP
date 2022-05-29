<?php
include ('config.php');
include ('configPDO.php');
include ('functions.inc.php');


if (isset($_POST["savebutton"])) 
{
	$name = $_POST["name"];
	$email = $_POST["email"];
	$mobil = $_POST["mobil"];
	$postcode = $_POST["postcode"];
	$city = $_POST["city"];
	$address = $_POST["address"];
	$szamname = $_POST["szamname"];
	$szampostcode = $_POST["szampostcode"];
	$szamcity = $_POST["szamcity"];
	$szamaddress = $_POST["szamaddress"];
	$taxnumber = $_POST["taxnumber"];
	session_start();
	$id = $_SESSION["id"];
	
	if (invalid($name,$postcode,$szamname,$szampostcode) !== false) {
			header("location: customerdatas.php?error=einvaliduid");
			exit();
		}
		
	if (emailExist($conn,$email,$id) !== false) {
			header("location: customerdatas.php?error=emailtaken");
			exit();
		}

	updateDatas($conn,$name,$email,$mobil,$postcode,$city,$address,$szamname,$szampostcode,$szamcity,$szamaddress,$taxnumber,$id);
}
else
{
	header("location:  customerdatas.php");
	exit();
}
?>