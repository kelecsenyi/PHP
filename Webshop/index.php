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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/indexstyle.css">
    <!-- jQuery-->
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
            <a class="nav-link bg-secondary rounded" href="index.php">Főoldal</a>
          </li>
          <?php
          if (isset($_SESSION["id"])) 
          {
             echo '<li class="nav-item"><a class="nav-link" href="indexcustomer.php"> Profilom</a></li>';
           }
           else
           {
            echo'<li class="nav-item"><a class="nav-link" href="belepes.php"> Belépés</a></li>';
           }
          ?>          
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

  <section class="container" id="home">
    <div class="row text-center">
      <div class="col-sm-6 col-md-8 col-lg-12">
        <p  id="üdvözlés">
           Üdvözöljük!
        </p>
        <p>
          Weboldalunk maszkok és teljesálarcok kereskedésével foglalkozik.
          Ha már regisztrált nálunk vagy regisztrálni szeretne, akkor nyomjon a Belépek! gombra. Amennyiben regisztrálás nélkül szeretne rendelni, akkor egyszerűen nyomjon a Vásárolok! gombra.
        </p>
        <a href="vasarlas.php" class="btn btn-success">Vásárólok!</a>
        <a href="belepes.php" class="btn btn-primary">Belépek!</a>
      </div>
    </div>
  </section>
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
