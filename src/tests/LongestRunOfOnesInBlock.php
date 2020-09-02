<?php

/*
* 3.4 Test for the Longest Run of Ones in a Block
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class LongestRunOfOnesInBlock implements NistTestInterface
{
	const IDENTIFY = 4;

    const INDENT = 8;

    public $indent;
    public $warning;

    const LG_g = 5.0;
    const LG_N = 6;

    const LCT = [
        1.000000000190015,
        76.18009172947146,
        -86.50532032941677,
        24.01409824083091,
        -1.231739572450155,
        0.1208650973866179e-2,
        -0.5395239384953e-5
    ];

    const LN_SQRT_2_PI = 0.91893853320467274178;
    const G_PI = 3.14159265358979323846;

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
		echo "3.4 Test for the Longest Run of Ones in a Block \n";
	}

	private function getLongestSequenceItem($arr)
    {
        return max(
            array_map(function ($str){
                return strlen($str);
            },explode('0',implode('',$arr)))
        );
    }

    private function getLongestSequence($arr)
    {
        $data = [];

        foreach($arr as $item){
            $data[] = $this->getLongestSequenceItem($item);
        }

        return $data;
    }

    private function getCountLengthFromTable8($arr)
    {
        $v = [0,0,0,0];

        foreach($arr as $item){
            if($item <= 1){
                $v[0]++;
            }
            else if($item == 2){
                $v[1]++;
            }
            else if($item == 3){
                $v[2]++;
            }
            else{
                $v[3]++;
            }
        }

        return $v;
    }

    private function getCountLengthFromTable128($arr)
    {
        $v = [0,0,0,0,0,0];

        foreach($arr as $item){
            if($item <= 4){
                $v[0]++;
            }
            else if($item == 5){
                $v[1]++;
            }
            else if($item == 6){
                $v[2]++;
            }
            else if($item == 7){
                $v[3]++;
            }
            else if($item == 8){
                $v[4]++;
            }
            else{
                $v[5]++;
            }
        }

        return $v;
    }

    private function getCountLengthFromTable10000($arr)
    {
        $v = [0,0,0,0,0,0,0];

        foreach($arr as $item){
            if($item <= 10){
                $v[0]++;
            }
            else if($item == 11){
                $v[1]++;
            }
            else if($item == 12){
                $v[2]++;
            }
            else if($item == 13){
                $v[3]++;
            }
            else if($item == 14){
                $v[4]++;
            }
            else if($item == 15){
                $v[5]++;
            }
            else{
                $v[6]++;
            }
        }

        return $v;
    }

    private function getXsi($v,$r,$p)
    {
        $xsi = 0;

        foreach($v as $key=>$item){
            $xsi += (($item - $r*$p[$key])**2)/($r*$p[$key]);
        }

        return $xsi;
    }

    private function lowerIncompleteGamma($s,$x)
    {
        $lowerGammaK = ($x**$s)/($s*exp($x));

        $arr = [];

        $i = 0;
        $el = 0;

        while($el > 0.000000000001 || $i == 0){
            if($i == 0){
                $el = 1;
            }
            else{
                $el = ($x**$i)/($this->getMulS($s,$i));
            }

            $arr[] = $el;
            $i++;
        }

        return array_sum($arr)*$lowerGammaK;
    }

    private function getMulS($s,$n)
    {
        $mul = 1;

        for($i=0;$i<$n;$i++){
            $mul*=($s+$i+1);
        }

        return $mul;
    }

    private function lanczos_ln_gamma($z)
    {
        $rv = 0;
        $i = 0;

        if ($z < 0.5) {
            return log(self::G_PI / sin(self::G_PI * $z)) - $this->lanczos_ln_gamma(1.0 - $z);
        }

        $z = $z - 1;
        $base = $z + self::LG_g + 0.5;
        $sum = 0;

        for($i=self::LG_N; $i >= 1; $i--) {
            $sum += self::LCT[$i] /($z + $i);
        }

        $sum += self::LCT[0];

        return ((self::LN_SQRT_2_PI + log($sum)) - $base) + log($base)*($z+0.5);
    }

    private function lanczos_gamma($z)
    {
        return (exp($this->lanczos_ln_gamma($z)));
    }

	public function getResult($data)
	{
        $arr = str_split($data);
        $n = count($arr);

        if($n < 128){
            $this->warning = 'WARNING: sequence length < 128';
        }

        if($n < 128){
            return 0;
        }
        else if($n >= 128 && $n < 6272){
            $m = 8;
        }
        else if($n >= 6272 && $n < 750000){
            $m = 128;
        }
        else{
            $m = 10000;
        }

        $chunk = array_chunk(array_slice($arr,0,floor($n/$m)*$m),$m);

        $longestSequence = $this->getLongestSequence($chunk);

        $countLengthFromTable = [];
        if($m == 8){
            $countLengthFromTable = $this->getCountLengthFromTable8($longestSequence);
            $xsi = $this->getXsi($countLengthFromTable,16,[0.2148,0.3672,0.2305,0.1875]);

            $lowerIncompleteGammaValue = $this->lowerIncompleteGamma(3/2,$xsi/2);
            $gammaValue = $this->lanczos_gamma(3/2);
        }
        else if($m == 128){
            $countLengthFromTable = $this->getCountLengthFromTable128($longestSequence);
            $xsi = $this->getXsi($countLengthFromTable,49,[0.1174,0.243,0.2493,0.1752,0.1027,0.1124]);

            $lowerIncompleteGammaValue = $this->lowerIncompleteGamma(5/2,$xsi/2);
            $gammaValue = $this->lanczos_gamma(5/2);
        }
        else if($m == 10000){
            $countLengthFromTable = $this->getCountLengthFromTable10000($longestSequence);
            $xsi = $this->getXsi($countLengthFromTable,75,[0.0882,0.2092,0.2483,0.1933,0.1208,0.0675,0.0727]);

            $lowerIncompleteGammaValue = $this->lowerIncompleteGamma(6/2,$xsi/2);
            $gammaValue = $this->lanczos_gamma(6/2);
        }

        return (1 - $lowerIncompleteGammaValue/$gammaValue);
	}
}
