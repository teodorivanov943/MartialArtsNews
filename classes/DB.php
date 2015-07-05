<?php

class DB
{
    const SINGLE_RESULT = 1;
    const MULTIPLE_RESULT = 2;
    
    private static $instance = NULL;
    private $connection = NULL;
    private function __construct()
    {
        $content = file_get_contents(__DIR__ . '/connection_data.txt');
        $content = explode('.', $content);

        $connection_data = [];
        $connection_data['username'] = $content[0];
        $connection_data['password'] = $content[1];
        $connection_data['database'] = $content[2];

        $this->connection = mysqli_connect('localhost', $connection_data['username'], $connection_data['password'], $connection_data['database']);
        mysqli_set_charset($this->connection, 'utf8');

        if (!$this->connection)
        {
            throw new Exception('Database connection problem');
        }
    }

    /**
     * 
     * @return DB
     */
    public static function getInstance()
    {

        if (self::$instance == NULL)
        {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    private function &bindArray($stmt, array $args)
    {
        $binded['statement'] = $stmt;
        $binded['type'] = "";
        $valueIndex = 0;
        
        foreach ($args as $v) 
        {
            $binded['type'] = $binded['type'] . substr(gettype($v), 0, 1);
            $binded[$valueIndex] = $v;
            $valueIndex++;
        }
        return $this->refBindArray($binded);
    }
    
    private function &refBindArray(array $arr)
    {
        $bindedRef = array();
        $bindedRef['statement'] = $arr['statement'];
        $bindedRef['type'] = $arr['type'];

        foreach ($arr as $key => $value) 
        {
            if ($key !== 'statement' && $key !== 'type') 
            {
                $bindedRef[$key] = &$arr[$key];
            }
        }
        return $bindedRef;
    }
    
    public function runQuery($query, $args = array(),
            $resultType = self::MULTIPLE_RESULT)
    {
        $placeholderCnt = substr_count($query, '?');
        
        if($placeholderCnt != 0 && $placeholderCnt / count($args) != 1)
        {
            throw new Exception('Parameters number problem');
        }
        
        $stmt = mysqli_prepare($this->connection, $query);
        if (!$stmt)
        {
            throw new Exception('Query statement problem');
        }
        
        if (count($args) != 0) 
        {
            if (!call_user_func_array('mysqli_stmt_bind_param', $this->bindArray($stmt,$args))) 
            {
                throw new Exception('Query binding parameters problem');
            }
        }
        if (!$stmt->execute())
        {
            throw new Exception('Query execution problem');
        }
        
        $res = $stmt->get_result();
        
        if(is_bool($res))
        {
            return;
        }

        if($resultType == self::SINGLE_RESULT)
        {
            $result = $res->fetch_array(MYSQLI_ASSOC);
        }
                
        else
        {
            while ($row = $res->fetch_array(MYSQLI_ASSOC))
            {
                $result[] = $row;
            }
        }
        
        $stmt->close();
        return $result;
    }
}
