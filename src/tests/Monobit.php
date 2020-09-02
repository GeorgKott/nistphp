<?php

/*
* 3.1 Frequency (Monobits) Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;

class Monobit implements NistTestInterface
{
    const IDENTIFY = 1;

    const INDENT = 24;

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
        echo "3.1 Frequency (Monobits) Test \n";
    }

    private function erf($x)
    {
        $p  = 0.3275911;
        $t  = 1 /(1 + $p*$x);

        $a1 = 0.254829592;
        $a2 = -0.284496736;
        $a3 = 1.421413741;
        $a4 = -1.453152027;
        $a5 = 1.061405429;

        $erf = 1 - ( $a1*$t + $a2*$t**2 + $a3*$t**3 + $a4*$t**4 + $a5*$t**5 )*exp(-($x ** 2));

        return $erf;
    }

    private function erf1($x)
    {
        return (2/sqrt(M_PI))*($x-$x**3/3+$x**5/10-$x**7/42+$x**9/216-$x**11/1320);
    }

    private function erfc($x)
    {
        $n = 1 - $this->erf($x);

        return $n;
    }

    public function getResult($data)
    {
        $arr = str_split($data);

        $n = count($arr);

        if($n < 100){
            $this->warning = 'WARNING: sequence length < 100';
        }

        $summ = 0;

        foreach($arr as $item){
            if($item == 0){
                $summ += -1;
            }
            else{
                $summ += 1;
            }
        }

        $s = (abs($summ) / sqrt($n))/sqrt(2);

        //$p = $this->erfc($s);
        $p = $this->erf($s);
        $p1 = $this->erf1($s);

        echo $p."\n";
        echo $p1."\n";

        exit;
        return $p;
    }
}