<?php
include 'bootstrap.php';
include 'classes/User.php';

$view = new View('view', 'template');
$view->render('registration');


if(isset($_POST))
{
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $confirmPass = isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : ""; 
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    
    
    if (!(strlen($username) > 4 && strlen($username) < 25) ||
            !preg_match('/^[a-zA-Z]+$/', $username[0]) || !preg_match("/^[a-zA-Z0-9_ ]+$/", $username))
    {
        $errors[] = 'Невалидно потребителско име';
    }
    
    if (!(strlen($password) > 4 && strlen($password) < 25))
    {
        $errors[] = 'Невалидна парола';
    }
    
    if($password != $confirmPass)
    {
        $errors[] = 'Несъответстващи пароли';
    }
    
    if (!(strlen($email) > 6 && strlen($email) < 50 || filter_var($email, FILTER_VALIDATE_EMAIL)))
    {
        $errors[] = 'Невалиден e-mail';
    }    
    if(!isset($errors))
    {
        try
        {
            User::validate($username, $password, $email);
        }
        catch(Exception $e)
        {
            $errors[] = 'Database save problem';
            $view->addParam('errors', $errors);
        }
        
        if(!isset($msg))
        {
            $success = "Вашата регистрация е успешна";
            $user = User::create(['username' => $username, 'password' => $password, 'email' => $email]);
            $user->save();
            $view->addParam('success', $success);
        }
        
    }
    else
    {
        $view->addParam('error', $errors);
    }
    
}