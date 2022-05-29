<?php
	$conn = mysqli_connect("localhost","root","","webshop") or die ("Nincs adatbázis ".mysqli_connect_error());
	mysqli_query($conn,"SET CHARACTER SET 'utf8'");
	mysqli_query($conn,"SET COLLATION_CONNECTION='utf8_general_ci'");
	mysqli_query($conn,"SET character_set_results = 'utf8'");
	mysqli_query($conn,"SET character_set_server = 'utf8'");
	mysqli_query($conn,"SET character_set_client = 'utf8'");
	if (!$conn) die ("Nem lehet kapcsolódni");
?>
