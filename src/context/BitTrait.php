<?php

namespace georgkott\nistphp\context;

trait BitTrait
{
    public function checkBin($text)
    {
        if(preg_match('/^[01]+$/',$text)){
            return true;
        }

        return false;
    }

    public function getText($text)
    {
        return $text;
    }
}
