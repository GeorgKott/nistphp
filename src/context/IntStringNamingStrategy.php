<?php

namespace georgkott\nistphp\context;

class IntStringNamingStrategy implements NamingStrategyInterface
{
    use IntTrait;

    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function getString()
    {
        if($this->checkBin($this->string)){
            return $this->getText($this->string);
        }
        else{
            throw new \Exception(
                'String contains characters 0-9'
            );
        }
    }
}
