<?php
if (isset($_POST["submit"])) {
    

    $name = $_POST["name"];
    $pwd = $_POST["pwd"];
    
    include "../model/dbh.php";
    include "../Model/loginService.php";
    include "../ViewModel/loginViewModel.php";
    $login = new loginViewModel($name,$pwd);

    $login->Login();
    
    header("location: ../index.php");
    exit();
}