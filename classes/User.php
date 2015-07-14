<?php

class User extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //password by reference, because of hashing
    private function validate($username, &$password, $email)
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

    public static function create(array $params)
    {
        self::validate($params['username'], $params['password'], $params['email']);

        $query = 'SELECT COUNT(*) as cnt FROM User WHERE username=? OR email=?';

        $parameters = array();
        $parameters[0] = $params['username'];
        $parameters[1] = $params['email'];

        $result = parent::getConnection()->runQuery($query, $parameters, DB::SINGLE_RESULT);

        if ($result['cnt'] != 0)
        {
            throw new Exception('Username/E-mail already exists');
        }
        parent::create($params);
    }

    public function saveUser($db)
    {
        $query = 'SELECT COUNT(*) as cnt FROM users WHERE username=? OR email=?';

        $params = array();
        $params[0] = $this->username;
        $params[1] = $this->email;

        $result = $db->runQuery($query, $params, DB::SINGLE_RESULT);

        if ($result['cnt'] != 0)
        {
            throw new Exception('Username/E-mail already exists');
        }

        $options = array('cost' => 11);
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT, $options);

        $query = 'INSERT INTO users (username, password, email) VALUES (?, ?, ?)';

        $params[0] = $this->username;
        $params[1] = $hashed_password;
        $params[2] = $this->email;

        $db->runQuery($query, $params);
    }

    public static function findByID($db, $id)
    {
        $query = 'SELECT * FROM users WHERE user_id=?';
        $param[0] = $id;

        $result = $db->runQuery($query, $param, DB::SINGLE_RESULT);
        return $result;
    }

    public static function getAll($db)
    {
        $query = 'SELECT * FROM users';

        $result = $db->runQuery($query);
        return $result;
    }

    public static function logIn($db, $username, $password)
    {
        if (isset($_SESSION))
        {
            throw new Exception('User already logged');
        }

        $query = 'SELECT password FROM users WHERE username=?';

        $params = array();
        $params[0] = $username;

        $hash = $db->runQuery($query, $params, DB::SINGLE_RESULT);

        if (!password_verify($password, $hash['password']))
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
