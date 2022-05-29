<?php
class modifyService extends Dbh{

    protected function editNews($id,$title,$author,$intro,$main,$img,$date){
        $stmt = $this->connect()->prepare("UPDATE news SET news_title=?, news_author=?, news_intro=?, news_text=?, news_img=?, news_date=? WHERE news_id=? ");

        if (!$stmt->execute(array($title,$author,$intro,$main,$img,$date,$id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfail");
            exit();
        }
        $stmt = null;
    }

    protected function check($img,$id){
        $stmt = $this->connect()->prepare('SELECT * FROM news WHERE news_img = ? AND news_id != ?;');
        if (!$stmt->execute(array($img,$id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfail");
            exit();
        }
        $resultCheck;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }else{
            $resultCheck = true;
        }

        $stmt = null;
        //$stmt = $this->connect()->prepare("SELECT news_img FROM news WHERE news_id = ? ;");
        //$stmt->execute(array($id));
        //$img= $stmt->fetch(PDO::FETCH_ASSOC);
        //if ($img["news_img"] != $img) {
        //    unlink("../uploads/".$img[0]['news_img']);
        //}
        //$stmt = null;

        return $resultCheck;
    }

}