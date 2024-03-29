<?php
defined('KIMB-Classes') or die('Invalid Endpoint');

/** 
 * KIMB-technologies
 * https://github.com/KIMB-technologies/
 * 
 * (c) 2019 KIMB-technologies 
 * 
 * released under the terms of MIT License
 * https://opensource.org/licenses/MIT
 */

spl_autoload_register(function ($class) {
	if( is_string($class) && preg_match( '/^[A-Za-z0-9]+$/', $class ) === 1 ){
		$classfile = __DIR__ . '/' . $class . '.php';
		if( is_file($classfile) ){
			require_once( $classfile );
		}
	}
});
?>