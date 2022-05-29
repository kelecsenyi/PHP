<?php
class loginService extends Dbh{

    protected function loginUser($name,$pwd){
        $stmt = $this->connect()->prepare('SELECT user_pwd FROM users WHERE user_name = ?;');

        if (!$stmt->execute(array($name))) {
            $stmt = null;
            header("location: ../login.php?error=stmtfail");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../login.php?error=nouser");
            exit();
        }

        $pwdhashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkpwd = password_verify($pwd, $pwdhashed[0]["user_pwd"]);

        if ($checkpwd == false) {
            $stmt=null;
            header("location: ../login.php?error=wrongpwd");
            exit();
        }
        elseif($checkpwd == true){
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_name = ?;');
            if(!$stmt->execute(array($name))){
                $stmt = null;
                header("location: ../login.php?error=stmtfail");
                exit();
            }
        
            if ($stmt->rowCount()==0) {
                $stmt = null;
                header("location: ../login.php?error=nouser");
                exit();
            }

            $user= $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["userid"]= $user[0]["user_id"];
        }

        $stmt = null;
    }

    protected function checkUser($name){
        $stmt = $this->connect()->prepare('SELECT user_name FROM users WHERE user_name = ?;');
        if (!$stmt->execute(array($name))) {
            $stmt = null;
            header("location: ../login.php?error=stmtfail");
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