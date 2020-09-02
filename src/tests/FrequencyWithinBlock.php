<?php

/*
* 3.2 Frequency Test within a Block
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class FrequencyWithinBlock implements NistTestInterface
{
	const IDENTIFY = 2;

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

    const INDENT = 11;

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

	public function getInfo()
	{
		echo "3.2 Frequency Test within a Block \n";
	}

	private function getProporcial($arr)
    {
        $data = array_count_values($arr);

        if(!isset($data[1])){
            return 0;
        }

        return $data[1]/count($arr);
    }

    private function getMulS($s,$n)
    {
        $mul = 1;

        for($i=0;$i<$n;$i++){
            $mul*=($s+$i+1);
        }

        return $mul;
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

	public function getResult($data)
	{
        $arr = str_split($data);

        $n = count($arr);

        if($n < 100){
            $this->warning = 'WARNING: sequence length < 100';
        }

        if($n < 100){
            $_n = $n;
            $_m = 1;
        }
        else if($n < 1980){
            $_m = 10;
            $_n = floor($n/$_m);
        }
        else{
            $_n = 99;
            $_m = $n/$_n;
        }

        $chunk = array_chunk(array_slice($arr,0,$_n*$_m),$_m);

        $xsi = 0;

        foreach($chunk as $item){
            $xsi += ($this->getProporcial($item) - 1/2)**2;
        }

        $xsi *= 4*$_m;

        $lowerIncompleteGammaValue = $this->lowerIncompleteGamma($_n/2,$xsi/2);
        $gammaValue = $this->lanczos_gamma($_n/2);

        echo $gammaValue;

        exit;

        return (1 - $lowerIncompleteGammaValue/$gammaValue);
	}
}