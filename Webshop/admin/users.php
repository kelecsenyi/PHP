<?php 
error_reporting(-1);
ini_set('display_errors','on');
session_start();
if ($_SESSION['id']) {
}
else
{
  header("location: login.php");
}    
?>
<!DOCTYPE html>
<html lang="hu" dir="ltr">
  <head>
    <title>"Webarc.hu"</title>
    <meta charset="utf-8">
    <!--style-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
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
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> Raktár</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="product.php">Termék hozzáadása</a>
          <a class="dropdown-item" href="update.php">Termék módosítása</a>
      </li>
      <li class="nav-item" style="margin-right: 10px;">
        <a class="nav-link active" href="users.php">Vásárlók</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="logout.inc.php">
      <?php
      if (isset($_SESSION["id"])) {
         echo " Kilépés";
       } 
      ?>
      </a></li>
    </ul><hr>

    <div class="row">
      <div class="col sm-9 col-md-15 col-lg-15">
        <div class="section-container" id="result">

        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function() {

  Users();
    function Users()
    {
        var action = 'user';
        $.ajax({
            url:"usertemplate.php",
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