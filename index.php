<?php
include ('bootstrap.php');
$activeNavPage['index'] = true;

$db = DB::getInstance();
$query = 'SELECT * FROM news WHERE id > ? AND id < ?';
$param = array();
$param[] = 2;
$param[] = 5;

$news = $db->runQuery($query, $param);
//var_dump($news);

//exit;

$view = new View('view', 'template');
$view->render('index', array('news' => $news));