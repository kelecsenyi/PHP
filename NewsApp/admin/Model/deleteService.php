<?php
if (isset($_POST["submit"])) {

    $id = $_POST["id"];
    $img = $_POST["img"];
    
    include "../model/dbh.php";
    $stmt = $db->prepare("DELETE FROM news WHERE news_id = '$id'");

    if (!$stmt->execute()) {
        $stmt = null;
        header("location: ../index.php?error=stmtfail");
        exit();
    }
    unlink("../uploads/".$img);
    $stmt = null;
    
    header("location: ../index.php?success=success");
    exit();
}