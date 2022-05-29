<?php
error_reporting(-1);
ini_set('display_errors','on');

include('config.php');
include('configPDO.php');

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
    <link rel="stylesheet" href="css/buy.css">
   <!-- jQuery first-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!--slider-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!--JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

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
            <a class="nav-link " href="index.php">Főoldal</a>
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
            <a class="nav-link bg-secondary rounded" href="vasarlas.php">Vásárlás</a>
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

  <section class="container">

    <?php if (isset($_GET["succes"])) {if ($_GET["succes"]=="cartadd")
    {echo'<div class="alert alert-success" role="alert">A termék bekerült a kosaradba!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button></div>';}}?>


    <?php if (isset($_GET["notsucces"])) {if ($_GET["notsucces"]=="alreadyadd")
    {echo'<div class="alert alert-danger" role="alert">A termék egyszer már bekerült a kosaradba!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button></div>';}}?>

    <br>
    <div id="messages"></div>
    <div class="row ">
      <div class=" col-md-3 col-lg-3 mt-4">
        <h4>Ár szerint szűrés (Ft)</h4>
        <div class="list-group mb-2">
          <input type="hidden" id="hidden_minimum_price" value="0" />
          <input type="hidden" id="hidden_maximum_price" value="20000" />        
          <p id="price_show">1000 - 20000</p>
          <div id="price_range"></div>
        </div>
        <h4>Típus szerint szűrés</h4>
        <div class="list-group">
          <?php
          $query = "SELECT DISTINCT pbrand FROM products ORDER BY ID DESC";
          $statement = $db->prepare($query);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach($result as $rowbrand)
          {
          ?>
          <div class="list-group-item checkbox">
          <label><input type="checkbox" class="common_selector brand" value="<?php echo $rowbrand["pbrand"]; ?>"> <?php echo $rowbrand["pbrand"]; ?></label>
          </div>
            <?php
            }
            ?>
        </div>
      </div>

      <div class="col-md-9 col-lg-9">
          <div class="row filter_data mt-2">
           
        </div>
      </div>
    </div>
  </section>
  <script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:500,
        max:20000,
        values:[500, 20000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
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