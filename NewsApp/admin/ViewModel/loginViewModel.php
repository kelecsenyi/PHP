<?php
class loginViewModel extends loginService{
    private $name;
    private $pwd;

    public function __construct($name, $pwd){
        $this->name=$name;
        $this->pwd =$pwd;
    }

    public function Login(){
        if ($this->emptyInput() == false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }
        if ($this->invalidName() == false) {
            header("location: ../login.php?error=invalidname");
            exit();
        }
        if ($this->findUser() == false) {
            header("location: ../login.php?error=nouser");
            exit();
        }
        $this->loginUser($this->name,$this->pwd);
    }

    private function emptyInput(){
        $result;
        if (empty($this->name) || empty($this->pwd)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidName(){
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/",$this->name)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function findUser(){
        $result;
        if ($this->checkUser($this->name)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
}