<?php
if (isset($_POST["submit"])) {
    
    $id = $_POST["id"];
    include "../model/dbh.php";

    foreach($_FILES['image']['name'] as $key => $value) {
        $fileName = $_FILES["image"]["name"][$key];
        $fileTempName = $_FILES["image"]["tmp_name"][$key];
        $path = "../gallery/".$fileName;
        
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpeg', 'png');
        if (in_array($fileActualExt, $allowed)) {
            move_uploaded_file($fileTempName, $path);

            $stmt = $db->prepare('INSERT INTO gallery (img_newsid, img_img) VALUES (?, ?);');
            if (!$stmt->execute(array($id, $fileName))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfail");
                exit();
            }
            $stmt = null;

        }else{
            header("location: ../index.php?error=wrongtype");
            exit();
        }
    }

    header("location: ../index.php?success=success");
    exit();
}

if (isset($_POST["delete"])) {
    
    $id = $_POST["id"];
    $img = $_POST["img"];
    
    include "../model/dbh.php";
    $stmt = $db->prepare("DELETE FROM gallery WHERE img_id = '$id'");

    if (!$stmt->execute()) {
        $stmt = null;
        header("location: ../index.php?error=stmtfail");
        exit();
    }
    $stmt = null;
    
    header("location: ../index.php?success=success");
    exit();

}