<?php 
include('admin/Model/dbh.php');
if (isset($_POST["find"])) {
    $word = $_POST["search"];
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
        <title>Search | NewsApp</title>
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
                    <div class="flex_row">
                        <?php
                        
                        $stmt = $db->prepare("SELECT * FROM news WHERE news_title LIKE '%$word%' OR news_author LIKE '%$word%' OR news_date LIKE '%$word%';");
                        $stmt->execute();
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
                                    <div class="card-post">
                                        <div class="card-post-img">
                                            <img src="admin/uploads/<?php echo $row['news_img'];?>" alt="image">
                                        </div>
                                        <div class="card-post-info">
                                            <div class="card-post-date">
                                                <span><?php echo $row["news_date"]?></span>
                                            </div>
                                            <h1 class="card-post-title"><?php echo $row["news_title"]?></h1>
                                            <h4 class="card-post-author"><?php echo $row["news_author"]?></h4>
                                            <p class="card-post-intro"><?php echo $row["news_intro"]?></p>
                                            <form method="post" action="news.php">
                                                <input type="hidden" name="id" value="<?php echo $row['news_id']?>">
                                                <button type="submit" name="submit" class="button">Read More</button>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="more">
                        <a href="index.php" class="button">Back to home</a>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>