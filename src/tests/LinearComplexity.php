<?php

/*
* 3.10 Linear Complexity Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class LinearComplexity implements NistTestInterface
{
	const IDENTIFY = 10;

    const INDENT = 15;

    public $indent;
    public $warning;

    public function __construct()
    {
        $this->indent = $this->getIndent();
    }

    private function getIndent()
    {
        return str_repeat(' ',self::INDENT);
    }

	public function getInfo()
	{
		echo "3.10 Linear Complexity Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}
