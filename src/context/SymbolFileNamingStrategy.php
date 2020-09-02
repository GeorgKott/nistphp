<?php

namespace georgkott\nistphp\context;

class SymbolFileNamingStrategy extends File implements NamingStrategyInterface
{
    use SymbolTrait;

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
                'File contains only special symbol and english characters'
            );
        }
    }
}
