<?php
class DB
{ 
    private static $instance = NULL;
    private $connection = NULL;
    
    private function __construct()
    {
        $content = file_get_contents(__DIR__.'/connection_data.txt');
        $content = explode('.', $content);
        
        $connection_data = [];
        $connection_data['username'] = $content[0];
        $connection_data['password'] = $content[1];
        $connection_data['database'] = $content[2];
        
        $this->connection = mysqli_connect('localhost', $connection_data['username'],
                $connection_data['password'], $connection_data['database']);
        mysqli_set_charset($this->connection, 'utf8');
                       
        if(!$this->connection)
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
        
        if(self::$instance == NULL)
        {
            self::$instance = new DB();
                  
        }
        
        return self::$instance;
    }
    
    public function runQuery($query, $args)
    {
        $placeholderCnt = substr_count($query, '?');
        $resultIndex = 0;
        
        $stmt = mysqli_prepare($this->connection, $query);
        if(!$stmt)
            throw new Exception('Query statement problem'); 
        
        //getting bind type and bind value
        foreach($args as $v)
        {
            $binded['statement'] = $stmt;
            $binded['type'] = "";
            $valueIndex = 0;
            
            foreach($v as $vv)
            {
                $binded['type'] = $binded['type'].substr(gettype ($vv), 0, 1);
                if ($binded['type'] == 'N')
                    $binded['type'] = 'i';
                
                $binded[$valueIndex] = $vv;
                $valueIndex++;
            }
            
            //making the values in $binded references
            //because of the call_user_func_array
            
            $bindedRef = array();
            $bindedRef['statement'] = $binded['statement'];
            $bindedRef['type'] = $binded['type'];
            
            foreach ($binded as $key => $value)
            {
                if($key !== 'statement' && $key !== 'type')
                {
                    $bindedRef[$key] = &$binded[$key];
                }
            }
            
            if(!call_user_func_array('mysqli_stmt_bind_param', $bindedRef))
                throw new Exception('Query binding parameters problem');
            
            if($stmt->execute())
            {
                $res = $stmt->get_result();
                
                while($row = $res->fetch_array(MYSQLI_ASSOC))
                {
                    if($res->num_rows == 1)
                        $result[$resultIndex] = $row;
                    else
                        $result[$resultIndex][] = $row;
                                       
                }
                $resultIndex++;
            }
            else
                throw new Exception ('Query execution problem');
        }
        
        $stmt->close();
       
        return $result;
    }
}
//TODO: един резултат или много ... аргументи към заявките