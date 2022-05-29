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
    <link rel="stylesheet" href="css/log.css">
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
            <a class="nav-link " href="index.php">Főoldal</a>
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

          <?php if (isset($_GET["succes"])) {if ($_GET["succes"]=="succes")
          {echo'<div class="alert alert-success" role="alert">Sikeres regisztráció!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';}}?>

          <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
          {echo'<div class="alert alert-danger" role="alert">Töltsön ki minden mezőt!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';}}?>

          <?php if (isset($_GET["error"])) {if ($_GET["error"]=="nouser")
          {echo'<div class="alert alert-danger" role="alert">Nincs ilyen felhasználó!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';}}?>

          <?php if (isset($_GET["error"])) {if ($_GET["error"]=="wrongpassword")
          {echo'<div class="alert alert-danger" role="alert">Helytelen jelszó!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';}} ?>

    <div class="container mt-4">     
     <form action="login.inc.php" method="POST">
        <div class="row">
         <div class="col-sm-4 col-md-5 col-lg-6" id="bal">
          <h5>Belépés regisztrált felhasználóknak</h5>
          
            <label for="email"><b>Email</b></label>
            <input type="text" class="form-control" placeholder="Email" name="email" required>

            <label for="passwordlabel"><b>Jelszó</b></label>
            <input type="password" class="form-control" placeholder="Jelszó" name="password" required><br>

            <button type="submit" name="logbutton" class="btn btn-success">Belépés</button>
          </div>
          <div class="col-sm-4 col-md-5 col-lg-6">
            <h5>Regisztráció</h5>
            <p>Ha még nem regisztrált nálunk, érdemes regisztrálnia, mert így élvezheti áruházunk kényelmi szolgáltatásait, egyedi kedvezményeket kaphat, nyomon követheti rendeléseit.</p>
            <a class="btn btn-warning" href="registration.php">Regisztráció</a>
          </div>
        </div>
      </form>
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