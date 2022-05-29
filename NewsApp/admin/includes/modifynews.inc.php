<?php
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $intro = $_POST["intro"];
    $main = $_POST["main"];
    $file = $_FILES["file"];
    $original = $_POST["ifimgempty"];

    $fileName = $_FILES["file"]["name"];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpeg', 'png');

    include "../model/dbh.php";
    include "../Model/modifyService.php";
    include "../ViewModel/modifyViewModel.php";

        if (in_array($fileActualExt, $allowed) || $fileName == '') {
            if ($fileName == '' || $fileName == null) {
                $fileName = $original;
            }
            $add = new modifyViewModel($id,$title,$author,$intro,$main,$fileName);
            $add->Edit();
            move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/".$_FILES["file"]["name"]);       
        }else{
            header("location: ../index.php?error=wrongtype");
            exit();
        }
    
    
    header("location: ../index.php?success=success");
    exit();
}