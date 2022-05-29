<?php
class SignupService extends Dbh{

    protected function setUser($name,$pwd){
        $stmt = $this->connect()->prepare('INSERT INTO users (user_name, user_pwd) VALUES (?, ?);');

        $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($name,$hashedpwd))) {
            $stmt = null;
            header("location: ../registration.php?error=stmtfail");
            exit();
        }
        $stmt = null;
    }

    protected function checkUser($name){
        $stmt = $this->connect()->prepare('SELECT user_name FROM users WHERE user_name = ?;');
        if (!$stmt->execute(array($name))) {
            $stmt = null;
            header("location: ../registration.php?error=stmtfail");
            exit();
        }

        $resultCheck;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }else{
            $resultCheck = true;
        }
        return $resultCheck;
    }
}