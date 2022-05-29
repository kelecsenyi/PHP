<?php
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $pwd = $_POST["pwd"];
    $pwdagain = $_POST["pwdagain"];

    include "../model/dbh.php";
    include "../Model/signupService.php";
    include "../ViewModel/signupViewModel.php";
    $signup = new SignupViewModel($name,$pwd,$pwdagain);

    $signup->signupUser();

    header("location: ../login.php");
    exit();
}