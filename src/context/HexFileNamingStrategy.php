<?php

namespace georgkott\nistphp\context;

class HexFileNamingStrategy extends File implements NamingStrategyInterface
{
    use HexTrait;

    public function __construct($file)
    {
        parent::__construct($file);
    }

    public function getString()
    {
        if($this->checkBin($this->text)){
            return $this->getText($this->text);
        }
        else{
            throw new \Exception(
                'File contains characters other than 0-9,A-F,a-f'
            );
        }
    }
}
