<?php

/*
* 3.6 Discrete Fourier Transform (Specral) Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class DiscreteFourierTransform implements NistTestInterface
{
	const IDENTIFY = 6;

    const INDENT = 7;

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
		echo "3.6 Discrete Fourier Transform (Specral) Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}
