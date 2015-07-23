<?php
include 'bootstrap.php';

$query = 'SELECT * FROM News WHERE deleted = ?';
$param[] = 0;
$news = Model::runQuery($query, $param);

$view = new View('view', 'admin_template');
$view->render('admin_news', array('news' => $news));