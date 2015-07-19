<?php
require_once 'bootstrap.php'; 

require_once 'classes/User.php';
require_once 'classes/News.php';
Model::init();
if (isset($_SESSION['login_errors']))
{
    $view->addParam('loginError', $_SESSION['login_error']);
    unset($_SESSION['login_error']);
}

$view = new View('view', 'template');

$query = 'SELECT * FROM News WHERE id > ? AND id < ?';
$param[] = 1;
$param[] = 5;

$news = new News();
$news = News::runQuery($query, $param);
$view->addParam('news', $news);
$view->render('index');





