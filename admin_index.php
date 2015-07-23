<?php
include 'bootstrap.php';

$view = new View('view', 'admin_template');
$view->render('admin_index');