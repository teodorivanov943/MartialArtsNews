<?php
include ('classes/User.php');
include ('classes/DB.php');

$db = DB::getInstance();
$user = new User('teodor', 'qwerty', 'teodorivanov943@gmail.com');
$result = $user->getAll($db);
echo '<pre>'.print_r($result, true).'</pre>';