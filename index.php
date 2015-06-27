<?php
include (DIRECTORY_SEPARATOR.'bootstrap.php');

$db = DB::getInstance();
$query = 'SELECT * FROM news LIMIT 3';
$news = $db->runQuery($query);

$activeNavPage['index'] = true;

$view = new View(getcwd().DIRECTORY_SEPARATOR.'view', 'template');
$view->render('index', array('news' => $news, 'activeNavPage' => $activeNavPage));