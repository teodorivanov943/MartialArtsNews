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
    
    public function runQuery($query)
    {
        $q = mysqli_query($this->connection, $query);
        
        if(!$q)
        {
            throw new Exception('Query execution problem');
        }
        
        $realResult = array();
        while ($result = $q->fetch_assoc())
        {
            $realResult[] = $result;
        }
        
        
        return $realResult;        
    }
}
