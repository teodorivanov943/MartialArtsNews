<?php
include 'bootstrap.php';

if(!empty($_SESSION))
{
    $_SESSION['logged'] = false;
    
    unset($_SESSION['is_admin']);
    unset($_SESSION['user_id']);
    unset($_SESSION['login_error']);
    
    session_destroy();      
}

header('Location: index.php');