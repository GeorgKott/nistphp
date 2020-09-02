<?php

namespace georgkott\nistphp\context;

class IntFileNamingStrategy extends File implements NamingStrategyInterface
{
    use IntTrait;

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
                'File contains characters 0-9'
            );
        }
    }
}
