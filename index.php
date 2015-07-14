<?php

require_once 'ActiveRecord' . DIRECTORY_SEPARATOR . 'Model.php';
require_once 'classes/User.php';
$params = array
    (
    'username' => 'blabla',
    'password' => 'qwerty',
    'email' => 'teodosrivanov943@gmail.com'
);
$user = new User();
$user->create($params);
exit;
include ('classes/User.php');
include ('classes/DB.php');

$db = DB::getInstance();

$result = User::getAll($db);
$id = User::findByID($db, 3);
echo '<pre>' . print_r($result, true) . '</pre><br>';

echo '<pre>' . print_r($id, true) . '</pre>';

