<?php 
session_start();
if ($_SESSION['userid']) {
}
else
{
    header("location: login.php");
    exit();
}
?>
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
        <header>
            <nav>
                <h1 class="logo">NewsApp - Admin</h1>
                <div class="menu-btn">
                    <div class="menu-btn-burger"></div>
                </div>
                <ul class="menu">
                    <li >
                        <a  href="index.php">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="add.php">
                            <span class="icon"><ion-icon name="add-outline"></ion-icon></span>
                            <span class="title">Add news</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                            <span class="title">Log out</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <section>
                <div class="container">

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="filetaken")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>The file already exists.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="wrongtype")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Wrong file type.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="stmtfail")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Cannot save to database.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Empty input fields
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["error"])) {if ($_GET["error"]=="invalidata")
                    {echo'<div class="alert alert-danger alert-dismissible">
                        <i class="bi bi-x-lg"></i>Invalid text format.
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <?php if (isset($_GET["success"])) {if ($_GET["success"]=="success")
                    {echo'<div class="alert alert-success alert-dismissible">
                        <i class="bi bi-x-lg"></i>Save completed!
                        <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                        </div>';}}?>

                    <h2>Add News</h2>
                    <form action="includes/addnews.inc.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" placeholder="Author ..." required>
                        </div>

                        <div class="mb-3">
                            <label for="intro" class="form-label">Introduction</label>
                            <textarea class="form-control" id="intro" rows="3" name="intro"></textarea required>
                        </div>

                        <div class="mb-3">
                            <label for="main" class="form-label">Main text</label>
                            <textarea class="form-control" id="main" rows="10" name="main"></textarea required>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Main image</label>
                            <input class="form-control" type="file" id="file" name="file" required>
                        </div>

                        <button type="submit" name="submit" class="btn  btn-primary">Save to database</button>
                        <a href="index.php" class="btn  btn-danger">Back to home</a>
                    </form>
                </div>
            </section>
        </main>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/main.js"></script>
    </body>
</html>