<?php
$username = "root";
$password = "";
$dsn = "mysql:host=127.0.0.1;dbname=webshop;charset=utf8";
$db = new PDO($dsn,$username,$password);

#$sqlbrand ="SELECT DISTINCT pbrand FROM products ORDER BY ID DESC";
#$resultbrand = $db->prepare($sqlbrand);
#$resultbrand->execute();
#$resbrand=$resultbrand->fetchAll();
#$sql ="SELECT ID,pname,pdetails,pprice,pimage,pquantity FROM products";
#$result = $db->query($sql);
#while($row = $result->fetch()):
#include 'templates/card.php'
#endwhile;
?>