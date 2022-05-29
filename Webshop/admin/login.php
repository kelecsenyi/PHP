<!DOCTYPE html>
<html lang="hu" dir="ltr">
  <head>
    <title>"Webarc.hu"</title>
    <meta charset="utf-8">
    <!--style-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    <a class="navbar-brand" href="login.php"> WEBARC WEBÁRUHÁZ</a>
  </nav>
</header>
<body>
  <div class="container">     
    <form action="login.inc.php" method="POST">
      <div class="form-row">
         <div class="col-sm-6 col-md-8 col-lg-12">
          <h4 class="mt-5">Bejelentkezés</h4>
            <label for="email"><b>Felhasználónév</b></label>
            <input type="text" class="form-control" placeholder="Felhasználónév" name="username" required>
            <label for="password"><b>Jelszó</b></label>
            <input type="password" class="form-control" placeholder="Jelszó" name="password" required><br>
            <button type="submit" name="button" class="btn btn-success ">Belépés</button>
          </div>
      </div>
    </form>

    <?php
        if (isset($_GET["error"])) {
           if ($_GET["error"]=="emptyinput") {
             echo"<h4>Minden mezőt töltsön ki!</h4>";
           }
          elseif ($_GET["error"]=="nouser") {
             echo"<h4>Nincs ilyen felhasználó!</h4>";
           }
           elseif ($_GET["error"]=="wrongpassword") {
             echo"<h4>Helytelen jelszó!</h4>";
           }
         } 
        ?>
  </div>
</body>
</html>