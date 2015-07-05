<?php
include ('classes/User.php');
include ('classes/DB.php');

$db = DB::getInstance();

$result = User::getAll($db);
$id = User::findByID($db, 3);
echo '<pre>'.print_r($result, true).'</pre><br>';

echo '<pre>'.print_r($id, true).'</pre>';

