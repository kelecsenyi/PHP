<?php 
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
          <a class="dropdown-item active" href="product.php">Termék hozzáadása</a>
          <a class="dropdown-item" href="update.php">Termék módosítása</a>
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
    <form method="POST" action="product.inc.php">
          <div class="row-lg-6">
           <div class="col py-2">

            <?php if (isset($_GET["succes"])) {if ($_GET["succes"]=="succesadd")
              {echo'<div class="alert alert-success" role="alert">Sikeres bevitel!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="fail")
              {echo'<div class="alert alert-danger" role="alert">Sikertelen módosítás!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
               {echo'<div class="alert alert-danger" role="alert">Töltsön ki minden mezőt!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) { if ($_GET["error"]=="idtaken") 
              {echo'<div class="alert alert-danger" role="alert">Már létezik ilyen azonosító!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <?php if (isset($_GET["error"])) { if ($_GET["error"]=="imagetaken") 
              {echo'<div class="alert alert-danger" role="alert">Már van ilyen elérési útvonallal rendelkező kép!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></div>';}}?>

              <h5>Új termék bevitele</h5>
              <hr class="mb-3">
              <label for="id"><b>Termék azonosítója</b></label>
              <input class="form-control" placeholder="pl: 001" maxlength="10" type="text" name="id" required>

              <label for="brand"><b>Termék típusa </b></label>
              <select name="brands" class="custom-select">
                <option value="ffp2">FFP2 maszk</option>
                <option value="teljesalarc">Teljesálarc</option>
                <option value="szovetmaszk">Szövet maszk</option>
                <option value="orvosimaszk">Orvosi maszk</option>
              </select>

              <label for="name"><b>Termék neve</b></label>
              <input class="form-control" placeholder="Termék neve" type="text" name="name" required>

              <label for="details"><b>Termék leírása</b></label>
              <input class="form-control" placeholder="Termék leírása" type="text" name="details" required>

              <label for="price"><b>Ár</b></label>
              <input class="form-control" placeholder="pl: 1000" maxlength="10" type="number" min="0" max="9999999999" name="price" required> 

              <label for="image"><b>Kép elérési útvonala és a kiterjesztése</b></label>
              <input class="form-control" placeholder="Assets/példa.jpg" value="Assets/" type="text" name="image" required>

              <label for="quantity"><b>Mennyiség</b></label>
              <input class="form-control" placeholder="pl: 13" maxlength="6" type="number" min="0" max="999999" name="quantity" required><br> 
              <button type="save" name="savebutton" class="btn btn-primary">Mentés</button>
            </div>
          </div>
    </form>
  </div>
</body>
</html>