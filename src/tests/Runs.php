<?php

/*
* 3.3 Runs Test
*/

namespace georgkott\nistphp\tests;

use georgkott\nistphp\tests\interfaces\NistTestInterface;
	
class Runs implements NistTestInterface
{
	const IDENTIFY = 3;

    const INDENT = 27;

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
		echo "3.3 Runs Test \n";
	}

	private function getCountOverwise($arr)
    {
        $count = 0;

        $current = $arr[0];

        for($i=1;$i<count($arr);$i++){
            if($arr[$i] != $current){
                $current = $arr[$i];
                $count++;
            }
        }

        return ($count+1);
    }

    private function getProporcial($arr)
    {
        $data = array_count_values($arr);

        if(!isset($data[1])){
            return 0;
        }

        return $data[1]/count($arr);
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

        $proporcial = $this->getProporcial($arr);

        if(abs($proporcial-0.5) >= (2/sqrt(count($arr)))){
            return 0;
        }

        $overwise = $this->getCountOverwise($arr);

        $p = $this->erfc(abs($overwise-2*count($arr)*$proporcial*(1-$proporcial))/(2*sqrt(2*count($arr))*$proporcial*(1-$proporcial)));

		return $p;
	}
}
