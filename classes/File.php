<?php

/**
 * Created by PhpStorm.
 * User: Dian
 * Date: 6/28/2015
 * Time: 3:45 PM
 */
class File
{

    private $filePath;

    private $fileSize;

    private $newFilename;

    private $fileExtension;

    private $maxSize = 500000;

    private $minSize = 0;

    private $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

    public function __construct($filePath, $fileSize, $fileName)
    {
        $this->filePath = $filePath;
        $this->fileSize = $fileSize;
        $this->fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    }

    public function isImage()
    {
        return getimagesize($this->filePath);
    }

    public function exist()
    {
        return file_exists($this->filePath);
    }

    public function isValidSize()
    {
        $size = filesize($this->filePath);

        if ($size > $this->maxSize) {
            return false;
        }

        if ($size < $this->minSize) {
            return false;
        }

        return true;
    }

    public function isAllowedType()
    {
        return in_array($this->fileExtension, $this->allowedTypes);
    }

    public function upload($newFilePath)
    {
        $this->newFilename = end(explode(DIRECTORY_SEPARATOR, $newFilePath . '.' . $this->fileExtension));
        return move_uploaded_file($this->filePath, $newFilePath . '.' . $this->fileExtension);
    }

    public function getNewFileName()
    {
        return $this->newFilename;
    }


}