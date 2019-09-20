<?php
header('Content-Type: text/plain');

require_once( __DIR__ . '/JSONReader.php' );

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
?>