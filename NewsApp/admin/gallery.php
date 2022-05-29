<?php 
include('Model/dbh.php');
session_start();
if ($_SESSION['userid']) {
    if (isset($_POST["submit"])) 
    {
        $id = $_POST["id"];
    }else{
        header("location: index.php");
        exit();
    }
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
                    <li>
                        <a href="add.php">
                            <span class="icon"><ion-icon name="add-outline"></ion-icon></span>
                            <span class="title">Add news</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="galerry.php">
                            <span class="icon"><ion-icon name="list-outline"></ion-icon></span>
                            <span class="title">Gallery</span>
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
                    <h2>Add images to news</h2>
                        <form action="Model/galleryService.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="image[]" multiple>
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <button type="submit" name="submit" class="btn  btn-success">Add</button>
                            <a href="index.php" class="btn  btn-danger">Back to home</a>
                        </form>
                    <h2>Manage actual news images </h2>

                    <?php
                    $stmt = $db->prepare('SELECT * FROM gallery WHERE img_newsid = ?;');
                    $stmt->execute(array($id));
                    if ($stmt->rowCount()==0) {
                        $stmt = null;
                        echo "<h4>There is no result.</h4>";
                    }else{
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">News ID</th>
                                <th scope="col">Img</th>
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
                                    <th scope="row"><?php echo $row["img_id"]?></th>
                                    <td><?php echo $row["img_newsid"]?></td>
                                    <td><img src="gallery/<?php echo $row['img_img'];?>"  height="150" alt="image"></td>
                                    <td>
                                        <form action="Model/galleryService.php" method="post" >
                                            <input type="hidden" name="id" value="<?php echo $row['img_id']?>">
                                            <input type="hidden" name="img" value="<?php echo $row['img_img']?>">
                                            <button type="submit" name="delete" class="btn  btn-danger">Delete</button>
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