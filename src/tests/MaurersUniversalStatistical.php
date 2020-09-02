<?php

/*
* 3.9 Maurer’s "Universal Statistical" Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class MaurersUniversalStatistical implements NistTestInterface
{
	const IDENTIFY = 9;

    const INDENT = 4;

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
		echo "3.9 Maurer’s \"Universal Statistical\" Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}
