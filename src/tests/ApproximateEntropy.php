<?php
/*
* 3.12 Approximate Entropy Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class ApproximateEntropy implements NistTestInterface
{
	const IDENTIFY = 12;

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
		echo "3.12 Approximate Entropy Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}