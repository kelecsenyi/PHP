<?php 
error_reporting(-1);
ini_set('display_errors','on');
session_start();
if ($_SESSION["id"]) {
}
else
{
  header('location: belepes.php');
}
?>
<!DOCTYPE html>
<html lang="hu" dir="ltr">
  <head>
    <title>"Webarc.hu"</title>
    <meta charset="utf-8">
    <!--style-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" href="css/customersitestyle.css">
    <!-- jQuery first-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!--ikonok-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  </head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">WEBARC WEBÁRUHÁZ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Főoldal</a>
          </li>
          <li class="nav-item bg-secondary rounded"><a class="nav-link" href="customerdatas.php">
          <?php
          if (isset($_SESSION["id"])) {
             echo " Profilom";
           } 
          ?>
          </a></li>
          <li class="nav-item">
            <a class="nav-link" href="vasarlas.php">Vásárlás</a>
          </li>
          <li class="nav-item">        
            <a class="nav-link" href="cart.php">
              <i class="fas fa-shopping-basket"></i>Kosár <span id="cart-result"></span>
            </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="logout.inc.php">
          <?php
          if (isset($_SESSION["id"])) {
             echo " Kilépés";
           } 
          ?>
          </a></li>
      </ul>
    </div>
  </nav>
  
    <div class="container">
      <h2>Üdvözöljük <?php echo $_SESSION["name"];?></h2>
        <ul class="nav nav-pills">
          <li class="nav-item" style="margin-right: 10px;">
            <a class="nav-link" href="indexcustomer.php">Megrendeléseim</a>
          </li>
          <li class="nav-item" style="margin-right: 10px;">
            <a class="nav-link active" href="customerdatas.php">Adatok módosítása</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="customerpwd.php">Jelszó módosítása</a>
          </li>
        </ul><hr> 
      </div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-4 col-md-5 col-lg-8">
      <form action="customerdatas.inc.php" method="post">
        <div class="container">

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

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="einvaliduid")
               {echo'<div class="alert alert-danger" role="alert">Elírt valamit!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emailtaken")
               {echo'<div class="alert alert-danger" role="alert">Válasszon másik email címet, ez már foglalt!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

            <div id="result">
              
            </div>
        </div>
      </form>
    </div>
  </div> 
</div>
<script type="text/javascript">
  $(document).ready(function() {

  filter_cart();
  DataUpdate();
   function filter_cart()
    {
        var action = 'cart_item';
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function(data){
                $('#cart-result').html(data);
            }
        });
    }

    function DataUpdate()
    {
        var action = 'update';
        $.ajax({
            url:"fetch_user_data.php",
            method:"POST",
            data:{action:action},
            success:function(data){
                $('#result').html(data);
            }
        });
    }

});
</script>
</body>
</html>