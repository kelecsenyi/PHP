<?php 
include('Model/dbh.php');
session_start();
if ($_SESSION['userid']) {
    if (isset($_POST["submit"])) {
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
                    <li  class="active">
                        <a href="modify.php">
                            <span class="icon"><ion-icon name="pencil-outline"></ion-icon></span>
                            <span class="title">Modify news</span>
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
                    <h2>Modify News</h2>

                    <?php
                        $stmt = $db->prepare("SELECT * FROM news WHERE news_id = '$id' ;");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $row)
                        {
                        ?> 
                            <form method="post" action="includes/modifynews.inc.php" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title ..." value="<?php echo $row['news_title']?>">
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" placeholder="Author ..." value="<?php echo $row['news_author']?>">
                                </div>

                                <div class="mb-3">
                                    <label for="introduction" class="form-label">Introduction</label>
                                    <textarea class="form-control" id="introduction" name="intro" rows="3"><?php echo $row['news_intro']?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="main" class="form-label">Main text</label>
                                    <textarea class="form-control" id="main" rows="10" name="main"><?php echo $row['news_text']?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="file" class="form-label">Main image</label>
                                    <input class="form-control" type="file" id="file" name="file">
                                    <input type="hidden" name="ifimgempty" value="<?php echo $row['news_img']?>">
                                </div>
                                <input type="hidden" name="id" value="<?php echo $row['news_id']?>">
                                <button type="submit" name="submit" class="btn  btn-primary">Save to database</button>
                                <a href="index.php" class="btn  btn-danger">Back to home</a>
                            </form>
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