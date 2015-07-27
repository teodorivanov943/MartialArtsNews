<?php

class Model
{

    private static $connection = NULL;
    private static $tableName;
    private $property;
    private $dbScheme;
    
    
    public function __set($name, $value)
    {
        $match = false;

        foreach (self::getScheme() as $scheme)
        {
            if ($scheme['Field'] == $name)
            {
                $match = true;
                $this->property[$name] = $value;
                break;
            }
        }
        if (!$match)
        {
            throw new Exception('Property does not match table field');
        }
    }

    public function __get($name)
    {
        $match = false;

        foreach (self::getScheme() as $scheme)
        {
            if ($scheme['Field'] == $name)
            {
                $match = true;
                return $this->property[$name];
            }
        }
        if (!$match)
        {
            throw new Exception('Property does not exist');
        }
    }

    public static function init()
    {
        self::$connection = DB::getInstance();
    }

    public static function runQuery($query, $args = array(), $resultType = DB::MULTIPLE_RESULT)
    {
        return self::$connection->runQuery($query, $args, $resultType);
    }

    private function getScheme()
    {
        if (!$this->dbScheme)
        {
            $query = 'DESCRIBE ' . $this->getTableName();
            $dbSchema = self::$connection->runQuery($query);

            $this->dbScheme = $dbSchema;
        }
        return $this->dbScheme;
    }

    private static function getTableName()
    {
        self::$tableName = get_called_class();
        return self::$tableName;
    }

    
    public static function create(array $params)
    {
        $class = self::getTableName();
        $result = new $class;

        foreach ($params as $key => $value)
        {
            $result->$key = $value;
        }
            
        return $result;
    }

    public function update(array $params)
    {
        $query = 'UPDATE ' . self::getTableName() . ' SET ';
        $iterCnt = 0;
        
        foreach ($params as $key => $value)
        {
            $iterCnt++;
            if($iterCnt == count($params))
            {
                $query = $query . $key.' =?';
                break;
            }
            $query = $query . $key.' =?, ';
        }
        $query = $query . ' WHERE ' . strtolower(self::getTableName()) . '_id=?';
        $params[] = $this->__get(strtolower(self::getTableName() . '_id'));
        
        self::runQuery($query, $params);
        
    }
    
    public function save()
    {
        //TODO: Move to queryBuilder
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

        $query = 'INSERT INTO ' . self::getTableName() . '(' . $fields . ') VALUES(' . $qmarks . ')';

        self::$connection->runQuery($query, $values);
    }

    public function delete()
    {
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

        $query = 'DELETE FROM ' . self::getTableName() . ' WHERE ' . $condition;

        self::$connection->runQuery($query, $values);
    }

    public static function findByID($id)
    {
        //id = tablename + _id
        $query = 'SELECT * FROM ' . self::getTableName()
                . ' WHERE ' . strtolower(self::getTableName()) . '_id=?';
        
        $param[0] = $id;
        $properties = self::$connection->runQuery($query, $param, DB::SINGLE_RESULT);

        if (!$properties)
            throw new Exception('Record does not exist');

        $result = self::create($properties);
        
        return $result;
    }

    public static function where(array $params, $resultType = DB::SINGLE_RESULT)
    {        
        $query = 'SELECT * FROM ' . self::getTableName() . ' WHERE ';
        $values = array();
        $iterCnt = 0;
        
        foreach ($params as $key => $val)
        {
            $iterCnt++;
            
            if($iterCnt == count($params))
            {
                $query = $query . $key . ' = ?'; 
                $values[] = $val;
                break;
            }
            $query = $query . $key . ' = ? AND '; 
            $values[] = $val;
        }
        
        $params = self::$connection->runQuery($query, $values, $resultType);
        
        if(!$params)
        {
            return NULL;
        }
        
        if($resultType == DB::SINGLE_RESULT)
        {
            $result = self::create($params);
        }
        else
        {
            foreach($params as $param)
            {
                $result[] = self::create($param);
            }
        }
        
        return $result;
    }
    
    public static function getAll()
    {
        $query = 'SELECT * FROM ' . self::getTableName();
        
        $params = Model::runQuery($query);
        
        foreach($params as $param)
        {
            $result[] = self::create($param);
        }
        
        return $result;
    }

}