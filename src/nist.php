<?php

/*
*	Specification https://nvlpubs.nist.gov/nistpubs/Legacy/SP/nistspecialpublication800-22r1a.pdf
*/

namespace georgkott\nistphp;

use georgkott\nistphp\context\BinStringNamingStrategy;
use georgkott\nistphp\context\HexStringNamingStrategy;
use georgkott\nistphp\context\SymbolStringNamingStrategy;
use georgkott\nistphp\context\IntStringNamingStrategy;
use georgkott\nistphp\context\BinFileNamingStrategy;
use georgkott\nistphp\context\HexFileNamingStrategy;
use georgkott\nistphp\context\SymbolFileNamingStrategy;
use georgkott\nistphp\context\IntFileNamingStrategy;
use georgkott\nistphp\context\Context;

use georgkott\nistphp\tests\abstracts\Test;

class Nist
{
	const TEST_IDENTIFIERS = [
		'1' => 'Monobit',
		'2' => 'FrequencyWithinBlock',
		'3' => 'Runs',
		'4' => 'LongestRunOfOnesInBlock',
		'5' => 'BinaryMatrixRank',
		'6' => 'DiscreteFourierTransform',
		'7' => 'NonOverlappingTemplateMatching',
		'8' => 'OverlappingTemplateMatching',
		'9' => 'MaurersUniversalStatistical',
		'10' => 'LinearComplexity',
		'11' => 'Serial',
		'12' => 'ApproximateEntropy',
		'13' => 'CumulativeSums',
		'14' => 'RandomExcursions',
		'15' => 'RandomExcursionsVariant'
	];

	private $a;

	public $filedata;
	public $formatdata;
	public $stringdata;

	public function __construct($a = 0.01)
	{
		if (!is_numeric($a)) {
            throw new \InvalidArgumentException(
                'Passed value should be a numeric'
            );
        }
        else if($a < 0 || $a > 1){
            throw new \InvalidArgumentException(
                '$a - this is the probability.Value should be between 0 and 1'
            );
        }
        else{
            $this->a = $a;
        }
	}

	private function parsingSequenceElement($element)
	{
		if(array_key_exists($element,self::TEST_IDENTIFIERS)){
			return self::TEST_IDENTIFIERS[$element];
		}
		else if(in_array($element,self::TEST_IDENTIFIERS)){
			return $element;
		}
		else{
            throw new \Exception(
                'The parameter can be either a test number or a test name. See Nist::TEST_IDENTIFIERS'
            );
		}
	}

	private function parsingSequence($sequence)
	{
		if(empty($sequence)){
			return array_values(self::TEST_IDENTIFIERS);
		}
		else if(is_array($sequence)){
			$elements = [];

			foreach($sequence as $item){
				$elements[] = $this->parsingSequenceElement($item);
			}

			return $elements;
		}
		else if(is_int($sequence) || is_string($sequence)){
			return [$this->parsingSequenceElement($sequence)];
		}
		else{
            throw new \Exception(
                'The parameter can be either a test number or a test name. See Nist::TEST_IDENTIFIERS'
            );
		}
	}

	private function getData()
	{
		if(!empty($this->filedata)){
            if($this->formatdata == 'bin'){
                $context = new Context(new BinFileNamingStrategy($this->filedata));
            }
            else if($this->formatdata == 'hex'){
                $context = new Context(new HexFileNamingStrategy($this->filedata));
            }
            else if($this->formatdata == 'symbol'){
                $context = new Context(new SymbolFileNamingStrategy($this->filedata));
            }
            else if($this->formatdata == 'int'){
                $context = new Context(new IntFileNamingStrategy($this->filedata));
            }
            else{
                throw new \Exception(
                    'Set format data from the array["bin","hex","symbol","int"]'
                );
            }
        }
		else if(!empty($this->stringdata)){
            if($this->formatdata == 'bin'){
                $context = new Context(new BinStringNamingStrategy($this->stringdata));
            }
            else if($this->formatdata == 'hex'){
                $context = new Context(new HexStringNamingStrategy($this->stringdata));
            }
            else if($this->formatdata == 'symbol'){
                $context = new Context(new SymbolStringNamingStrategy($this->stringdata));
            }
            else if($this->formatdata == 'int'){
                $context = new Context(new IntStringNamingStrategy($this->stringdata));
            }
            else{
                throw new \Exception(
                    'Set format data from the array["bin","hex","symbol","int"]'
                );
            }
        }
		else{
            throw new \Exception(
                'Set data source to stringdata or filedata'
            );
        }

		return $context->execute();
	}

	public function getResult($sequence = null)
	{
		$data = $this->getData();

		$numbers = $this->parsingSequence($sequence);

        echo "data is ".$data."\n";

		foreach($numbers as $key=>$item){
			$test = Test::initial($item);
			$res = $test->getResult($data);

			if($res == 0){
                echo $item.$test->indent.'0                      FAIL '.$test->warning."\n";
            }
			else if($res <= $this->a){
                echo $item.$test->indent.sprintf('%.20f', $res).' FAIL '.$test->warning."\n";
            }
			else{
                echo $item.$test->indent.sprintf('%.20f', $res).' GOOD '.$test->warning."\n";
            }
		}
	}
}
