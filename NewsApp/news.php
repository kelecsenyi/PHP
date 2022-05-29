<?php 
include('admin/Model/dbh.php');
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
}else{
    header("location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>News | NewsApp</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="logo">
                    <a href="index.php">NewsApp</a>
                </div>
            </nav>
        </header>
        <main>
            <section>
                <div class="container height-8">
                        <?php
                        $stmt = $db->prepare('SELECT * FROM news WHERE news_id = ?;');
                        $stmt->execute(array($id));
                        if ($stmt->rowCount()==0) {
                            $stmt = null;
                            echo "<h4>There is no result.</h4>";
                        }else{
                        ?>
                        
                            <?php
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach($result as $row)
                                {
                                ?>
                                    <h1 class="title"><?php echo $row["news_title"]?></h1>
                                    <div class="card-post-date">
                                        <span><?php echo $row["news_date"]?></span>
                                    </div>
                                    <h4 class="author"><?php echo $row["news_author"]?></h4>
                                    <div class="content">
                                        <p class="intro"><?php echo $row["news_intro"]?></p>
                                        <div class="img more">
                                            <img src="admin/uploads/<?php echo $row["news_img"]?>" alt="Main image">
                                        </div>
                                        <p class="text"><?php echo $row["news_text"]?></p>
                                    </div>
                                <?php
                                }
                                ?>
                        <?php
                        }
                        ?>

                        <ul class="img-gallery">
                        <?php
                        $stmt = null;
                        $stmt = $db->prepare('SELECT * FROM gallery WHERE img_newsid = ?;');
                        $stmt->execute(array($id));
                        if ($stmt->rowCount()==0) {
                            $stmt = null;
                            echo "<h4>There is no gallery yet</h4>";
                        }else{
                        ?>
                            <?php
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach($result as $row)
                                {
                                ?>
                                    <li class="gallery">
                                        <img src="admin/gallery/<?php echo $row["img_img"]?>" alt="Gallery image">
                                    </li>
                                <?php
                                }
                                ?>
                        <?php
                        }
                        ?>

                        </ul>

                    <div class="more">
                        <a href="index.php" class="button">Back to home</a>
                    </div>
                </div>
            </section>
        </main>

        <script src="assets/main.js"></script>
    </body>
</html>