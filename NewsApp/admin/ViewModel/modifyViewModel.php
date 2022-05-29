<?php
class modifyViewModel extends modifyService{
    private $id;
    private $title;
    private $author;
    private $intro;
    private $main;
    private $fileName;
    private $date;

    public function __construct($id,$title,$author,$intro,$main,$fileName){
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->intro = $intro;
        $this->main = $main;
        $this->fileName = $fileName;
        $this->date = date("Y-m-d h:i:sa");
    }

    public function Edit(){
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->invalidData() == false) {
            header("location: ../index.php?error=invaliddata");
            exit();
        }
        if ($this->findImg() == false) {
            header("location: ../index.php?error=imgtaken");
            exit();
        }
        $this->editNews($this->id,$this->title,$this->author,$this->intro,$this->main,$this->fileName,$this->date);
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

    private function findImg(){
        $result;
        if ($this->check($this->fileName,$this->id)) {
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }
}