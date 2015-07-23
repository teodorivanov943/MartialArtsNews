<?php

include 'bootstrap.php';
include 'classes/News.php';
if(!empty($_GET))
{
    $new_id = isset($_GET['news_id']) ? $_GET['news_id'] : NULL;
    $new = News::findByID($new_id);
    
    $new->delete();
    $new->deleted = 1;
    
    $new->save();
}

header('Location: admin_news.php');
