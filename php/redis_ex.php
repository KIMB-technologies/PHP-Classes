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
 * Example Redis Cache
 */

// set server
RedisCache::setRedisServer('redis');

// create two store groups
$r1 = new RedisCache('test');
$r2 = new RedisCache('test2');

// check Key => Value storing
echo '$r1->set( "key-uu", "uu")   : ' . ( $r1->set( 'key-uu', 'uu') ? 'true' : 'false' ) . PHP_EOL;
echo '$r1->set( "key-ii", "ii")   : ' . ( $r1->set( 'key-ii', 'ii') ? 'true' : 'false' ) . PHP_EOL;
echo '$r1->get( "key-uu" )        : ' . $r1->get( 'key-uu' ) . PHP_EOL;
echo '$r1->get( "key-uuu" )       : ' . $r1->get( 'key-uuu' ) . PHP_EOL;
echo '$r1->keyExists( "key-ii" )  : ' . ( $r1->keyExists( 'key-ii' ) ? 'true' : 'false' ) . PHP_EOL;
echo '$r1->keyExists( "key-iii" ) : ' . ( $r1->keyExists( 'key-iii' ) ? 'true' : 'false' ) . PHP_EOL;
echo '$r1->remove( "key-ii" );    : ' . ( $r1->remove( 'key-ii' ) ? 'true' : 'false' ) . PHP_EOL;


echo PHP_EOL . PHP_EOL;

echo '$r1->output()              : void ' . PHP_EOL; $r1->output();
echo '$r1->removeGroup()         : ' . ( $r1->removeGroup() ? 'true' : 'false' ) . PHP_EOL;
echo '$r1->keyExists( "key-uu" ) : ' . ( $r1->keyExists( 'key-uu' ) ? 'true' : 'false' ) . PHP_EOL;

echo PHP_EOL . PHP_EOL;

echo '$r2->set( "1sec", "1sec", 1) : ' . ( $r2->set( '1sec', '1sec', 1) ? 'true' : 'false' ) . PHP_EOL;
echo '$r2->get("1sec")             : ' . $r2->get('1sec') . PHP_EOL;
echo 'sleep(2)                     : void ' . PHP_EOL; sleep(2);
echo '$r2->keyExists( "1sec" )     : ' . ( $r2->keyExists( '1sec' ) ? 'true' : 'false' ) . PHP_EOL;

echo PHP_EOL . PHP_EOL;

echo '$r2->arraySet( "array1", [1,2,3,5,"ee" => [7,8]] )                              : '. ( $r2->arraySet( 'array1', [1,2,3,5,'ee' => [7,8]] ) ? 'true' : 'false' ) . PHP_EOL;
echo '$r2->arraySet( "array2", [["name" => "aa"],["name" => "bb"],["name" => "cc"]] ) : '. ( $r2->arraySet( 'array2', [['name' => 'aa'],['name' => 'bb'],['name' => 'cc']] ) ? 'true' : 'false' ) . PHP_EOL;
echo '$r2->output()                                                                   : void ' . PHP_EOL; $r2->output();

echo PHP_EOL . PHP_EOL;

echo '$r2->arrayKeyExists( "array1", "ee" )                : ' . ( $r2->arrayKeyExists( 'array1', 'ee' ) ? 'true' : 'false' ) . PHP_EOL;
echo '$r2->arrayKeyExists( "array1", "bb" )                : ' . ( $r2->arrayKeyExists( 'array1', 'bb' ) ? 'true' : 'false' ) . PHP_EOL;
echo '$r2->keyExists( "array2" )                           : ' . ( $r2->keyExists( 'array2' ) ? 'true' : 'false' ) . PHP_EOL;

echo '$r2->arrayKeySet("array1", "aa", 12 )                : ' . ( $r2->arrayKeySet('array1', 'aa', 12 ) ? 'true' : 'false' ) . PHP_EOL;
echo '$r2->arrayKeySet("array2", null, ["name" => "dd"] )  : ' . ( $r2->arrayKeySet('array2', null, ["name" => "dd"] ) ? 'true' : 'false' ) . PHP_EOL;

echo PHP_EOL . PHP_EOL;

echo 'print_r( $r2->arrayKeyGet("array1", "ee" ) ) : ' . PHP_EOL; print_r( $r2->arrayKeyGet('array1', 'ee' ) );
echo 'print_r( $r2->arrayGet( "array2" ) )         : ' . PHP_EOL; print_r( $r2->arrayGet( 'array2' ) );
?>