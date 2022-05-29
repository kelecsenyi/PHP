<?php
error_reporting(-1);
ini_set('display_errors','on');
session_start();
if (isset($_SESSION["id"])) {

   }
   else
   {
    if (isset($_SESSION["currentuser"])) {
      
    }
    else
    {
      $currentuser= rand(1,999);
      $_SESSION["currentuser"] = $currentuser;
    }
   }
?>

<!DOCTYPE html>
<html lang="hu" dir="ltr">
  <head>
    <title>"Webarc.hu"</title>
    <meta charset="utf-8">
    <!--style-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/regstyle.css">
    <!-- jQuery first
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!--JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <!-- ikonok -->
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
          <li class="nav-item">
            <a class="nav-link bg-secondary rounded" href="belepes.php">Belépés</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vasarlas.php">Vásárlás</a>
          </li>
          <li class="nav-item">        
            <a class="nav-link" href="cart.php">
              <i class="fas fa-shopping-basket"></i>Kosár <span id="cart-result"></span>
            </a>
          </li>
      </ul>
    </div>
  </nav>

 <div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-4 col-md-5 col-lg-8">

      <form action="registration.inc.php" method="POST">
        <div class="container">
          <h1>Regisztráció új vásárlóknak</h1>
            <div class="form-group">
              <h5>Kapcsolattartó</h5>
              <hr class="mb-3">

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="pwddontmatch")
              {echo'<div class="alert alert-danger" role="alert">A jelszavak nem egyeznek!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
               {echo'<div class="alert alert-danger" role="alert">Töltsön ki minden mezőt!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) { if ($_GET["error"]=="einvaliduid") 
              {echo'<div class="alert alert-danger" role="alert">Nézzen át minden, valahol elírt valamit!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) { if ($_GET["error"]=="stmtfailed2") 
              {echo'<div class="alert alert-danger" role="alert">Sikertelen regisztráció!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) { if ($_GET["error"]=="emailtaken") 
              {echo'<div class="alert alert-danger" role="alert">Válasszon másik email címet, ez már foglalt!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <label for="name"><b>Név</b></label>
              <input class="form-control" placeholder="Név" type="text" name="name" required>

              <label for="email"><b>Email</b></label>
              <input class="form-control" placeholder="Email" type="email" name="email" required> 

              <label for="mobile"><b>Mobil</b></label>
              <input class="form-control" placeholder="Mobil" type="tel" maxlength="15" name="mobil" required>

              <label for="passwordlabel"><b>Jelszó</b></label>
              <input class="form-control" placeholder="Jelszó" type="text" name="password" required> 

              <label for="passwordagain"><b>Jelszó újra</b></label>
              <input class="form-control" placeholder="Jelszó újra" type="text" name="repassword" required>
            </div>

            <div class="form-group">
              <h5>Szállítási adatok</h5>
              <hr class="mb-3">

              <label for="postcode"><b>Irányítószám</b></label>
              <input class="form-control" placeholder="Irányítószám" type="text" maxlength="4" name="postcode">

              <label for="city"><b>Város</b></label>
              <input class="form-control" placeholder="Város" type="text" name="city" required>

              <label for="address"><b>utca, házszám</b></label>
              <input class="form-control" placeholder="utca, házszám" type="text" name="address" required>
            </div>
            
            <div class="form-group">
                <h5>Számlázási adatok</h5>
                <hr class="mb-3">
                <label for="szamname"><b>Számlázási név</b></label>
                <input class="form-control" placeholder="Számlázási név" type="text" name="szamname" required>

                <label for="szampostcode"><b>Irányítószám</b></label>
                <input class="form-control" placeholder="Irányítószám" type="text" maxlength="4" name="szampostcode" required>

                <label for="city"><b>Város</b></label>
                <input class="form-control" placeholder="Város" type="text" name="szamcity" required>

                <label for="address"><b>utca, házszám</b></label>
                <input class="form-control" placeholder="utca, házszám" type="text" name="szamaddress" required>

                <label for="taxnum"><b>Adószám</b></label><br>
                <input class="form-control" placeholder="Adószám" value="Nem vagyok jogi személy" type="text" name="taxnumber">

                <hr class="mb-3">
                <button type="submit" name="regbutton" class="btn btn-primary">Regisztráció</button>
                <a href="belepes.php" class="btn btn-success">Mégse</a>
            </div>
            <br>
        </div>
      </form>

    </div>
  </div> 
</div>
<script type="text/javascript">
      $(document).ready(function() {

        filter_cart();
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
      });
</script>
</body>
</html>