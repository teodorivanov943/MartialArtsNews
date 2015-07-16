<?php

require_once 'classes/DB.php';

class Model
{
    private static $connection = NULL;
    private $property;

    public function __set($name, $value)
    {
        $class = get_called_class();
        
        $query = 'DESCRIBE ' . $class;
        $dbSchema = self::$connection->runQuery($query);
        $match = false;
        
        foreach ($dbSchema as $val)
        {
            if($val['Field'] == $name)
            {
                $match = true;
                $this->property[$name] = $value;
                break;
            }
        }
        if(!$match)
        {
            throw new Exception('Property does not match table field');
        }
    }
    
    public function __get($name)
    {
        $class = get_called_class();
        
        $query = 'DESCRIBE ' . $class;
        $dbSchema = self::$connection->runQuery($query);
        $match = false;

        foreach ($dbSchema as $val)
        {
            if($val['Field'] == $name)
            {
                $match = true;
                return $this->property[$name];
            }
        }
        if(!$match)
        {
            throw new Exception('Property does not exist');
        }
    }
    
    public static function init()
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

        $query = 'DESCRIBE ' . $class;
        $dbSchema = self::$connection->runQuery($query);

        $result = new $class;

        foreach ($params as $key => $value)
        {
            $match = false;
            foreach ($dbSchema as $scheme)
            {
                if ($key == $scheme['Field'])
                {
                    $result->property[$key] = $value;
                    $match = true;
                }
            }
            if (!$match)
                throw new Exception('Parameters problem');
        }

        return $result;
    }

    public function save()
    {
        $class = get_called_class();

        $fields = "";
        $values = array();
        $qmarks = "";

        $iterCnt = 0;

        foreach ($this->property as $key => $val)
        {
            $iterCnt++;

            if ($iterCnt == count($this->property))
            {
                $fields = $fields . $key;
                $values[] = $val;
                $qmarks = $qmarks . '?';
                break;
            }

            $fields = $fields . $key . ', ';
            $values[] = $val;
            $qmarks = $qmarks . '?, ';
        }

        $query = 'INSERT INTO ' . $class . '(' . $fields . ') VALUES(' . $qmarks . ')';

        self::$connection->runQuery($query, $values);
    }

    public function delete()
    {
        $class = get_called_class();

        $condition = "";
        $values = array();
        $iterCnt = 0;

        foreach ($this->property as $key => $val)
        {
            $iterCnt++;

            if ($iterCnt == count($this->property))
            {
                $condition = $condition . $key . '=?';
                $values[] = $val;
                break;
            }

            $condition = $condition . $key . '=? AND ';
            $values[] = $val;
        }

        $query = 'DELETE FROM ' . $class . ' WHERE ' . $condition;

        self::$connection->runQuery($query, $values);
    }

    public static function findByID($id)
    {
        $class = get_called_class();
        
        //id = tablename + _id
        $query = 'SELECT * FROM ' . $class . ' WHERE ' . strtolower($class) . '_id=?';

        $param[0] = $id;
        $properties = self::$connection->runQuery($query, $param, DB::SINGLE_RESULT);

        if (!$params)
            throw new Exception('Record does not exist');

        $result = self::create($properties);
        return $result;
    }
    
    public static function getAll()
    {
        $class = get_called_class();
        
        $query = 'SELECT * FROM ' . $class;
        
        $result = self::$connection->runQuery($query);
        
        return $result;
    }
    
}
