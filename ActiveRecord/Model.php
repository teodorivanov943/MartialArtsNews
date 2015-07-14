<?php

require_once 'classes/DB.php';

class Model
{

    private static $connection = NULL;

    protected function __construct()
    {
        self::$connection = DB::getInstance();
    }

    public function getConnection()
    {
        return self::$connection;
    }

    public static function create(array $params)
    {
        $class = get_called_class();

        $parameters = "";
        $values = array();
        $questionMarks = "";

        foreach ($params as $key => $val)
        {
            if ($val == end($params))
            {
                $parameters = $parameters . $key;
                $values[] = $val;
                $questionMarks = $questionMarks . '?';
                break;
            }
            $parameters = $parameters . $key . ', ';
            $values[] = $val;
            $questionMarks = $questionMarks . '?, ';
        }

        $query = 'INSERT INTO ' . $class . '(' . $parameters . ') VALUES(' . $questionMarks . ')';
        echo $query;
        echo '<pre>' . print_r($values, true) . '</pre>';

        self::$connection->runQuery($query, $values);
    }

}
