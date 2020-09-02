<?php
/*
* 3.13 Cumulative Sums (Cusum) Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class CumulativeSums implements NistTestInterface
{
	const IDENTIFY = 13;

    const INDENT = 5;

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
		echo "3.13 Cumulative Sums (Cusum) Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}