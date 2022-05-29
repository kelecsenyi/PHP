<?php
class Dbh{

    public function connect(){
        try {
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=newsapp',$username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error: ".$e->getMessage()."<br/>";
            die();
        }
    }
}


//Only for display the items, and delete them
$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=newsapp";
$db = new PDO($dsn,$username,$password);


