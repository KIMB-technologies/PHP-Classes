<?php
/** 
 * KIMB-technologies
 * https://github.com/KIMB-technologies/
 * 
 * (c) 2019 KIMB-technologies 
 * 
 * released under the terms of MIT License
 * https://opensource.org/licenses/MIT
 */
header('Content-Type: text/plain');

/**
 * Example load.
 */
define('KIMB-Classes', 'ok');
require_once( __DIR__ . '/classes/autoload.php' );

/**
 * Example JSON Reader
 */
JSONReader::changePath(__DIR__);
$j = new JSONReader('test');

$j->setArray( array(
	array(
		'aa' => array(0,1,2,3,4,5,6,7,8,9),
		'bb' => array(10,11,12,13,14,15,16,17,18,19)
	),
	array(
		array(
			"name" => 'a',
			"set" => true,
			"do" => false
		),
		array(
			"name" => 'b',
			"set" => false,
			"do" => false
		),
		array(
			"name" => 'C',
			"set" => true,
			"do" => true
		),
	)
));

print_r( $j->getArray() );

echo PHP_EOL . PHP_EOL;

echo '$j->isValue([1,0,"name"], "a") : ' . ( $j->isValue( [1,0,'name'], 'a') ? 'true' : 'false' ) . PHP_EOL;
echo '$j->isValue([1,0,"name"], "b") : ' . ( $j->isValue([1,0,'name'], 'b') ? 'true' : 'false' ) . PHP_EOL;
echo '$j->isValue([1,1,"name"], "a") : ' . ( $j->isValue([1,1,'name'], 'a') ? 'true' : 'false' ) . PHP_EOL;
echo '$j->isValue([1,1,"name"])      : ' . ( $j->isValue([1,1,'name']) ? 'true' : 'false' ) . PHP_EOL;
echo '$j->isValue([1,5,"name"])      : ' . ( $j->isValue([1,5,'name']) ? 'true' : 'false' ) . PHP_EOL;

echo PHP_EOL . PHP_EOL;

echo '$j->getValue([0,"aa"])                                       : ' . json_encode( $j->getValue([0,'aa']) ) . PHP_EOL;
echo '$j->getValue([0,"cc"])                                       : ' . json_encode( $j->getValue([0,'cc']) ) . PHP_EOL;

echo PHP_EOL . PHP_EOL;

echo '$j->setValue([0,null], array(20,21,22,23,24,25,26,27,28,29)) : ' . ( $j->setValue([0,null], array(20,21,22,23,24,25,26,27,28,29))  ? 'true' : 'false' ) . PHP_EOL;
echo '$j->setValue([0,"aa"], array(30,31,32,33,34,35,36,37,38,39)) : ' . ( $j->setValue([0,"aa"], array(30,31,32,33,34,35,36,37,38,39))  ? 'true' : 'false' ) . PHP_EOL;
echo '$j->setValue([0,"bb"], null)                                 : ' . ( $j->setValue([0,"bb"], null)  ? 'true' : 'false' ) . PHP_EOL;

echo PHP_EOL . PHP_EOL;

echo '$j->searchValue([1], "b", "name") : ' . ( is_numeric($n = $j->searchValue([1], 'b', 'name')) ? $n : 'false' ) . PHP_EOL;
echo '$j->searchValue([0, "aa"], 37)    : ' . ( is_numeric($n = $j->searchValue([0, 'aa'], 37)) ? $n : 'false' ) . PHP_EOL;
echo '$j->searchValue([0, "aa"], 12)    : ' . ( is_numeric($n = $j->searchValue([0, 'aa'], 12)) ? $n : 'false' ) . PHP_EOL;

echo PHP_EOL . PHP_EOL;

$j->output();
?>