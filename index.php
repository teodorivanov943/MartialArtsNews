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
$user = new User();
User::validate($params['username'], $params['password'], $params['email']);
$user = User::create($params);
var_dump($user);
//exit;
$user->delete();