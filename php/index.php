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
 * Example JSON
 */

 /**
  * Example Redis Cache
  */
$redis = new Redis();
$redis->connect('redis');

$redis->set('key', 'value1');
$redis->append('key', time() ); 
print_r([$redis->get('key')]);


$redis->set('x', '42');
$redis->expire('x', 1);	

print_r([$redis->get('x')]);
sleep(2);
print_r([$redis->get('x')]);

/**
 * Example Template
 */
?>