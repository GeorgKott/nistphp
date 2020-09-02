<?php

namespace georgkott\nistphp\context;

class BinStringNamingStrategy implements NamingStrategyInterface
{
    use BitTrait;

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
                'String contains only special symbol and english characters'
            );
        }
    }
}
