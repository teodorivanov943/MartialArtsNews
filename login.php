<?php
require_once 'bootstrap.php';
include 'classes/User.php';

if(!empty($_POST))
{
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    
    $user = User::logIn($username, $password);
    if($user)
    {
        $_SESSION['logged'] = true;
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['is_admin'] = $user->is_admin;
    }
    else
    {
        $_SESSION['login_error'] = 'Невалидно потребителско име/парола';
    }
    
}

header('Location: index.php');