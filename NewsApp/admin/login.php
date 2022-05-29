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

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="nouser")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>No such user.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="wrongpwd")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Wrong password or username
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Empty input fields
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="invalidname")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Invalid name.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <h1>Login</h1>
                    <form  action="includes/login.inc.php" method="post">
                        <label for="name"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="name" required>
                        
                        <label for="pwd"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="pwd" required>
                        
                        <div class="center">
                            <button class="button" type="submit" name="submit">Login</button>
                        </div>
                    </form>
                </div>     
            </section>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>