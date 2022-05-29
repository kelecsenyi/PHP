<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin | NewsApp</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/admin-style.css">
    </head>
    <body>
        <main>
            <section>
                <div class="wrapper">

                <?php if (isset($_GET["error"])) {if ($_GET["error"]=="stmtfail")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Connection error.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="pwderror")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Passwords do not match.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="nametaken")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>User already exists.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Empty input fields.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="invalidname")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Invalid name.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <h1>Sign up</h1>
                    <form  action="includes/signup.inc.php" method="post">
                        <label for="name"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="name" required>
                        
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="pwd" required>

                        <label for="pwd"><b>Password again</b></label>
                        <input type="password" placeholder="Enter Password again" name="pwdagain" required>
                        
                        <div class="center">
                            <button class="button" type="submit" name="submit">Sign up</button>
                        </div>
                    </form>
                </div>     
            </section>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>