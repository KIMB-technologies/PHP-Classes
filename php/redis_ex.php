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

RedisCache::setRedisServer('redis');
$r1 = new RedisCache('test');
$r2 = new RedisCache('test2');

$r1->set( 'uu', 'ii');
$r1->set( 'uu', 'iii');
echo ( $r1->get( 'uu' ) ? 'true' : 'false' ) . PHP_EOL;
echo ( $r1->keyExists( 'uu' ) ? 'true' : 'false' ) . PHP_EOL;
echo ( $r2->keyExists( 'uu' ) ? 'true' : 'false' ) . PHP_EOL;
$r1->removeGroup();
echo ( $r1->keyExists( 'uu' ) ? 'true' : 'false' ) . PHP_EOL;

$r2->set( '1sec', '1sec', 1);
echo $r2->get('1sec') . PHP_EOL;
sleep(2);
echo ( $r2->keyExists( '1sec' ) ? 'true' : 'false' ) . PHP_EOL;

die();
/*
arraySet( string $key, array $array, int $ttl = 0 )
arrayGet( string $key ) 
arrayKeyExists(string $key, string $arrayKey )
arrayKeyGet(string $key, string $arrayKey ) 
arrayKeySet(string $key, string $arrayKey, $value, int $ttl = 0 )
*/
?>