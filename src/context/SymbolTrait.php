<?php

namespace georgkott\nistphp\context;

trait SymbolTrait
{
    public function checkBin($text)
    {
        if(preg_match('/^[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\0-9a-zA-Z ]+$/',$text)){
            return true;
        }

        return false;
    }

    public function getText($text)
    {
        $arr = array_map(function($item){
            return str_pad(decbin(ord($item)),8,'0',STR_PAD_LEFT);
        },str_split($text));

        return implode($arr);
    }
}
