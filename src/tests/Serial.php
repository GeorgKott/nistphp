<?php

/*
* 3.11 Serial Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class Serial implements NistTestInterface
{
	const IDENTIFY = 11;

    const INDENT = 25;

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
		echo "3.11 Serial Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}