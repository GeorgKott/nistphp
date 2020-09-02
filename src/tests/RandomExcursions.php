<?php

/*
* 3.14 Random Excursions Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class RandomExcursions implements NistTestInterface
{
	const IDENTIFY = 14;

    const INDENT = 1;

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
		echo "3.14 Random Excursions Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}