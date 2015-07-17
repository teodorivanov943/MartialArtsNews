<?php

require_once 'ActiveRecord' . DIRECTORY_SEPARATOR . 'Model.php';
require_once 'classes/User.php';
$params = array
    (
    'username' => 'blaabla',
    'password' => 'qwerty',
    'email' => 'teodosrsivanov943@gmail.com'
);

Model::init();
$users = User::getAll();
echo '<pre>'.print_r($users, true).'</pre>';