<?php

namespace georgkott\nistphp\context;

class Context
{
    private $namingStrategy;

    public function __construct(NamingStrategyInterface $strategy)
    {
        $this->namingStrategy = $strategy;
    }

    public function execute()
    {
        $string = $this->namingStrategy->getString();

        return $string;
    }
}
