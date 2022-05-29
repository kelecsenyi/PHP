<?php
if (isset($_POST["savebutton"]))
	{
		$pcode = $_POST["id"];
		$brand = $_POST["brands"];
		$name = $_POST["name"];
		$details = $_POST["details"];
		$price= $_POST["price"];
		$image = $_POST["image"];
		$quantity= $_POST["quantity"];

		include ('dbh.inc.php');
		include ('functions.inc.php');

		if (emptyInput($brand,$name,$details,$price,$image,$quantity,$pcode) !== false) {
			header("location: product.php?error=emptyinput");
			exit();
		}

		if (idTaken($conn,$pcode) !== false) {
			header("location: product.php?error=idtaken");
			exit();
		}
		if (imageTaken($conn,$image) !== false) {
			header("location: product.php?error=imagetaken");
			exit();
		}
	
		createProduct($conn,$brand,$name,$details,$price,$image,$quantity,$pcode);
			
	}
	else
	{
		header("location: product.php");
	}
?>