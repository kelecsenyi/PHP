<?php
if (isset($_POST["submit"])) {
    
    $title = $_POST["title"];
    $author = $_POST["author"];
    $intro = $_POST["intro"];
    $main = $_POST["main"];
    $file = $_FILES["file"];


    $fileName = $_FILES["file"]["name"];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpeg', 'png');

    include "../model/dbh.php";
    include "../Model/addService.php";
    include "../ViewModel/addViewModel.php";

    if (file_exists("../uploads/" . $fileName)) {
        header("location: ../add.php?error=filetaken");
        exit();
    }else{
        if (in_array($fileActualExt, $allowed)) {
            $add = new addViewModel($title,$author,$intro,$main,$fileName);
            $add->Add();
            move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/".$_FILES["file"]["name"]);
        }else{
            header("location: ../add.php?error=wrongtype");
            exit();
        }
    }
    
    header("location: ../add.php?success=success");
    exit();
}