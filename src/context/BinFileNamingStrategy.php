<?php

namespace georgkott\nistphp\context;

//use georgkott\nistphp\context\BinTrait;

class BinFileNamingStrategy extends File implements NamingStrategyInterface
{
    use BitTrait;

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
                'File contains characters other than 0 or 1'
            );
        }
    }
}
