<?php 
session_start();
if ($_SESSION['id']) {
}
else
{
  header("location: login.php");
}
include('dbh.inc.php');
include('../configPDO.php');
?>
<!DOCTYPE html>
<html lang="hu" dir="ltr">
  <head>
    <title>"Webarc.hu"</title>
    <meta charset="utf-8">
    <!--style-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <!--ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <!-- ikonok -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  </head>

<header>
  <nav class="navbar navbar-expand bg-dark navbar-dark">
    <a class="navbar-brand" href="index.php"> WEBARC WEBÁRUHÁZ</a>
  </nav>
</header>
<body>
  <div class="container">
    <h2>Adminisztrátori felület</h2>
    <ul class="nav nav-pills">
      <li class="nav-item" style="margin-right: 10px;">
        <a class="nav-link" href="index.php">Megrendelések</a>
      </li>
      <li class="nav-item dropdown" style="margin-right: 10px;">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#"> Raktár</a>
        <div class="dropdown-menu">
          <a class="dropdown-item " href="product.php">Termék hozzáadása</a>
          <a class="dropdown-item active" href="update.php">Termék módosítása</a>
      </li>
      <li class="nav-item" style="margin-right: 10px;">
        <a class="nav-link" href="users.php">Vásárlók</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="logout.inc.php">
      <?php
      if (isset($_SESSION["id"])) {
         echo " Kilépés";
       } 
      ?>
      </a></li>
    </ul><hr>  
  </div>
  <div class="container">
    <form method="POST" action="update.inc.php">
          <div class="row-lg-6">
           <div class="col py-2">

              <?php if (isset($_GET["succes"])) {if ($_GET["succes"]=="succesupdate")
              {echo'<div class="alert alert-success" role="alert">Sikeres művelet!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="fail")
              {echo'<div class="alert alert-danger" role="alert">Sikertelen művelet!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
               {echo'<div class="alert alert-danger" role="alert">Töltsön ki minden mezőt!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) { if ($_GET["error"]=="imagetaken") 
              {echo'<div class="alert alert-danger" role="alert">Már van ilyen nevü kép!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <h5>Termék törlése</h5>
              <hr class="mb-3">
              <label for="iddel"><b>Válassza ki a terméket</b></label>

                <?php
                $query = "SELECT pcode FROM products ORDER BY pcode";
                $statement = $db->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                ?>
                <select name="iddel" id="iddel" class="custom-select">
                <option selected="0" value="0">Válasszon...</option>
                <?php foreach($result as $row):?>
                <option value="<?= $row["pcode"]; ?>"><?= $row["pcode"]; ?></option>
                <?php endforeach; ?>
                </select>
                <button type="save" name="deletebutton" class="btn btn-danger mt-2">Törlés</button>

              <h5 class="mt-2">Meglévő termék módosítása</h5>
              <hr class="mb-3">

              <label for="id"><b>Keresse ki az adott terméket</b></label>
              <input type="text" name="search_text" id="search_text" maxlength="10" class="form-control" placeholder="pl: 001">

                <div id="result">
                  
                </div>
              <br> 
              
            </div>
          </div>
    </form>
  </div>

<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch_data.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
</body>
</html>