<?php
class addService extends Dbh{

    protected function addNews($title,$author,$intro,$main,$fileName,$date){
        $stmt = $this->connect()->prepare('INSERT INTO news (news_title, news_author, news_intro, news_text, news_img, news_date) VALUES (?, ?, ?, ?, ?, ?);');

        if (!$stmt->execute(array($title,$author,$intro,$main,$fileName,$date))) {
            $stmt = null;
            header("location: ../add.php?error=stmtfail");
            exit();
        }
        $stmt = null;
    }

}