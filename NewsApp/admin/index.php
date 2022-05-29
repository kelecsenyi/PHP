<?php
include('Model/dbh.php');
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
                    <li class="active">
                        <a  href="index.php">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li>
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
                    <h2>News list</h2>
                    <?php
                        if (isset($_GET["error"])) {if ($_GET["error"]=="stmtfail")
                        {echo'<div class="alert alert-danger alert-dismissible">
                            <i class="bi bi-x-lg"></i>Cannot delete.
                            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                            </div>';}}?>
    
                        <?php if (isset($_GET["success"])) {if ($_GET["success"]=="success")
                        {echo'<div class="alert alert-success alert-dismissible">
                            <i class="bi bi-x-lg"></i>Operation completed!
                            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                            </div>';}}?>

                        <?php
                        if (isset($_GET["error"])) {if ($_GET["error"]=="imgtaken")
                        {echo'<div class="alert alert-danger alert-dismissible">
                            <i class="bi bi-x-lg"></i>The picture is busy.
                            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                            </div>';}}?>

                        <?php
                        if (isset($_GET["error"])) {if ($_GET["error"]=="wrongtype")
                        {echo'<div class="alert alert-danger alert-dismissible">
                            <i class="bi bi-x-lg"></i>Wrong file type.
                            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                            </div>';}}?>

                        <?php
                        if (isset($_GET["error"])) {if ($_GET["error"]=="emptyinput")
                        {echo'<div class="alert alert-danger alert-dismissible">
                            <i class="bi bi-x-lg"></i>Empty input fields.
                            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                            </div>';}}?>

                        <?php
                        if (isset($_GET["error"])) {if ($_GET["error"]=="invaliddata")
                        {echo'<div class="alert alert-danger alert-dismissible">
                            <i class="bi bi-x-lg"></i>Invalid input text.
                            <button class="btn-close" type="button" data-bs-dismiss="alert"></button>
                            </div>';}}?>
                        <?php


                    $stmt = $db->prepare('SELECT * FROM news;');
                    $stmt->execute();
                    if ($stmt->rowCount()==0) {
                        $stmt = null;
                        echo "<h4>There is no result.</h4>";
                    }else{
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Author</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Gallery</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach($result as $row)
                            {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $row["news_id"]?></th>
                                    <td><?php echo $row["news_author"]?></td>
                                    <td><?php echo $row["news_title"]?></td>
                                    <td><?php echo $row["news_date"]?></td>
                                    <td>
                                        <form action="modify.php" method="post" >
                                            <input type="hidden" name="id" value="<?php echo $row['news_id']?>">
                                            <button type="submit" name="submit" class="btn  btn-success">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="gallery.php" method="post" >
                                            <input type="hidden" name="id" value="<?php echo $row['news_id']?>">
                                            <button type="submit" name="submit" class="btn btn-secondary">Manage</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="Model/deleteService.php" method="post" >
                                            <input type="hidden" name="id" value="<?php echo $row['news_id']?>">
                                            <input type="hidden" name="img" value="<?php echo $row['news_img']?>">
                                            <button type="submit" name="submit" class="btn  btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </main>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/main.js"></script>
    </body>
</html>