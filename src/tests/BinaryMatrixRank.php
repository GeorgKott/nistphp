<?php

/*
* 3.5 Binary Matrix Rank Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class BinaryMatrixRank implements NistTestInterface
{
	const IDENTIFY = 5;

    const INDENT = 15;

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
		echo "3.5 Binary Matrix Rank Test \n";
	}

	private function getMatrixSize($n)
    {
        if($n >= 2048){
            return 32;
        }

        return floor(sqrt($n/2));
    }

    private function changeLinePosition($arr,$i,$j)
    {
        $line = $arr[$i];

        $arr[$i] = $arr[$j];
        $arr[$j] = $line;

        return $arr;
    }

    private function operationLine($str1,$str2,$koef)
    {
        if($koef > 0){
            for($i=0;$i<count($str1);$i++){
                $str1[$i] -= $str2[$i]*$koef;
            }
        }
        else{
            for($i=0;$i<count($str1);$i++){
                $str1[$i] += $str2[$i]*$koef;
            }
        }

        return $str1;
    }

    private function matrixBubbleSort($arr,$n)
    {
        $bubble = array_column($arr,$n);

        $size = count($bubble);

        for($i = $n;$i < $size;$i++){
            for($j = $n;$j < $size-1;$j++){
                if(abs($bubble[$j]) < abs($bubble[$j+1])){
                    $x=$bubble[$j];
                    $bubble[$j]=$bubble[$j+1];
                    $bubble[$j+1]=$x;

                    $arr = $this->changeLinePosition($arr,$j,($j+1));
                }
            }
        }

        return $arr;
    }

    private function elementaryMatrix($arr,$n)
    {
        $searchStr = array_column($arr,$n);

        $size = count($searchStr);

        $str = [];

        for($i=$n;$i<$size;$i++){
            if($searchStr[$i] != 0){
                $str = $arr[$i];
                break;
            }
        }

        if(empty($str)){
            return $arr;
        }

        for($i=$n+1;$i<$size;$i++){
            if($arr[$i][$n] != 0){
                $arr[$i] = $this->operationLine($arr[$i],$str,$arr[$i][$n]);
            }
        }

        return $arr;
    }

    private function deleteEqualString($arr)
    {
        $n = count($arr);

        for($i = 0;$i < $n;$i++){
            for($j = $i+1;$j < $n;$j++){
                if($arr[$i] === $arr[$j]){
                    $arr[$j] = array_fill(0,$n,0);
                }
            }
        }

        return $arr;
    }

    private function getTriangularMatrix($arr)
    {
        $n = count($arr);

        for($i = 0;$i < $n;$i++){
            $arr = $this->deleteEqualString($arr);
            $arr = $this->matrixBubbleSort($arr,$i);
            $arr = $this->elementaryMatrix($arr,$i);
        }

        return $arr;
    }

    private function checkNotEmptyMatrix($arr)
    {
        $n = count($arr);

        for($i = 0;$i < $n;$i++){
            for($j = 0;$j < $n;$j++){
                if($arr[$i][$j] == 1){
                    return true;
                }
            }
        }

        return false;
    }

    private function getRank($arr)
    {
        if($this->checkNotEmptyMatrix($arr)){
            $arr = $this->getTriangularMatrix($arr);

            $rank = 0;
            $n = count($arr);
            for($i = 0;$i < $n;$i++){
                if($arr[$i] != array_fill(0,$n,0)){
                    $rank++;
                }
            }

            return $rank;
        }
        else{
            return 0;
        }
    }

    private function getRanks($arr)
    {
        $ranks = [];

        foreach($arr as $item){
            $ranks[] = $this->getRank($item);
        }

        return $ranks;
    }

    private function getP($n = 0)
    {
        $res = [];

        for($i=0;$i<=$n;$i++){

            $k = 1;
            for($j=0;$j<$i;$j++){
                $k*=(1-2**($j-$n))*(1-2**($j-$n))/(1-2**($j-$i));
            }

            $res[] = 2**($i*(2*$n-$i)-$n*$n)*$k;
        }

        return $res;
    }

	public function getResult($data)
	{
        $arr = str_split($data);
        $n = count($arr);

        if($n < 2048){
            $this->warning = 'WARNING: sequence length < 2048';
        }

        $q = $m = $this->getMatrixSize($n);

        $chunk = array_chunk(array_slice($arr,0,floor($n/($m*$q))*($m*$q)),$m*$q);

        $matrixs = [];

        foreach($chunk as $item){
            $matrixs[] = array_chunk($item,$m);
        }

        $ranks = $this->getRanks($matrixs);

        $p = $this->getP(32);

        print_r($p);

		return 0;
	}
}

