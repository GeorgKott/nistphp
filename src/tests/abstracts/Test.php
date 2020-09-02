<?php

namespace georgkott\nistphp\tests\abstracts;

abstract class Test
{
    const NAMESPACE = '\georgkott\nistphp\tests';

	public static function initial($test)
    {
    	$a = self::NAMESPACE. '\\' .$test;

    	return new $a();
	}
}
