<?php
error_reporting(-1);
ini_set('display_errors','on');
require 'config.php';
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
    <link rel="stylesheet" href="css/cartstyle.css">
    <!-- jQuery first-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
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
            <a class="nav-link bg-secondary rounded" href="cart.php">
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
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
          echo $_SESSION['showAlert'];
        } else {
          echo 'none';
        } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong><?php if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        } unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Kosár tartalma:</h4>
                </td>
              </tr>
              <tr>
                <th>Termékkód</th>
                <th>Kép</th>
                <th>Megnevezés</th>
                <th>Ár</th>
                <th>Mennyiség</th>
                <th>Teljes ár</th>
                <th>
                  <?php
                  if (isset($_SESSION["id"])) {
                   $userid= $_SESSION['id'];
                   $output = ' <a href="action.php?clear=all&userid='. $_SESSION['id'].'" class="badge-danger badge p-1" onclick="return confirm(Biztosan törlöd a kosarad?);"><i class="fas fa-trash"></i>&nbsp;&nbsp;Kosár törlése</a> '; 
                    echo $output;
                  }
                  else
                  {
                    $currentuser= $_SESSION['currentuser'];
                    $output = ' <a href="action.php?clear=all&userid='. $_SESSION['currentuser'].'" class="badge-danger badge p-1" onclick="return confirm(Biztosan törlöd a kosarad?);"><i class="fas fa-trash"></i>&nbsp;&nbsp;Kosár törlése</a> '; 
                    echo $output;
                  }                 
                  ?>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require 'config.php';
                if (isset($_SESSION["id"])) {
                 $userid= $_SESSION['id'];

                 $stmt = $conn->prepare('SELECT * FROM cart WHERE userid = ?');
                  $stmt->bind_param('i',$userid);
                  $stmt->execute();
                  $result = $stmt->get_result();
                }
                else
                {
                  $currentuser= $_SESSION['currentuser'];

                 $stmt = $conn->prepare('SELECT * FROM cart WHERE currentuser = ?');
                  $stmt->bind_param('i',$currentuser);
                  $stmt->execute();
                  $result = $stmt->get_result();
                }

                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                  <td><?= $row['product_code'] ?></td>
                  <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                  <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                  <td><?= $row['product_name'] ?></td>
                  <td><?= number_format($row['product_price']); ?> Ft</td>
                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                  <td>
                    <input type="number" min="0" max="999" class="form-control qty" value="<?= $row['qty'] ?>" style="width:75px;">
                  </td>
                  <td><?= number_format($row['total_price']); ?> Ft</td>
                  <td>
                    <?php
                    if (isset($_SESSION["id"])) {
                     $userid= $_SESSION['id'];
                     $output = '<a href="action.php?remove='. $row['product_code'].'&userid='. $_SESSION['id'].'" onclick="filter_cart()" class="text-danger lead" onclick="return confirm(Biztosan törli ezt az elemet?)"><i class="fas fa-trash-alt"></i></a> '; 
                      echo $output;
                    }
                    else
                    {
                      $currentuser= $_SESSION['currentuser'];
                      $output = '<a href="action.php?remove='. $row['product_code'].'&currentuser='. $_SESSION['currentuser'].'" onclick="filter_cart()" class="text-danger lead" onclick="return confirm(Biztosan törli ezt az elemet?)"><i class="fas fa-trash-alt"></i></a> ';  
                      echo $output;
                    }                 
                    ?>
                  </td>
              </tr>
              <?php $grand_total += $row['total_price']; ?>
              <?php endwhile; ?>
              <tr>
                  <td colspan="3">
                    <a href="vasarlas.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>Vásárlás folytatása</a>
                  </td>
                  <td colspan="2"><b>Teljes ár</b></td>
                  <td><b><?= number_format($grand_total); ?> Ft</b></td>
                  <td>
                    <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>Összesítés</a>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script type="text/javascript">
  $(document).ready(function() {

    $(".qty").on('change',function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".qty").val();

      var action = 'actionup';
      $.ajax({
        url: 'action.php',
        method: 'POST',
        data: {action:action,qty:qty,pid:pid,pprice:pprice},
        success: function(response) {
         location.reload(true);
        }
      });
    });

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