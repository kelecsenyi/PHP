<?php
error_reporting(-1);
ini_set('display_errors','on');
session_start();
if (isset($_SESSION["id"])) {

  require 'config.php';

   $grand_total = 0;
    $allItems = '';
    $items = [];

    $allqty='';
    $qtys=[];

    $sql = "SELECT product_name,total_price,qty,product_code FROM cart WHERE userid = '".$_SESSION["id"]."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {

    $grand_total += $row['total_price'];
    $items[] = $row['product_name'];
    $qtys[] = $row['qty'];

    }
    $allItems = implode(', ', $items);
    $allqty = implode(', ', $qtys);

    if ($grand_total == 0) {
      header('location: vasarlas.php');
    }
}
else
{
  if (isset($_SESSION["currentuser"])) {
       require 'config.php';

        $grand_total = 0;
        $allItems = '';
        $items = [];
        $allqty='';
        $qtys=[];

        $sql = "SELECT product_name,total_price,qty FROM cart WHERE currentuser = '".$_SESSION["currentuser"]."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {

          $grand_total += $row['total_price'];
          $items[] = $row['product_name'];
          $qtys[] = $row['qty'];
        }
        $allItems = implode(', ', $items);
        $allqty = implode(', ', $qtys);
        
        if ($grand_total == 0) {
          header('location: vasarlas.php');
        }
    }
    else
    {
        header('location: vasarlas.php');
        exit();
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
    <link rel="stylesheet" href="css/checkoutstyle.css">
    <!-- jQuery first-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
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

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">

        <?php if (isset($_GET["error"])) {if ($_GET["error"]=="einvaliduid")
               {echo'<div class="alert alert-danger" role="alert">Elírt valamit!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

        <h4 class="text-center text-info p-2">Rendelés véglegesítése!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Termék(ek) : </b><?php echo $allItems; ?></h6>
          <h6 class="lead"><b>Szállítási költség : </b>Ingyenes</h6>
          <h5><b>Végösszeg : </b><?php echo $grand_total; ?> Ft</h5>
        </div>
        <form action="order.inc.php" method="POST" id="placeOrder">
          <?php
          if (isset($_SESSION["id"])) {

              require 'config.php';
              $sqluser = "SELECT * FROM user WHERE id = '".$_SESSION["id"]."'";
              $stmtu = $conn->prepare($sqluser);
              $stmtu->execute();
              $resultu = $stmtu->get_result();
              $output = '';
              while ($row = $resultu->fetch_assoc()) {
                $output .='

          <input type="hidden" name="products" value="'. $allItems.'">
          <input type="hidden" name="grand_total" value="'. $grand_total.'">
          <input type="hidden" name="qty" value="'.$allqty.'">
 
          <div class="form-group">
            <h5>Kapcsolattartó adatai</h5>
              <hr class="mb-3">
              <label for="name"><b>Név</b></label>
              <input class="form-control" placeholder="Név" type="text" name="name" value="'. $row['name'].'" required>

              <label for="email"><b>Email</b></label>
              <input class="form-control" placeholder="Email" type="email" name="email" value="'. $row['email'].'" required> 

              <label for="mobile"><b>Mobil</b></label>
              <input class="form-control" placeholder="Mobil" type="tel" name="phone" maxlength="15" value="'. $row['mobil'].'" required>
          </div>
          <div class="form-group">
            <h5>Szállítási adatok</h5>
              <hr class="mb-3">
              <label for="postcode"><b>Irányítószám</b></label>
              <input class="form-control" placeholder="Irányítószám" type="text" name="postcode" maxlength="4" value="'. $row['postcode'].'" required>

              <label for="city"><b>Város</b></label>
              <input class="form-control" placeholder="Város" type="text" name="city" value="'. $row['city'].'" required>

              <label for="address"><b>utca, házszám</b></label>
              <input class="form-control" placeholder="utca, házszám" type="text" name="address" value="'. $row['address'].'" required>
          </div>
          <div class="form-group">
            <h5>Számlázási adatok</h5>
                <hr class="mb-3">
                <label for="szamname"><b>Számlázási név</b></label>
                <input class="form-control" placeholder="Számlázási név" type="text" name="bname" value="'. $row['billname'].'" required>

                <label for="szampostcode"><b>Irányítószám</b></label>
                <input class="form-control" placeholder="Irányítószám" type="text" name="bpostcode" maxlength="4" value="'. $row['billpostcode'].'" required>

                <label for="city"><b>Város</b></label>
                <input class="form-control" placeholder="Város" type="text" name="bcity" value="'. $row['billcity'].'" required>

                <label for="address"><b>utca, házszám</b></label>
                <input class="form-control" placeholder="utca, házszám" type="text" name="baddress" value="'. $row['billaddress'].'" required>

                <label for="taxnumber"><b>Adószám</b></label>
                <input class="form-control" placeholder="Adószám" type="text" name="taxnumber" value="'. $row['taxcode'].'" required>
          </div>
          <h6 class="text-center lead">Fizetés mód</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Válassza ki hogyan fizet-</option>
              <option value="Utánvét">Utánvét</option>
              <option value="Online bankkártya">Online bankkártya</option>
              <option value="Bankkártya">Bankkártya</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Rendelés leadása!" class="btn btn-danger btn-block">
          </div> 
             ';
            }
            echo $output;
          }
          elseif (isset($_SESSION["currentuser"])) {
            echo('
          <input type="hidden" name="products" value="'. $allItems.'">
          <input type="hidden" name="grand_total" value="'. $grand_total.'">
          <input type="hidden" name="qty" value="'.$allqty.'">

          <div class="form-group">
            <h5>Kapcsolattartó adatai</h5>
              <hr class="mb-3">
              <label for="name"><b>Név</b></label>
              <input class="form-control" placeholder="Név" type="text" name="name" required>

              <label for="email"><b>Email</b></label>
              <input class="form-control" placeholder="Email" type="email" name="email" required> 

              <label for="mobile"><b>Mobil</b></label>
              <input class="form-control" placeholder="Mobil" type="tel" name="phone" maxlength="15" required>
          </div>
          <div class="form-group">
            <h5>Szállítási adatok</h5>
              <hr class="mb-3">
              <label for="postcode"><b>Irányítószám</b></label>
              <input class="form-control" placeholder="Irányítószám" type="text" name="postcode" maxlength="4" required>

              <label for="city"><b>Város</b></label>
              <input class="form-control" placeholder="Város" type="text" name="city"required>

              <label for="address"><b>utca, házszám</b></label>
              <input class="form-control" placeholder="utca, házszám" type="text" name="address" required>
          </div>
          <div class="form-group">
            <h5>Számlázási adatok</h5>
                <hr class="mb-3">
                <label for="szamname"><b>Számlázási név</b></label>
                <input class="form-control" placeholder="Számlázási név" type="text" name="bname" required>

                <label for="szampostcode"><b>Irányítószám</b></label>
                <input class="form-control" placeholder="Irányítószám" type="text" name="bpostcode" maxlength="4"required>

                <label for="city"><b>Város</b></label>
                <input class="form-control" placeholder="Város" type="text" name="bcity" required>

                <label for="address"><b>utca, házszám</b></label>
                <input class="form-control" placeholder="utca, házszám" type="text" name="baddress"  required>

                <label for="taxnumber"><b>Adószám</b></label>
                <input class="form-control" placeholder="Adószám" type="text" name="taxnumber" value="Nem vagyok jogi személy" required>
          </div>
          <h6 class="text-center lead">Fizetés mód</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Válassza ki hogyan fizet-</option>
              <option value="Utánvét">Utánvét</option>
              <option value="Online bankkártya">Online bankkártya</option>
              <option value="Bankkártya">Bankkártya</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="currentsubmit" value="Rendelés leadása!" class="btn btn-danger btn-block">
          </div>
              ');
          }
          ?>
        </form>
      </div>
    </div>
  </div>
  
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

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