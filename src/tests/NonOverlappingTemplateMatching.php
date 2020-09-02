<?php

/*
* 3.7 Non-Overlapping Template Matching Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class NonOverlappingTemplateMatching implements NistTestInterface
{
	const IDENTIFY = 7;

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
		echo "3.7 Non-Overlapping Template Matching Test \n";
	}

	public function getResult($data)
	{
		return 0;
	}
}