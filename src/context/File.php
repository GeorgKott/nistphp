<?php

namespace georgkott\nistphp\context;

class File
{
    protected $text;

    public function __construct($file)
    {
        if($this->checkFile($file)){
            if($this->checkFilePermission($file)){
                if($this->checkFileSize($file)){
                    $this->text = file_get_contents($file);
                }
                else{
                    throw new \Exception(
                        'Empty file'
                    );
                }
            }
            else{
                throw new \Exception(
                    'File not exist'
                );
            }
        }
        else{
            throw new \Exception(
                'File is not allowed to read'
            );
        }
    }

    private function checkFile($file)
    {
        if(file_exists($file) && is_file($file)){
            return true;
        }
        else{
            return false;
        }
    }

    private function checkFilePermission($file)
    {
        if(is_readable($file)){
            return true;
        }
        else{
            return false;
        }
    }

    private function checkFileSize($file)
    {
        $size = filesize($file);
        if($size !== 0){
            return true;
        }
        return false;
    }
}
