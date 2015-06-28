<?php
chdir(__DIR__);
include 'classes/DB.php';
$directoryPath = __FILE__;
$paths = explode('/', $directoryPath);
$activeNavPage['index'] = true;
$page = end($paths) ;

$db = DB::getInstance();
$query = 'SELECT * FROM news WHERE id > ? AND id < ?';
$param = array();
$param[0][0] = 2;
$param[0][1] = 5;

$param[1][0] = 3;
$param[1][1] = 5;
$news = $db->runQuery($query, $param, false);
//exit;
include 'view/template.php';