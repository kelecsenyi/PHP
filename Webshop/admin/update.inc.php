<?php
include ('dbh.inc.php');
include ('functions.inc.php');
if (isset($_POST["updatebutton"]))
	{
		$pcode = $_POST["search_text"];
		$brand = $_POST["brands"];
		$name = $_POST["name"];
		$details = $_POST["details"];
		$price= $_POST["price"];
		$image = $_POST["image"];
		$quantity= $_POST["quantity"];

		if (emptyInput($brand,$name,$details,$price,$image,$quantity,$pcode) !== false) {
			header("location: update.php?error=emptyinput");
			exit();
		}
		if (upimageTaken($conn,$image,$pcode) !== false) {
			header("location: update.php?error=imagetaken");
			exit();
		}
	
	updateProduct($conn,$brand,$name,$details,$price,$image,$quantity,$pcode);			
	}
	else
	{
		header("location: update.php");
	}

if (isset($_POST["deletebutton"]))
	{
		$pcode = $_POST["iddel"];
	
	deleteProduct($conn,$pcode);	
			
	}
	else
	{
		header("location: update.php");
	}
?>