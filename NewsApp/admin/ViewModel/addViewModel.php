<?php
class addViewModel extends addService{
    private $title;
    private $author;
    private $intro;
    private $main;
    private $fileName;
    private $date;

    public function __construct($title,$author,$intro,$main,$fileName){
        $this->title=$title;
        $this->author =$author;
        $this->intro =$intro;
        $this->main =$main;
        $this->fileName =$fileName;
        $this->date = date("Y-m-d h:i:sa");
    }

    public function Add(){
        if ($this->emptyInput() == false) {
            header("location: ../add.php?error=emptyinput");
            exit();
        }
        if ($this->invalidData() == false) {
            header("location: ../add.php?error=invalidata");
            exit();
        }
        $this->addNews($this->title,$this->author,$this->intro,$this->main,$this->fileName,$this->date);
    }

    private function emptyInput(){
        $result;
        if (empty($this->title) || empty($this->author) || empty($this->intro) || empty($this->main)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidData(){
        $result;
        if (!preg_match("/^[a-z_ -]*$/i",$this->author)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
}