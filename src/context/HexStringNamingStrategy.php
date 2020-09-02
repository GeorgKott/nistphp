<?php

namespace georgkott\nistphp\context;

class HexStringNamingStrategy implements NamingStrategyInterface
{
    use HexTrait;

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
                'String contains characters other than 0-9,A-F,a-f'
            );
        }
    }
}
