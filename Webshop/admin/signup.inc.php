<?php
if (isset($_POST["button"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$passwordagain = $_POST["passwordagain"];

		include ('dbh.inc.php');
		include ('functions.inc.php');

		if (emptyInputSignup($username,$password,$passwordagain) !== false) {
			header("location: signup.php?error=emptyinput");
			exit();
		}
		if (invalidUid($username) !== false) {
			header("location: signup.php?error=einvaliduid");
			exit();
		}
		if (pwdMatch($password,$passwordagain) !== false) {
			header("location: signup.php?error=pwddontmatch");
			exit();
		}

		if (userNameTaken($conn,$username) !== false) {
			header("location: signup.php?error=usertaken");
			exit();
		}
	
		createUser($conn,$username,$password);
			
	}
	else
	{
		header("location: signup.php");
	}
?>