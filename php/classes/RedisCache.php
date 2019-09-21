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

/**
 * A class to cache values using redis,
 * can be used with JSONReader
 */
class RedisCache extends Cache {


	/**
	 * Redis Settings
	 */
	private static $host = '127.0.0.1',
		$port = 6379,
		$auth = null;

	/**
	 * Set the details of the redis server.
	 * @param $host the host of the server (default 127.0.0.1)
	 * @param $port the port to use (default 6379)
	 * @param $auth the password to use (default no auth)
	 */
	public static function setRedisServer($host, $port = 6379, $auth = null){
		self::$host = $host;
		self::$port = $port;
		self::$auth = $auth;
	}

	/**
	 * Redis connection
	 */
	private $redis, $prefix;

	public function __construct(){
		$this->redis = new Redis();
		$this->redis->pconnect(self::$host, self::$port);
		if( !empty(self::$auth) ){
			$this->redis->auth(self::$auth);
		}

		// the path and filename is used as 
		$this->prefix = base64_encode(
				hash(
					'sha512',
					(empty($otherpath) ? self::$path : $otherpath . '/' ). $filename . '.json',
					true
				)
			);
	}

	private function getKeyFromIndex(array $index) : string {
		$i = array_filter( $index, function ($value){
			return !is_null( $value ) && (
					( is_string( $value ) && strlen( $value ) > 0 ) 
					|| ( is_numeric( $value ) )
				);
		});
		// <sha512 as filename>:<key>:<key>:<key>(: if append value, else no :)
		return $this->prefix . ':' . implode( ':', $i ) . (end($index) == null ? ':' : '');
	}

	

	/**
	 * Imports a JSONReader into the RedisCache
	 * @param $reader the json reader to import
	 */
	public function importJSON(JSONReader $reader){

	}
}
?>
