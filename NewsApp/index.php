<?php 
include('admin/Model/dbh.php');
?>
<!doctype html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home | NewsApp</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="logo">
                    <a href="index.php">NewsApp</a>
                </div>
                <form action="search.php" method="post">
                    <ul>
                        <li><input class="input" type="search" name="search" placeholder="Search" aria-label="Search"></li>
                        <li><button class="src-button" name="find" type="submit">Search</button></li>
                    </ul>
                </form>
            </nav>
        </header>
        <main>
            <section>
                <div class="container height-8">
                    <div class="flex_row" id="load-data">
                        <?php
                        
                        $stmt = $db->prepare('SELECT * FROM news LIMIT 4;');
                        $stmt->execute();
                        if ($stmt->rowCount()==0) {
                            $stmt = null;
                            echo "<h4>There is no result.</h4>";
                        }else{
                        ?>
                        
                            <?php
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach($result as $row)
                                {   $id = $row['news_id'];
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
                        <button type="button" id="<?php echo $id?>" class="button load">Load More</button>
                    </div>
                </div>
            </section>
        </main>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click','.load',function(){
                    var id = $(this).attr("id");
                    $('#load').html("Loading...");
                    $.ajax({
                        url:"admin/Model/loadService.php",
                        method:"POST",
                        data:{id:id},
                        dataType:"text",
                        success:function(data){
                            if (data != "") {
                                $(".load").remove();
                                $("#load-data").append(data);
                            }else{
                                $("#load").html("No more news");
                            }
                        }
                    })
                })
            });
        </script>
    </body>
</html>