<?php
include 'bootstrap.php';
include 'classes/User.php';

$view = new View('view', 'template');

if(isset($_SESSION['logged']) && $_SESSION['logged'])
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $user=User::findByID($user_id);
    $view->addParam('user', $user);
}

if(!empty($_POST))
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
    if(empty($errors))
    {
        try
        {
            User::validate($username, $password, $email);
        }
        catch(Exception $e)
        {
            $msg[] = 'Database save problem';
            $view->addParam('msg', $msg);
        }
        
        if(!isset($msg))
        {
            $success[] = "Вашата регистрация е успешна";
            $user = User::create(['username' => $username, 'password' => $password, 'email' => $email]);
            $user->save();
            $view->addParam('msg', $success);
        }
        
    }
    else
    {
        $view->addParam('msg', $errors);
    }
    
}

$view->render('registration');
