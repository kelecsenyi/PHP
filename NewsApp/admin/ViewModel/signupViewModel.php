<?php
class SignupViewModel extends SignupService{
    private $name;
    private $pwd;
    private $pwdagain;

    public function __construct($name, $pwd, $pwdagain){
        $this->name=$name;
        $this->pwd =$pwd;
        $this->pwdagain= $pwdagain;
    }

    public function signupUser(){
        if ($this->emptyInput() == false) {
            header("location: ../registration.php?error=emptyinput");
            exit();
        }
        if ($this->invalidName() == false) {
            header("location: ../registration.php?error=invalidname");
            exit();
        }
        if ($this->pwdMatch() == false) {
            header("location: ../registration.php?error=pwderror");
            exit();
        }
        if ($this->nameTaken() == false) {
            header("location: ../registration.php?error=nametaken");
            exit();
        }
        $this->setUser($this->name,$this->pwd);
    }

    private function emptyInput(){
        $result;
        if (empty($this->name) || empty($this->pwd) || empty($this->pwdagain)) {
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

    private function pwdMatch(){
        $result;
        if ($this->pwd !== $this->pwdagain) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function nameTaken(){
        $result;
        if (!$this->checkUser($this->name)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

}