<?php
include "../Model/dbh.php";
$output='';
$id = '';
$stmt = $db->prepare("SELECT * FROM news WHERE news_id > ".$_POST['id']."");
if (!$stmt->execute()) {
    $stmt = null;
    $output = "Database error";
    echo $output;
}

if ($stmt->rowCount() == 0) {
    $stmt = null;
    $output = "No more news, come back later.";
    echo $output;
}else{
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output.='
    <div class="flex_row" id="load-data">
    ';
    foreach($result as $row)
    {   $id = $row['news_id'];
        $output.='
        <div class="card-post">
            <div class="card-post-img">
                <img src="admin/uploads/'.$row["news_img"].'" alt="image">
            </div>
            <div class="card-post-info">
                <div class="card-post-date">
                    <span>'.$row["news_date"].'</span>
                </div>
                <h1 class="card-post-title">'.$row["news_title"].'</h1>
                <h4 class="card-post-author">'.$row["news_author"].'</h4>
                <p class="card-post-intro">'.$row["news_intro"].'</p>
                <form method="post" action="news.php">
                    <input type="hidden" name="id" value="'.$row["news_id"].'">
                    <button type="submit" name="submit" class="button">Read More</button>
                </form>
            </div>
        </div>
    ';
    }
    $output .='
        </div>
        <div class="more">
            <button type="button" id="'.$id.'" class="button load">Load More</button>
        </div>
    ';
    echo $output;
}
