<?php
include (DIRECTORY_SEPARATOR.'bootstrap.php');

$db = DB::getInstance();
$query = 'SELECT * FROM news';
$news = $db->runQuery($query);

$view = new View('view', 'admin_template');
echo $view->render('admin_news', array('news' => $news));