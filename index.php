<?php
require_once 'bootstrap.php'; 

require_once 'classes/User.php';
require_once 'classes/News.php';

Model::init();

$view = new View('view', 'template');

if (isset($_SESSION['login_errors']))
{
    $view->addParam('loginError', $_SESSION['login_error']);
    unset($_SESSION['login_error']);
}

if (isset($_SESSION['is_admin']) && $_SESSION['logged'])
{
    header('Location: admin_index.php');
}

if(isset($_SESSION['logged']) && $_SESSION['logged'])
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $user=User::findByID($user_id);
    $view->addParam('user', $user);
}

$query = 'SELECT * FROM News WHERE deleted=? LIMIT ?';

$news = new News();
$param[0] = 0;
$param[1] = 3;
$news = News::runQuery($query, $param);

$view->addParam('news', $news);
$view->render('index');





