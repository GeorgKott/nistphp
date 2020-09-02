<?php

namespace georgkott\nistphp\context;

trait HexTrait
{
    public function checkBin($text)
    {
        if(preg_match('/^[0-9a-fA-F]+$/',$text)){
            return true;
        }

        return false;
    }

    public function getText($text)
    {
        $arr = str_split($text);

        $bin = '';

        foreach($arr as $item){
            switch($item){
                case '0':
                    $bin .= '0000';
                    break;
                case '1':
                    $bin .= '0001';
                    break;
                case '2':
                    $bin .= '0010';
                    break;
                case '3':
                    $bin .= '0011';
                    break;
                case '4':
                    $bin .= '0100';
                    break;
                case '5':
                    $bin .= '0101';
                    break;
                case '6':
                    $bin .= '0110';
                    break;
                case '7':
                    $bin .= '0111';
                    break;
                case '8':
                    $bin .= '1000';
                    break;
                case '9':
                    $bin .= '1001';
                    break;
                case 'a':
                case 'A':
                    $bin .= '1010';
                    break;
                case 'b':
                case 'B':
                    $bin .= '1011';
                    break;
                case 'c':
                case 'C':
                    $bin .= '1100';
                    break;
                case 'd':
                case 'D':
                    $bin .= '1101';
                    break;
                case 'e':
                case 'E':
                    $bin .= '1110';
                    break;
                case 'f':
                case 'F':
                    $bin .= '1111';
                    break;
            }
        }

        return $bin;
    }
}
