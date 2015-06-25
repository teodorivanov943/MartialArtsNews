<?php
chdir(__DIR__);
include 'classes/DB.php';
$directoryPath = __FILE__;
$paths = explode('/', $directoryPath);
$activeNavPage['index'] = true;
$page = end($paths) ;

$db = DB::getInstance();
$query = 'SELECT * FROM news LIMIT 3';
$news = $db->runQuery($query);

include 'view/template.php';