<?php

namespace georgkott\nistphp\context;

trait IntTrait
{
    public function checkBin($text)
    {
        if(preg_match('/^[0-9]+$/',$text)){
            return true;
        }

        return false;
    }

    private function clearArrFromZero($arr)
    {
        $cnt = 0;

        foreach($arr as $item){
            if($item == 0){
                $cnt++;
            }
            else{
                break;
            }
        }

        return array_slice($arr,$cnt);
    }

    private function div($arr)
    {
        $bin = '';

        while(!empty($arr)){
            $countElements = count($arr);
            $counter = 0;

            for($j=0;$j<count($arr);$j++){
                $counter++;
                if($counter == $countElements){
                    $bin .= $arr[$j]%2;
                    $arr[$j] = intval($arr[$j]/2);
                }
                else{
                    if($arr[$j] < 2){
                        $arr[$j+1] = $arr[$j]*10+$arr[$j+1];
                        $arr[$j] = 0;
                    }
                    else{
                        $arr[$j+1] = ($arr[$j]%2)*10+$arr[$j+1];
                        $arr[$j] = intval($arr[$j]/2);
                    }
                }
            }

            $arr = $this->clearArrFromZero($arr);
        }

        return strrev($bin);
    }

    public function getText($text)
    {
        $arr = $this->clearArrFromZero(str_split($text));

        return $this->div($arr);
    }
}
