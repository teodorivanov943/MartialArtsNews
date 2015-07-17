<?php

class User extends Model
{

    //password by reference, because of hashing
    public static function validate($username, &$password, $email)
    {
        if (!(strlen($username) > 4 && strlen($username) < 25) &&
                (preg_match('/^[a-zA-Z]+$/', $username[0]) && preg_match("/^[a-zA-Z0-9_ ]+$/", $username)))
        {
            throw new Exception('Invalid username');
        }

        if (!(strlen($password) > 4 && strlen($password) < 25))
        {
            throw new Exception('Invalid password');
        }

        $options = array('cost' => 11);
        $password = password_hash($password, PASSWORD_BCRYPT, $options);


        if (!(strlen($email) > 6 && strlen($email) < 50 || filter_var($email, FILTER_VALIDATE_EMAIL)))
        {
            throw new Exception('Invalid e-mail');
        }
    }

    public static function logIn($username, $password)
    {
        $db = parent::getConnection();

        if (isset($_SESSION))
        {
            throw new Exception('User already logged');
        }

        $query = 'SELECT password FROM ' . get_class() . ' WHERE username=?';

        $params = array();
        $params[0] = $username;

        $res = $db->runQuery($query, $params, DB::SINGLE_RESULT);

        if ($res['password'] != $password)
        {
            throw new Exception('Invalid username/password');
        }

        session_start();
        $_SESSION['logged'] = true;
    }

    public static function LogOut()
    {
        if (isset($_SESSION))
        {
            session_destroy();
        }
    }

}
