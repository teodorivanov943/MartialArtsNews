<?php

class View {

    /**
     * @var string
     */
    private $layout;
    /**
     * @var string
     */
    private $view;
    /**
     * @var string
     */
    private $viewDirectory;
    /**
     * @var array
     */
    private $params = array();


    /**
     * @param string $viewDirectory
     * @param string $layout
     */
    public function __construct($viewDirectory, $layout)
    {
        $this->setViewDirectory($viewDirectory);
        $this->setLayout($layout);
    }

    /**
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $viewDirectory
     */
    public function setViewDirectory($viewDirectory)
    {
        $this->viewDirectory = $viewDirectory;
    }

    /**
     * @param string $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param string $view
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function render($view = '', array $params = array())
    {
        $this->setView($view);
        foreach($params as $key => $value)
        {
            $this->addParam($key, $value);
        }
          
        foreach($this->params as $key => $value)
        {
            $$key = $value;
        }
        
        $this->checkViewDirectory();
        $this->checkLayout();
        $this->checkView();
        
        
        
        $view = $this->getViewFile();
        include $this->getLayoutFile();
    }

    /**
     * @return string
     */
    public function getLayoutFile()
    {
        return $this->viewDirectory.DIRECTORY_SEPARATOR.$this->layout.'.php';
    }

    /**
     * @return string
     */
    public function getViewFile()
    {
        return $this->viewDirectory.DIRECTORY_SEPARATOR.$this->view.'.php';
    }

    /**
     * @throws Exception
     */
    private function checkViewDirectory()
    {
        if(!is_dir($this->viewDirectory)){
            throw new \Exception("Invalid view directory");
        }
    }

    /**
     * @throws Exception
     */
    private function checkLayout()
    {
        if(!is_file($this->getLayoutFile())){
            throw new \Exception("Invalid layout file");
        }
    }

    /**
     * @throws Exception
     */
    private function checkView()
    {
        if(!is_file($this->getViewFile())){
            throw new Exception("Invalid view file");
        }
    }
}