<?php
include (DIRECTORY_SEPARATOR.'bootstrap.php');

$view = new View('view', 'admin_template');
echo $view->render('admin_index');